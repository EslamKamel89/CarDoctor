<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return $this->user()->can(['brands.create', 'brands.edit']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name_ar' => [
                'required',
                'string',
                'max:255',
                'unique:brands,name_ar'
            ],
            'name_en' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
                'unique:brands,name_en'
            ],
        ];
    }
    public function attributes(): array {
        return [
            'name_ar' => 'الاسم بالعربية',
            'name_en' => 'الاسم بالإنجليزية',
        ];
    }
}
