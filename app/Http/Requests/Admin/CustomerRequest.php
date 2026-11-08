<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $customerId = $this->route('id');
        $emailRule = Rule::unique('users', 'email');
        $phoneRule = Rule::unique('users', 'phone');

        if ($customerId !== null) {
            $emailRule->ignore($customerId);
            $phoneRule->ignore($customerId);
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                $emailRule,
            ],
            'phone' => [
                'required',
                'string',
                'max:25',
                $phoneRule,
            ],
            'password' => [
                $customerId === null ? 'required' : 'nullable',
                'string',
                'min:8',
            ],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ];
    }
}
