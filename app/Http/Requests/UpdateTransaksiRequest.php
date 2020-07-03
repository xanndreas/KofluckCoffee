<?php

namespace App\Http\Requests;

use App\Transaksi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTransaksiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transaksi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'code'    => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'qty'     => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status'  => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}