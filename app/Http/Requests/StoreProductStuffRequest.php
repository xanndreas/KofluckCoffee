<?php

namespace App\Http\Requests;

use App\ProductStuff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreProductStuffRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_stuff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            ],
            'product_category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}