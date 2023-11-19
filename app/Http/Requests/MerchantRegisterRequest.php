<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantRegisterRequest extends FormRequest
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
        return [
            'full_name' => ['required', 'string', 'max:50'],
            'country_code' => ['required', 'integer'],
            'mobile' => ['required', 'string', 'unique:merchants'],
            'email' => ['email', 'string', 'unique:merchants'],
            'password' => ['required', 'string'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'area' => ['required', 'string'],
            'address' => ['required', 'string'],
            'currency_id' => ['required'],
            'document_type' => ['required'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:3072'],
            // 'document' => ['image', 'mimes:png,jpg,jpeg', 'max:3072'],
        ];
    }
}
