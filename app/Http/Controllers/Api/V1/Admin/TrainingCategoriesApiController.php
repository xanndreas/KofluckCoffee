<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingCategoryRequest;
use App\Http\Requests\UpdateTrainingCategoryRequest;
use App\Http\Resources\Admin\TrainingCategoryResource;
use App\TrainingCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrainingCategoriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('training_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrainingCategoryResource(TrainingCategory::with(['outlet'])->get());
    }

    public function store(StoreTrainingCategoryRequest $request)
    {
        $trainingCategory = TrainingCategory::create($request->all());

        return (new TrainingCategoryResource($trainingCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TrainingCategory $trainingCategory)
    {
        abort_if(Gate::denies('training_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrainingCategoryResource($trainingCategory->load(['outlet']));
    }

    public function update(UpdateTrainingCategoryRequest $request, TrainingCategory $trainingCategory)
    {
        $trainingCategory->update($request->all());

        return (new TrainingCategoryResource($trainingCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TrainingCategory $trainingCategory)
    {
        abort_if(Gate::denies('training_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}