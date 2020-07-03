<?php

namespace App\Http\Requests;

use App\ProductStuff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateProductStuffRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_stuff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'                => [
                'required',
            ],
            'stock'               => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'product_category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}