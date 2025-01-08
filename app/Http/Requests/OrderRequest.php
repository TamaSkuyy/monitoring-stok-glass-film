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
            'kode_order' => 'required',
            'tanggal_order' => 'required|date',
            'status_order' => 'required',
            // 'barang_id' => 'required|array',
            // 'jumlah_order' => 'required|array',
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
            'kode_order.required' => 'Kode Order harus diisi',
            'kode_order.unique' => 'Kode Order sudah ada',
            'tanggal_order.required' => 'Tanggal Order harus diisi',
            'status_order.required' => 'Status Order harus diisi',
            'barang_id.required' => 'Barang harus diisi',
            'jumlah_order.required' => 'Jumlah Order harus diisi',
        ];
    }
}
