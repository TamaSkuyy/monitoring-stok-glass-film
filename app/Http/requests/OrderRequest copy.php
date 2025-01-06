<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ID_order' => 'required',
            'Tanggal_order' => 'required',
            'Status_Order' => 'required',
            'barang_id' => 'required|array',
            'Jumlah_Order' => 'required|array',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ID_order.required' => 'ID Order harus diisi',
            'Tanggal_order.required' => 'Tanggal Order harus diisi',
            'Status_Order.required' => 'Status Order harus diisi',
            'barang_id.required' => 'Barang harus diisi',
            'Jumlah_Order.required' => 'Jumlah Order harus diisi',
        ];
    }
}