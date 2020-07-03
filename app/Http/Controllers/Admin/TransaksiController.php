<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransaksiRequest;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\ProductStuff;
use App\Transaksi;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('transaksi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Transaksi::with(['product_stuff', 'user'])->select(sprintf('%s.*', (new Transaksi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'transaksi_show';
                $editGate      = 'transaksi_edit';
                $deleteGate    = 'transaksi_delete';
                $crudRoutePart = 'transaksis';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : "";
            });
            $table->addColumn('product_stuff_name', function ($row) {
                return $row->product_stuff ? $row->product_stuff->name : '';
            });

            $table->editColumn('product_stuff.price', function ($row) {
                return $row->product_stuff ? (is_string($row->product_stuff) ? $row->product_stuff : $row->product_stuff->price) : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('qty', function ($row) {
                return $row->qty ? $row->qty : "";
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'product_stuff', 'user']);

            return $table->make(true);
        }

        return view('admin.transaksis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transaksi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_stuffs = ProductStuff::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transaksis.create', compact('product_stuffs', 'users'));
    }

    public function store(StoreTransaksiRequest $request)
    {
        $transaksi = Transaksi::create($request->all());

        return redirect()->route('admin.transaksis.index');
    }

    public function edit(Transaksi $transaksi)
    {
        abort_if(Gate::denies('transaksi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_stuffs = ProductStuff::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaksi->load('product_stuff', 'user');

        return view('admin.transaksis.edit', compact('product_stuffs', 'users', 'transaksi'));
    }

    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        $transaksi->update($request->all());

        return redirect()->route('admin.transaksis.index');
    }

    public function show(Transaksi $transaksi)
    {
        abort_if(Gate::denies('transaksi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaksi->load('product_stuff', 'user');

        return view('admin.transaksis.show', compact('transaksi'));
    }

    public function destroy(Transaksi $transaksi)
    {
        abort_if(Gate::denies('transaksi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaksi->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransaksiRequest $request)
    {
        Transaksi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}