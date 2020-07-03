<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOutletRequest;
use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Outlet;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OutletsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('outlet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Outlet::query()->select(sprintf('%s.*', (new Outlet)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'outlet_show';
                $editGate      = 'outlet_edit';
                $deleteGate    = 'outlet_delete';
                $crudRoutePart = 'outlets';

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
            $table->editColumn('maps', function ($row) {
                return $row->maps ? $row->maps : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.outlets.index');
    }

    public function create()
    {
        abort_if(Gate::denies('outlet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.outlets.create');
    }

    public function store(StoreOutletRequest $request)
    {
        $outlet = Outlet::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $outlet->id]);
        }

        return redirect()->route('admin.outlets.index');
    }

    public function edit(Outlet $outlet)
    {
        abort_if(Gate::denies('outlet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.outlets.edit', compact('outlet'));
    }

    public function update(UpdateOutletRequest $request, Outlet $outlet)
    {
        $outlet->update($request->all());

        return redirect()->route('admin.outlets.index');
    }

    public function show(Outlet $outlet)
    {
        abort_if(Gate::denies('outlet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outlet->load('outletTrainingCategories', 'outletGalleries');

        return view('admin.outlets.show', compact('outlet'));
    }

    public function destroy(Outlet $outlet)
    {
        abort_if(Gate::denies('outlet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outlet->delete();

        return back();
    }

    public function massDestroy(MassDestroyOutletRequest $request)
    {
        Outlet::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('outlet_create') && Gate::denies('outlet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Outlet();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}