<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingCandidateRequest;
use App\Http\Requests\UpdateTrainingCandidateRequest;
use App\Http\Resources\Admin\TrainingCandidateResource;
use App\TrainingCandidate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrainingCandidateApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('training_candidate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrainingCandidateResource(TrainingCandidate::with(['training_class', 'user'])->get());
    }

    public function store(StoreTrainingCandidateRequest $request)
    {
        $trainingCandidate = TrainingCandidate::create($request->all());

        return (new TrainingCandidateResource($trainingCandidate))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TrainingCandidate $trainingCandidate)
    {
        abort_if(Gate::denies('training_candidate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrainingCandidateResource($trainingCandidate->load(['training_class', 'user']));
    }

    public function update(UpdateTrainingCandidateRequest $request, TrainingCandidate $trainingCandidate)
    {
        $trainingCandidate->update($request->all());

        return (new TrainingCandidateResource($trainingCandidate))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TrainingCandidate $trainingCandidate)
    {
        abort_if(Gate::denies('training_candidate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingCandidate->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}