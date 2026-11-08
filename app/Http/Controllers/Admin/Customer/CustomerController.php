<?php

namespace App\Http\Controllers\Admin\Customer;

// use App\Contracts\Repositories\BusinessSettingRepositoryInterface;
use App\Contracts\Repositories\CustomerRepositoryInterface;
// use App\Contracts\Repositories\OrderRepositoryInterface;
// use App\Contracts\Repositories\TranslationRepositoryInterface;
use App\Enums\ViewPaths\Admin\Customer;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\CustomerRequest;
use App\Services\CustomerService;
use App\Traits\PaginatorTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RuntimeException;
use Throwable;

class CustomerController extends BaseController
{
    use PaginatorTrait;

    public function __construct(
        private readonly CustomerRepositoryInterface $customerRepo
    ) {}

    /**
     * @return View Index function is the starting point of a controller
     *              Index function is the starting point of a controller
     */
    public function index(?Request $request, ?string $type = null): View
    {
        return $this->getListView($request);
    }

    public function getListView(Request $request): View
    {
        $customers = $this->customerRepo->getListWhere(
            searchValue: $request->get('searchValue'),
            dataLimit: getWebConfig(name: 'pagination_limit')
        );

        return view(Customer::LIST[VIEW], [
            'customers' => $customers,
        ]);
    }

    public function getAddView(): View
    {
        return view(Customer::ADD[VIEW]);
    }

    public function add(CustomerRequest $request, CustomerService $customerService): RedirectResponse
    {
        $data = $customerService->getCustomerData($request->validated());
        $data['is_active'] = 1;
        $data['image'] = $customerService->storeImage($request->file('image'));

        try {
            $this->customerRepo->add(data: $data);
        } catch (Throwable $exception) {
            try {
                $customerService->deleteStoredImage($data['image']);
            } catch (Throwable $cleanupException) {
                report($cleanupException);
            }

            throw $exception;
        }

        Toastr::success(translate('customer_added_successfully'));

        return redirect()->route('admin.customer.list');
    }

    public function getEditView(string $id): View
    {
        $customer = $this->customerRepo->getFirstWhere(params: ['id' => $id]);

        abort_if($customer === null, 404);

        return view(Customer::EDIT[VIEW], compact('customer'));
    }

    public function update(CustomerRequest $request, string $id, CustomerService $customerService): RedirectResponse
    {
        $customer = $this->customerRepo->getFirstWhere(params: ['id' => $id]);

        abort_if($customer === null, 404);

        $data = $customerService->getCustomerData($request->validated());
        $data['updated_at'] = now();
        $newImage = $customerService->storeImage($request->file('image'));

        if ($newImage !== null) {
            $data['image'] = $newImage;
        }

        try {
            $wasUpdated = $this->customerRepo->update(id: $id, data: $data);

            if (! $wasUpdated && $this->customerRepo->getFirstWhere(params: ['id' => $id]) === null) {
                throw new RuntimeException('Customer could not be updated.');
            }
        } catch (Throwable $exception) {
            try {
                $customerService->deleteStoredImage($newImage);
            } catch (Throwable $cleanupException) {
                report($cleanupException);
            }

            throw $exception;
        }

        if ($newImage !== null) {
            $customerService->deleteImage($customer);
        }

        Toastr::success(translate('customer_updated_successfully'));

        return redirect()->route('admin.customer.list');
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $this->customerRepo->update(id: $request['id'], data: ['is_active' => $request->get('status', 0)]);
        $this->customerRepo->deleteAuthAccessTokens(id: $request['id']);

        return response()->json(['message' => translate('update_successfully')]);
    }

    public function getView(Request $request, $id): View|RedirectResponse
    {
        $customer = $this->customerRepo->getFirstWhere(params: ['id' => $id]);
        if (isset($customer)) {
            $orders = $this->orderRepo->getListWhere(searchValue: $request['searchValue'], filters: ['customer_id' => $id, 'is_guest' => '0']);

            return view(Customer::VIEW[VIEW], ['customer' => $customer, 'orders' => $orders]);
        }
        Toastr::error(translate('customer_Not_Found'));

        return back();
    }

    public function delete($id, CustomerService $customerService): RedirectResponse
    {
        $customer = $this->customerRepo->getFirstWhere(params: ['id' => $id]);

        if ($customer === null) {
            Toastr::error(translate('customer_Not_Found'));

            return back();
        }

        $this->customerRepo->delete(params: ['id' => $id]);
        $customerService->deleteImage(customer: $customer);

        Toastr::success(translate('customer_deleted_successfully'));

        return back();
    }
}
