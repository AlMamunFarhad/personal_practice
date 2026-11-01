<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#111a2e">
    <title>{{ translate($role) }} | {{ translate('login') }}</title>
    @php($companyFavIcon = getWebConfig(name: 'company_fav_icon'))
    @if (is_string($companyFavIcon) && $companyFavIcon !== '')
        <link rel="shortcut icon" href="{{ asset('storage/company/'.$companyFavIcon) }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('northstar-theme') === 'dark') {
            document.documentElement.classList.add('dark');
            document.documentElement.style.colorScheme = 'dark';
        }
    </script>
</head>

<body class="font-sans antialiased">
<main class="relative isolate flex min-h-screen items-center overflow-hidden px-4 py-10 sm:px-6">
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="absolute -left-32 -top-40 size-[26rem] rounded-full bg-blue-200/40 blur-3xl dark:bg-blue-500/10"></div>
        <div class="absolute -bottom-48 -right-32 size-[32rem] rounded-full bg-indigo-200/50 blur-3xl dark:bg-indigo-500/10"></div>
        <svg class="absolute inset-x-0 bottom-0 h-40 w-full text-white dark:text-[#121d30]" preserveAspectRatio="none" viewBox="0 0 1921 273" aria-hidden="true">
            <path fill="currentColor" d="M0 273h1921V0L0 273Z"></path>
        </svg>
    </div>

    <div class="mx-auto w-full max-w-md">
        <div class="mb-8 flex justify-end">
            <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-[11px] font-semibold tracking-wide text-emerald-700 dark:border-emerald-900/70 dark:bg-emerald-950/50 dark:text-emerald-300">
                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                {{ translate('software_version') }}: {{ env('SOFTWARE_VERSION') }}
            </span>
        </div>

        @php($e_commerce_logo = getWebConfig(name: 'company_web_logo'))
        {{-- <a class="mb-8 flex justify-center" href="{{ route('home') }}" aria-label="{{ config('app.name') }}">
            <img class="relative z-10 h-10 max-w-full object-contain" src="{{ getValidImage(path: "storage/app/public/company/".$e_commerce_logo, type:'backend-logo') }}" alt="Logo">
        </a> --}}

        <section class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/[0.06] dark:border-slate-700/70 dark:bg-[#121d30] dark:shadow-black/20">
            <div class="p-6 sm:p-9">
                <div class="mb-8 text-center">
                    <span class="mx-auto mb-4 flex size-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 ring-1 ring-inset ring-blue-600/10 dark:bg-blue-500/10 dark:text-blue-300 dark:ring-blue-400/20">
                        <svg viewBox="0 0 24 24" fill="none" class="size-6" aria-hidden="true">
                            <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 8v-1a7 7 0 0 0-14 0v1h14Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <h1 class="text-2xl font-semibold tracking-[-0.04em] text-slate-900 dark:text-slate-100 sm:text-[28px]">{{ translate('sign_in') }}</h1>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">({{ translate($role) }} {{ translate('Login') }})</p>
                </div>

                <form id="form-id" action="{{ route('login') }}" method="post" class="space-y-5">
                    @csrf
                    <input type="hidden" name="role" id="role" value="{{ $role }}">

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300" for="signingAdminEmail">{{ translate('your_email') }}</label>
                        <input
                            type="email"
                            name="email"
                            id="signingAdminEmail"
                            tabindex="1"
                            placeholder="email@address.com"
                            aria-label="email@address.com"
                            autocomplete="username"
                            required
                            data-msg="Please enter a valid email address."
                            class="h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                        >
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300" for="signingAdminPassword">{{ translate('password') }}</label>
                        <div class="relative">
                            <input
                                type="password"
                                class="h-12 w-full rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-12 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-100 dark:placeholder:text-slate-500 dark:hover:border-slate-600 dark:focus:border-blue-400 dark:focus:ring-blue-400/10"
                                name="password"
                                id="signingAdminPassword"
                                placeholder="{{ translate('8+_characters_required') }}"
                                aria-label="{{ translate('password') }}"
                                autocomplete="current-password"
                                required
                                data-msg="Your password is invalid. Please try again."
                            >
                            <div id="changePassTarget" class="absolute inset-y-0 right-0 flex items-center pr-1.5">
                                <button
                                    type="button"
                                    class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:hover:bg-slate-800 dark:hover:text-slate-200"
                                    data-password-toggle
                                    aria-label="Show password"
                                    aria-pressed="false"
                                >
                                    <svg id="changePassIcon" viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                                        <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                        <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.6"/>
                                        <path d="m4 4 16 16" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" data-password-slash class="hidden"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <label class="flex w-fit cursor-pointer items-center gap-2.5 text-sm text-slate-500 dark:text-slate-400" for="termsCheckbox">
                        <input
                            type="checkbox"
                            id="termsCheckbox"
                            name="remember"
                            class="size-4 rounded border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500/30 dark:border-slate-600 dark:bg-slate-900"
                        >
                        <span>{{ translate('remember_me') }}</span>
                    </label>

                    @if ($loginCaptchaEnabled)
                        @if(isset($recaptcha) && $recaptcha['status'] == 1)
                        <div id="recaptcha_element" class="w-full" data-type="image"></div>
                        @else
                        <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 p-2 dark:border-slate-700 dark:bg-slate-900/40">
                            <input
                                type="text"
                                name="default_captcha_value"
                                value=""
                                required
                                placeholder="{{ translate('enter_captcha_value') }}"
                                autocomplete="off"
                                aria-label="{{ translate('enter_captcha_value') }}"
                                class="h-10 min-w-0 flex-1 rounded-lg border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-[#121d30] dark:text-slate-100"
                            >
                            <button
                                type="button"
                                class="get-login-recaptcha-verify group flex shrink-0 items-center gap-2 rounded-lg bg-white px-2 py-1.5 transition hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:bg-slate-800 dark:hover:bg-slate-700"
                                data-link="{{ URL('login/recaptcha/') }}"
                                aria-label="Refresh captcha"
                            >
                                <img
                                    src="{{ URL('login/recaptcha/'.rand().'?captcha_session_id=default_recaptcha_id_'.$role.'_login') }}"
                                    class="h-10 w-[90px] rounded object-cover"
                                    id="default_recaptcha_id"
                                    alt="Captcha"
                                >
                                <svg viewBox="0 0 24 24" fill="none" class="size-4 text-slate-400 transition group-hover:rotate-[-45deg] group-hover:text-blue-600" aria-hidden="true">
                                    <path d="M20 7v5h-5M4.9 9a7.5 7.5 0 0 1 12.6-2L20 12M4 17v-5h5m10.1 3a7.5 7.5 0 0 1-12.6 2L4 12" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        @endif
                    @endif

                    <button
                        type="submit"
                        class="inline-flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 text-sm font-semibold text-white shadow-sm shadow-slate-900/15 transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-500/20 dark:bg-blue-500 dark:shadow-blue-500/15 dark:hover:bg-blue-400"
                    >
                        {{ translate('sign_in') }}
                        <svg viewBox="0 0 20 20" fill="none" class="size-4" aria-hidden="true">
                            <path d="M4 10h12m0 0-5-5m5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>

                @if ($errors->any())
                    <div class="mt-5 space-y-2" role="alert" aria-live="polite">
                        @foreach ($errors->all() as $error)
                            <p class="rounded-lg border border-rose-200 bg-rose-50 px-3 py-2 text-xs text-rose-700 dark:border-rose-900/70 dark:bg-rose-950/40 dark:text-rose-300">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

            </div>

            @if(env('APP_MODE') == 'demo')
                <div class="border-t border-slate-100 bg-slate-50/70 px-6 py-4 dark:border-slate-700 dark:bg-slate-900/40 sm:px-9">
                    <div class="flex items-center justify-between gap-4">
                        <div class="min-w-0 space-y-1 text-[11px] text-slate-500 dark:text-slate-400">
                            <p id="admin-email" data-email="{{ \App\Enums\DemoConstant::ADMIN['email'] }}"><span class="font-semibold text-slate-700 dark:text-slate-300">{{ translate('email') }}:</span> {{ \App\Enums\DemoConstant::ADMIN['email'] }}</p>
                            <p id="admin-password" data-password="{{ \App\Enums\DemoConstant::ADMIN['password'] }}"><span class="font-semibold text-slate-700 dark:text-slate-300">{{ translate('password') }}:</span> {{ \App\Enums\DemoConstant::ADMIN['password'] }}</p>
                        </div>
                        <button
                            type="button"
                            class="inline-flex size-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-[#121d30] dark:text-slate-400 dark:hover:border-blue-900 dark:hover:bg-blue-950/50 dark:hover:text-blue-300"
                            id="copyLoginInfo"
                            aria-label="{{ translate('copy_login_information') }}"
                        >
                            <svg viewBox="0 0 24 24" fill="none" class="size-[18px]" aria-hidden="true">
                                <rect x="8" y="8" width="12" height="12" rx="2" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2" stroke="currentColor" stroke-width="1.6"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </section>
    </div>
</main>

<span id="message-please-check-recaptcha" data-text="{{ translate('please_check_the_recaptcha') }}" class="hidden"></span>
<span id="message-copied_success" data-text="{{ translate('copied_successfully') }}" class="hidden"></span>

<script>
    const passwordInput = document.getElementById('signingAdminPassword');
    const passwordToggle = document.querySelector('[data-password-toggle]');

    passwordToggle?.addEventListener('click', () => {
        const isVisible = passwordInput.type === 'text';

        passwordInput.type = isVisible ? 'password' : 'text';
        passwordToggle.setAttribute('aria-pressed', String(!isVisible));
        passwordToggle.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
        passwordToggle.querySelector('[data-password-slash]')?.classList.toggle('hidden', isVisible);
    });

    document.querySelector('.get-login-recaptcha-verify')?.addEventListener('click', (event) => {
        const button = event.currentTarget;
        const captchaImage = document.getElementById('default_recaptcha_id');

        if (button && captchaImage) {
            captchaImage.src = `${button.dataset.link}?${Date.now()}`;
        }
    });

    document.getElementById('copyLoginInfo')?.addEventListener('click', async () => {
        const email = document.getElementById('admin-email')?.dataset.email;
        const password = document.getElementById('admin-password')?.dataset.password;

        if (email && password) {
            await navigator.clipboard.writeText(`Email: ${email}\nPassword: ${password}`);
        }
    });
</script>

@if ($loginCaptchaEnabled && isset($recaptcha) && $recaptcha['status'] == 1)
    <script>
        "use strict";
        var onloadCallback = function () {
            grecaptcha.render('recaptcha_element', {
                'sitekey': '{{ getWebConfig(name: 'recaptcha')['site_key'] }}'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endif
</body>
</html>
