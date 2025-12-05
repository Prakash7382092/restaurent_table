<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ];

        if ($this->routeIs('*.registerVendor') || str_contains($this->path(), 'vendor')) {
            $rules['store_name'] = ['required', 'string', 'max:255'];
            $rules['store_description'] = ['nullable', 'string', 'max:1000'];
            $rules['store_location'] = ['nullable', 'string', 'max:255'];
            $rules['store_contact'] = ['nullable', 'string', 'max:255'];
        }

        return $rules;
    }
}
