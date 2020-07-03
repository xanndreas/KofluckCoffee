<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTrainingClassRequest;
use App\Http\Requests\UpdateTrainingClassRequest;
use App\Http\Resources\Admin\TrainingClassResource;
use App\TrainingClass;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrainingClassApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('training_class_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrainingClassResource(TrainingClass::with(['training_category'])->get());
    }

    public function store(StoreTrainingClassRequest $request)
    {
        $trainingClass = TrainingClass::create($request->all());

        if ($request->input('photos', false)) {
            $trainingClass->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        return (new TrainingClassResource($trainingClass))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TrainingClass $trainingClass)
    {
        abort_if(Gate::denies('training_class_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrainingClassResource($trainingClass->load(['training_category']));
    }

    public function update(UpdateTrainingClassRequest $request, TrainingClass $trainingClass)
    {
        $trainingClass->update($request->all());

        if ($request->input('photos', false)) {
            if (!$trainingClass->photos || $request->input('photos') !== $trainingClass->photos->file_name) {
                $trainingClass->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
            }
        } elseif ($trainingClass->photos) {
            $trainingClass->photos->delete();
        }

        return (new TrainingClassResource($trainingClass))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TrainingClass $trainingClass)
    {
        abort_if(Gate::denies('training_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingClass->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}