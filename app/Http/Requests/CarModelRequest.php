<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarModelRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        if (request()->routeIs('car-models.store')) {
            return auth()->user()->can('car_models.create');
        }

        if (request()->routeIs('car-models.update')) {
            return auth()->user()->can('car_models.edit');
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        // dd(request()->route('car_model'));
        return [
            'brand_id' => 'required|exists:brands,id',
            'name_ar' => [
                "required",
                "string",
                "max:255",
                Rule::unique('car_models', 'name_ar')->ignore(request()->route('car_model')->id ?? null)
            ],
            'name_en' => [
                "sometimes",
                "nullable",
                "string",
                "max:255",
                Rule::unique('car_models', 'name_en')->ignore(request()->route('car_model')->id ?? null)
            ],
            'year_range' => 'required|array|size:2',
            'year_range.0' => 'required|integer|min:1900|max:2100',
            'year_range.1' => 'required|integer|gte:year_range.0|max:2100',
        ];
    }
}
