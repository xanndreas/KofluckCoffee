<?php

namespace App\Http\Requests;

use App\TrainingCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTrainingCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('training_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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