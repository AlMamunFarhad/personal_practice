<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Contracts\Repositories\AdminRepositoryInterface;
use App\Contracts\Repositories\AdminRoleRepositoryInterface;
use App\Enums\ViewPaths\Admin\Employee;
use App\Enums\WebConfigKey;
use App\Exports\EmployeeListExport;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminAddRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Services\AdminService;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Enums\ExportFileNames\Admin\Customer as CustomerExport;

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
        return redirect()->route('admin.employee.list');
    }

        public function getUpdateView($id): View
    {
        $employee = $this->adminRepo->getFirstWhere(params:['id' => $id]);
        $adminRoles = $this->adminRoleRepo->getEmployeeRoleList(dataLimit: 'all');
        return view(Employee::UPDATE[VIEW], compact('adminRoles', 'employee'));
    }

        public function getView(Request $request): View
    {
        $employee = $this->adminRepo->getFirstWhere(params:['id' => $request['id']], relations:['role']);
        // dd($employee->role->module_access);
        return view(Employee::VIEW[VIEW], compact('employee'));
    }

    public function update(AdminUpdateRequest $request, AdminService $adminService): RedirectResponse
    {
        if ($request['role_id'] == 1) {
            Toastr::warning(translate('access_denied'));
            return back();
        }
        $employee = $this->adminRepo->getFirstWhere(params:['id' => $request['id']]);
        $identity_image = [];
        if ($request->file('identity_image')) {
            $identity_image = $adminService->getIdentityImages(request: $request, oldImages: $employee);
        }

        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'admin_role_id' => $request['role_id'],
            'password' => $request['password'] ? bcrypt($request['password']) : $employee['password'],
            'image' => $request->file('image') ? $adminService->getProceedImage(request:$request, oldImage:$employee['image']) : $employee['image'],
            'identify_image' => $request->file('identity_image') ? $identity_image : $employee['identify_image'],
            'identify_type' => $request['identify_type'],
            'identify_number' => $request['identify_number'],
            'updated_at' => now(),
        ];

        $this->adminRepo->update(id:$request['id'], data: $data);
        Toastr::success(translate('employee_updated_successfully'));
        return redirect()->route('admin.employee.list');
    }

    public function updateStatus(Request $request): RedirectResponse|JsonResponse
    {
        $this->adminRepo->update(id:$request['id'], data:['status'=> $request->get('status', 0)]);
        if($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => translate('Status_Updated'),
            ]);
        }
        Toastr::success(translate('Status_Updated'));
        return back();
    }

    public function delete($id): RedirectResponse
    {
        $employee = $this->adminRepo->getFirstWhere(params:['id' => $id]);

        // Prevent deletion of super admin (role_id = 1)
        if ($employee && isset($employee->admin_role_id) && $employee->admin_role_id == 1) {
            Toastr::warning(translate('access_denied'));
            return back();
        }

        // Delete employee image if exists
        if ($employee && $employee->image) {
            $imagePath = storage_path('app/public/admin/' . $employee->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete identity images if exist
        if ($employee && $employee->identify_image) {
            $identityImages = json_decode($employee->identify_image, true);
            if (is_array($identityImages)) {
                foreach ($identityImages as $image) {
                    $imagePath = storage_path('app/public/admin/' . $image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
        }

        $this->adminRepo->delete(params:['id' => $id]);
        Toastr::success(translate('employee_deleted_successfully'));
        return redirect()->route('admin.employee.list');
    }

    public function exportList(Request $request): BinaryFileResponse
    {
        $employees = $this->adminRepo->getEmployeeListWhere(
            searchValue: $request['searchValue'],
            filters: ['admin_role_id' => $request['role']],
            relations: ['role'],
            dataLimit: 'all');
        $active = $employees->where('status',1)->count();
        $inactive = $employees->where('status',0)->count();

        $filter = 'all';
        if($request->has('role') &&  $request['role'] != 'all') {
            $filter = $this->adminRoleRepo->getFirstWhere(params:['id'=>$request['role']])['name'];
        }

        $data = [
            'employees' => $employees,
            'search' => $request['searchValue'],
            'active' => $active,
            'inactive' => $inactive,
            'filter' => $filter
        ];

        return Excel::download(new EmployeeListExport($data), CustomerExport::EMPLOYEES_LIST_XLSX);
    }

}
