<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductStuffRequest;
use App\Http\Requests\StoreProductStuffRequest;
use App\Http\Requests\UpdateProductStuffRequest;
use App\ProductCategory;
use App\ProductStuff;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductStuffController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_stuff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductStuff::with(['product_category'])->select(sprintf('%s.*', (new ProductStuff)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_stuff_show';
                $editGate      = 'product_stuff_edit';
                $deleteGate    = 'product_stuff_delete';
                $crudRoutePart = 'product-stuffs';

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
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->editColumn('stock', function ($row) {
                return $row->stock ? $row->stock : "";
            });
            $table->addColumn('product_category_name', function ($row) {
                return $row->product_category ? $row->product_category->name : '';
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

            $table->rawColumns(['actions', 'placeholder', 'product_category', 'photos']);

            return $table->make(true);
        }

        return view('admin.productStuffs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_stuff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_categories = ProductCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productStuffs.create', compact('product_categories'));
    }

    public function store(StoreProductStuffRequest $request)
    {
        $productStuff = ProductStuff::create($request->all());

        if ($request->input('photos', false)) {
            $productStuff->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productStuff->id]);
        }

        return redirect()->route('admin.product-stuffs.index');
    }

    public function edit(ProductStuff $productStuff)
    {
        abort_if(Gate::denies('product_stuff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_categories = ProductCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productStuff->load('product_category');

        return view('admin.productStuffs.edit', compact('product_categories', 'productStuff'));
    }

    public function update(UpdateProductStuffRequest $request, ProductStuff $productStuff)
    {
        $productStuff->update($request->all());

        if ($request->input('photos', false)) {
            if (!$productStuff->photos || $request->input('photos') !== $productStuff->photos->file_name) {
                $productStuff->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
            }
        } elseif ($productStuff->photos) {
            $productStuff->photos->delete();
        }

        return redirect()->route('admin.product-stuffs.index');
    }

    public function show(ProductStuff $productStuff)
    {
        abort_if(Gate::denies('product_stuff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productStuff->load('product_category', 'productStuffTransaksis');

        return view('admin.productStuffs.show', compact('productStuff'));
    }

    public function destroy(ProductStuff $productStuff)
    {
        abort_if(Gate::denies('product_stuff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productStuff->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductStuffRequest $request)
    {
        ProductStuff::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_stuff_create') && Gate::denies('product_stuff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductStuff();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}