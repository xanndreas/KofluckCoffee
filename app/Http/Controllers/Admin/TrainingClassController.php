<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTrainingClassRequest;
use App\Http\Requests\StoreTrainingClassRequest;
use App\Http\Requests\UpdateTrainingClassRequest;
use App\TrainingCategory;
use App\TrainingClass;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TrainingClassController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('training_class_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TrainingClass::with(['training_category'])->select(sprintf('%s.*', (new TrainingClass)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'training_class_show';
                $editGate      = 'training_class_edit';
                $deleteGate    = 'training_class_delete';
                $crudRoutePart = 'training-classes';

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

            $table->editColumn('photos', function ($row) {
                if ($photo = $row->photos) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->addColumn('training_category_name', function ($row) {
                return $row->training_category ? $row->training_category->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'photos', 'training_category']);

            return $table->make(true);
        }

        return view('admin.trainingClasses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('training_class_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $training_categories = TrainingCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trainingClasses.create', compact('training_categories'));
    }

    public function store(StoreTrainingClassRequest $request)
    {
        $trainingClass = TrainingClass::create($request->all());

        if ($request->input('photos', false)) {
            $trainingClass->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $trainingClass->id]);
        }

        return redirect()->route('admin.training-classes.index');
    }

    public function edit(TrainingClass $trainingClass)
    {
        abort_if(Gate::denies('training_class_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $training_categories = TrainingCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trainingClass->load('training_category');

        return view('admin.trainingClasses.edit', compact('training_categories', 'trainingClass'));
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

        return redirect()->route('admin.training-classes.index');
    }

    public function show(TrainingClass $trainingClass)
    {
        abort_if(Gate::denies('training_class_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingClass->load('training_category', 'trainingClassTrainingCandidates');

        return view('admin.trainingClasses.show', compact('trainingClass'));
    }

    public function destroy(TrainingClass $trainingClass)
    {
        abort_if(Gate::denies('training_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingClass->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrainingClassRequest $request)
    {
        TrainingClass::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('training_class_create') && Gate::denies('training_class_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TrainingClass();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}