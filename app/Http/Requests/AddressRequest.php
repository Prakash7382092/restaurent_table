<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     *
     * For store (no route model) fields are required.
     * For update (route contains 'address') fields are validated with "sometimes" so partial updates are allowed.
     */
    public function rules(): array
    {
        $isUpdate = $this->route('address') !== null;

        $addressLineRule = $isUpdate ? ['sometimes', 'required', 'string', 'max:255'] : ['required', 'string', 'max:255'];
        $cityRule = $isUpdate ? ['sometimes', 'required', 'string', 'max:120'] : ['required', 'string', 'max:120'];
        $stateRule = $isUpdate ? ['sometimes', 'required', 'string', 'max:120'] : ['required', 'string', 'max:120'];
        $zipRule = $isUpdate ? ['sometimes', 'required', 'string', 'max:30'] : ['required', 'string', 'max:30'];
        $countryRule = $isUpdate ? ['sometimes', 'required', 'string', 'max:120'] : ['required', 'string', 'max:120'];
        $defaultRule = $isUpdate ? ['sometimes', 'boolean'] : ['nullable', 'boolean'];

        return [
            'address_line_1' => $addressLineRule,
            'city' => $cityRule,
            'state' => $stateRule,
            'zip_code' => $zipRule,
            'country' => $countryRule,
            'is_default' => $defaultRule,
        ];
    }

    /**
     * Return JSON on validation failure for API behaviour.
     */
    protected function failedValidation(Validator $validator): void
    {
        $response = response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
