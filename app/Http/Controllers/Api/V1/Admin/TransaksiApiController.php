<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Http\Resources\Admin\TransaksiResource;
use App\Transaksi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransaksiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaksi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransaksiResource(Transaksi::with(['product_stuff', 'user'])->get());
    }

    public function store(StoreTransaksiRequest $request)
    {
        $transaksi = Transaksi::create($request->all());

        return (new TransaksiResource($transaksi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Transaksi $transaksi)
    {
        abort_if(Gate::denies('transaksi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransaksiResource($transaksi->load(['product_stuff', 'user']));
    }

    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        $transaksi->update($request->all());

        return (new TransaksiResource($transaksi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Transaksi $transaksi)
    {
        abort_if(Gate::denies('transaksi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaksi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}