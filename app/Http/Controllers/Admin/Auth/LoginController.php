<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\SessionKey;
use App\Enums\UserRole;
use App\Enums\ViewPaths\Admin\Auth;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use App\Services\AdminService;
use App\Traits\RecaptchaTrait;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends BaseController
{
    use RecaptchaTrait;

    public function __construct(private readonly Admin $admin, private readonly AdminService $adminService)
    {
        $this->middleware('guest:admin', ['only' => ['index', 'login']]);
    }

    public function rootLogin(): View|RedirectResponse
    {
        if (auth('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        $loginUrl = getWebConfig(name: 'admin_login_url');
        abort_unless(is_string($loginUrl) && $loginUrl !== '', 404);

        return $this->getLoginView(loginUrl: $loginUrl);
    }

    public function index(?Request $request, ?string $type = null): View|Collection|LengthAwarePaginator|null|callable
    {
        return $this->getLoginView(loginUrl: $type);
    }

    public function generateReCaptcha(): Response
    {
        abort_unless(config('services.admin_login_captcha_enabled'), 404);

        // Previous implementation:
        // $recaptchaBuilder = $this->generateDefaultReCaptcha(4);
        // if (Session::has(SessionKey::ADMIN_RECAPTCHA_KEY)) {
        //     Session::forget(SessionKey::ADMIN_RECAPTCHA_KEY);
        // }
        // Session::put(SessionKey::ADMIN_RECAPTCHA_KEY, $recaptchaBuilder->getPhrase());
        // header("Cache-Control: no-cache, must-revalidate");
        // header("Content-Type:image/jpeg");
        // $recaptchaBuilder->output();

        $recaptchaBuilder = $this->generateDefaultReCaptcha(4);
        $this->saveRecaptchaValueInSession(
            SessionKey::ADMIN_RECAPTCHA_KEY,
            $recaptchaBuilder->getPhrase()
        );

        ob_start();
        $recaptchaBuilder->output();
        $image = ob_get_clean();

        if ($image === false) {
            throw new \RuntimeException('Unable to generate the login CAPTCHA image.');
        }

        return response($image)
            ->header('Content-Type', 'image/jpeg')
            ->header('Cache-Control', 'no-cache, must-revalidate');
    }

    private function getLoginView(string $loginUrl): View
    {
        $loginTypes = [
            UserRole::ADMIN => getWebConfig(name: 'admin_login_url'),
            UserRole::EMPLOYEE => getWebConfig(name: 'employee_login_url'),
        ];

        $userType = array_search($loginUrl, $loginTypes);
        abort_if(! $userType, 404);

        $loginCaptchaEnabled = (bool) config('services.admin_login_captcha_enabled');
        $recaptchaBuilder = null;
        $recaptcha = null;

        // Previous implementation always generated the default CAPTCHA:
        // $recaptchaBuilder = $this->generateDefaultReCaptcha(4);
        // Session::put(SessionKey::ADMIN_RECAPTCHA_KEY, $recaptchaBuilder->getPhrase());
        // $recaptcha = getWebConfig(name: 'recaptcha');

        if ($loginCaptchaEnabled) {
            $recaptchaBuilder = $this->generateDefaultReCaptcha(4);
            $this->saveRecaptchaValueInSession(
                SessionKey::ADMIN_RECAPTCHA_KEY,
                $recaptchaBuilder->getPhrase()
            );
            $recaptcha = getWebConfig(name: 'recaptcha');
        }

        return view(Auth::ADMIN_LOGIN, compact('recaptchaBuilder', 'recaptcha', 'loginCaptchaEnabled'))
            ->with(['role' => $userType]);
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        // Previous CAPTCHA validation ran regardless of a single enable/disable flag:
        // $recaptcha = getWebConfig(name: 'recaptcha');
        // if (isset($recaptcha) && $recaptcha['status'] == 1) {
        //     $request->validate([
        //         'g-recaptcha-response' => [
        //             function ($attribute, $value, $fail) {
        //                 $secretKey = getWebConfig(name: 'recaptcha')['secret_key'];
        //                 $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $value;
        //                 $response = Http::get($url)->json();
        //                 if (!isset($response['success']) || !$response['success']) {
        //                     $fail(translate('ReCAPTCHA_Failed'));
        //                 }
        //             },
        //         ],
        //     ]);
        // } elseif (
        //     strtolower(session(SessionKey::ADMIN_RECAPTCHA_KEY))
        //     !== strtolower($request['default_captcha_value'])
        // ) {
        //     return back()->withErrors([translate('ReCAPTCHA_Failed')]);
        // }

        if (config('services.admin_login_captcha_enabled')) {
            $captchaFailure = $this->validateLoginCaptcha($request);

            if ($captchaFailure !== null) {
                return $captchaFailure;
            }
        }

        $admin = $this->admin->where('email', $request['email'])->first();

        if (isset($admin) && in_array($request['role'], [UserRole::ADMIN, UserRole::EMPLOYEE]) && $admin->status) {
            if ($this->adminService->isLoginSuccessful($request['email'], $request['password'], $request['remember'])) {
                return redirect()->route('admin.dashboard');
            }
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors([translate('credentials does not match or your account has been suspended')]);
    }

    private function validateLoginCaptcha(LoginRequest $request): ?RedirectResponse
    {
        $recaptcha = getWebConfig(name: 'recaptcha');

        if (isset($recaptcha) && $recaptcha['status'] == 1) {
            $request->validate([
                'g-recaptcha-response' => [
                    function ($attribute, $value, $fail) {
                        $secretKey = getWebConfig(name: 'recaptcha')['secret_key'];
                        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$value;
                        $response = Http::get($url)->json();

                        if (! isset($response['success']) || ! $response['success']) {
                            $fail(translate('ReCAPTCHA_Failed'));
                        }
                    },
                ],
            ]);

            return null;
        }

        if (
            strtolower((string) session(SessionKey::ADMIN_RECAPTCHA_KEY))
            !== strtolower((string) $request->input('default_captcha_value'))
        ) {
            return back()->withErrors([translate('ReCAPTCHA_Failed')]);
        }

        return null;
    }

    public function logout(): RedirectResponse
    {
        $this->adminService->logout();
        Toastr::success(translate('logged out successfully'));

        return redirect()->route('login.form');
    }
}
