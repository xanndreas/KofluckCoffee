<?php

namespace App\Http\Requests;

use App\TrainingCandidate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTrainingCandidateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('training_candidate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'full_name'         => [
                'required',
            ],
            'whatsapp'          => [
                'required',
            ],
            'training_class_id' => [
                'required',
                'integer',
            ],
        ];
    }
}