<?php

namespace App\Http\Requests;

use App\TrainingClass;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTrainingClassRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('training_class_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'                 => [
                'required',
            ],
            'description'          => [
                'required',
            ],
            'start_date'           => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'end_date'             => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'training_category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}