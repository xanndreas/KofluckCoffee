<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Http\Resources\Admin\OutletResource;
use App\Outlet;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OutletsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('outlet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutletResource(Outlet::all());
    }

    public function store(StoreOutletRequest $request)
    {
        $outlet = Outlet::create($request->all());

        return (new OutletResource($outlet))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Outlet $outlet)
    {
        abort_if(Gate::denies('outlet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutletResource($outlet);
    }

    public function update(UpdateOutletRequest $request, Outlet $outlet)
    {
        $outlet->update($request->all());

        return (new OutletResource($outlet))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Outlet $outlet)
    {
        abort_if(Gate::denies('outlet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outlet->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}