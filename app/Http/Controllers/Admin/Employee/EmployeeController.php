<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Contracts\Repositories\AdminRepositoryInterface;
use App\Contracts\Repositories\AdminRoleRepositoryInterface;
use App\Enums\ViewPaths\Admin\Employee;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminAddRequest;
use App\Services\AdminService;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    public function __construct(
        private readonly AdminRepositoryInterface $adminRepo,
        private readonly AdminRoleRepositoryInterface $adminRoleRepo,
    ) {}

    public function index(?Request $request, ?string $type = null): View
    {
        return $this->getListView($request);
    }

    public function getListView(Request $request): View
    {
        $employee_roles = $this->adminRoleRepo->getEmployeeRoleList(dataLimit: 'all');
        $employees = $this->adminRepo->getEmployeeListWhere(
            orderBy: ['id' => 'desc'],
            searchValue: $request['searchValue'],
            filters: ['admin_role_id' => $request['admin_role_id'] ?? 'all'],
            relations: ['role'],
            dataLimit: getWebConfig(name: WebConfigKey::PAGINATION_LIMIT)
        );

        return view(Employee::LIST[VIEW], compact('employees', 'employee_roles'));
    }

    public function getAddView(): View
    {
        $employee_roles = $this->adminRoleRepo->getEmployeeRoleList(dataLimit: 'all');

        return view(Employee::ADD[VIEW], compact('employee_roles'));
    }

    public function add(AdminAddRequest $request, AdminService $adminService): RedirectResponse
    {
        if ($request['role_id'] == 1) {
            Toastr::warning(translate('access_denied'));

            return back();
        }

        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'admin_role_id' => $request['role_id'],
            'identify_type' => $request['identify_type'],
            'identify_number' => $request['identify_number'],
            'identify_image' => $adminService->getIdentityImages(request: $request),
            'password' => bcrypt($request['password']),
            'status' => 1,
            'image' => $adminService->getProceedImage(request: $request),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $this->adminRepo->add(data: $data);
        Toastr::success(translate('employee_added_successfully'));

        // return redirect()->route('admin.employee.list');
        return redirect()->back();
    }
}
