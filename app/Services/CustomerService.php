<?php

namespace App\Services;

use App\Traits\FileManagerTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use RuntimeException;

class CustomerService
{
    use FileManagerTrait;

    /**
     * @param  array{name: string, email: string, phone: string, password?: string|null}  $validatedData
     * @return array<string, mixed>
     */
    public function getCustomerData(array $validatedData): array
    {
        $customerData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ];

        if (isset($validatedData['password']) && $validatedData['password'] !== '') {
            $customerData['password'] = Hash::make($validatedData['password']);
        }

        return $customerData;
    }

    public function storeImage(?UploadedFile $image): ?string
    {
        return $image === null ? null : $this->upload('profile/', 'webp', $image);
    }

    public function deleteImage(?object $customer): void
    {
        if ($customer === null || empty($customer->image) || $customer->image === 'def.png') {
            return;
        }

        $this->deleteStoredImage($customer->image);
    }

    public function deleteStoredImage(?string $image): void
    {
        if ($image === null || $image === '' || $image === 'def.png') {
            return;
        }

        if (str_contains($image, '/') || str_contains($image, '\\')) {
            throw new InvalidArgumentException('Customer image must be a filename.');
        }

        $disk = Storage::disk('public');
        $path = 'profile/'.$image;

        if ($disk->exists($path) && ! $disk->delete($path)) {
            throw new RuntimeException('Unable to delete the customer profile image.');
        }
    }
}
