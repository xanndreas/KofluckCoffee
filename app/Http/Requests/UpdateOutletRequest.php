<?php

namespace App\Http\Requests;

use App\Outlet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOutletRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('outlet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'maps' => [
                'required',
            ],
            'est'  => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}