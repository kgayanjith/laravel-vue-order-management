<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'boolean'],
            'order.customer_id' => ['required', 'exists:customers,id'],
            'order.invoiceNo' => ['required', 'string'],
            'order.invoiceDate' => ['required', 'date'],
            'order.referenceNo' => ['nullable', 'string'],
            'order.note' => ['nullable', 'string'],

            'order.product_id' => ['required', 'exists:products,id'],
            'order.product_note' => ['nullable', 'string'],
            'order.quantity' => ['required', 'numeric', 'min:1'],
            'order.tax' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
