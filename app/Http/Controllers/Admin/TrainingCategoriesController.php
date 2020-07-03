<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTrainingCategoryRequest;
use App\Http\Requests\StoreTrainingCategoryRequest;
use App\Http\Requests\UpdateTrainingCategoryRequest;
use App\Outlet;
use App\TrainingCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TrainingCategoriesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('training_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TrainingCategory::with(['outlet'])->select(sprintf('%s.*', (new TrainingCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'training_category_show';
                $editGate      = 'training_category_edit';
                $deleteGate    = 'training_category_delete';
                $crudRoutePart = 'training-categories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->addColumn('outlet_name', function ($row) {
                return $row->outlet ? $row->outlet->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'outlet']);

            return $table->make(true);
        }

        return view('admin.trainingCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('training_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outlets = Outlet::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trainingCategories.create', compact('outlets'));
    }

    public function store(StoreTrainingCategoryRequest $request)
    {
        $trainingCategory = TrainingCategory::create($request->all());

        return redirect()->route('admin.training-categories.index');
    }

    public function edit(TrainingCategory $trainingCategory)
    {
        abort_if(Gate::denies('training_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outlets = Outlet::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trainingCategory->load('outlet');

        return view('admin.trainingCategories.edit', compact('outlets', 'trainingCategory'));
    }

    public function update(UpdateTrainingCategoryRequest $request, TrainingCategory $trainingCategory)
    {
        $trainingCategory->update($request->all());

        return redirect()->route('admin.training-categories.index');
    }

    public function show(TrainingCategory $trainingCategory)
    {
        abort_if(Gate::denies('training_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingCategory->load('outlet', 'trainingCategoryTrainingClasses');

        return view('admin.trainingCategories.show', compact('trainingCategory'));
    }

    public function destroy(TrainingCategory $trainingCategory)
    {
        abort_if(Gate::denies('training_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrainingCategoryRequest $request)
    {
        TrainingCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}