<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditNoteRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        if (request()->routeIs('credit_notes.store')) {
            return auth()->user()->can('returns.customer.create');
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'invoice_id' => 'required|exists:invoices,id',
            'reason_ar' => 'required|string',
            'reason_en' => 'required|string',
            'payment_refund_method' => 'required|in:cash,card,no-refund',
            'items' => 'required|array',
            'items.*.invoice_item_id' => 'required|exists:invoice_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.refunded_amount' => 'required|numeric|min:0',
            'items.*.is_damaged' => 'boolean', // if true → write_off, not resalable
        ];
    }
    public function attributes(): array {
        return [
            'invoice_id' => 'الفاتورة',
            'reason_ar' => 'السبب (عربي)',
            'reason_en' => 'السبب (إنجليزي)',
            'payment_refund_method' => 'طريقة الاسترداد',
            'items' => 'البنود',
        ];
    }
}
