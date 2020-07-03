<?php

namespace App\Http\Requests;

use App\TrainingCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTrainingCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('training_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'      => [
                'required',
            ],
            'outlet_id' => [
                'required',
                'integer',
            ],
        ];
    }
}