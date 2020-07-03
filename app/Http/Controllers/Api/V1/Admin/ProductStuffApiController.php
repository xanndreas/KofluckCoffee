<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductStuffRequest;
use App\Http\Requests\UpdateProductStuffRequest;
use App\Http\Resources\Admin\ProductStuffResource;
use App\ProductStuff;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductStuffApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_stuff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductStuffResource(ProductStuff::with(['product_category'])->get());
    }

    public function store(StoreProductStuffRequest $request)
    {
        $productStuff = ProductStuff::create($request->all());

        if ($request->input('photos', false)) {
            $productStuff->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        return (new ProductStuffResource($productStuff))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductStuff $productStuff)
    {
        abort_if(Gate::denies('product_stuff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductStuffResource($productStuff->load(['product_category']));
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

        return (new ProductStuffResource($productStuff))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductStuff $productStuff)
    {
        abort_if(Gate::denies('product_stuff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productStuff->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}