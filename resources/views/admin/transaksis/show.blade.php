@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transaksi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transaksis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transaksi.fields.id') }}
                        </th>
                        <td>
                            {{ $transaksi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaksi.fields.code') }}
                        </th>
                        <td>
                            {{ $transaksi->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaksi.fields.product_stuff') }}
                        </th>
                        <td>
                            {{ $transaksi->product_stuff->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaksi.fields.user') }}
                        </th>
                        <td>
                            {{ $transaksi->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaksi.fields.qty') }}
                        </th>
                        <td>
                            {{ $transaksi->qty }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaksi.fields.price') }}
                        </th>
                        <td>
                            {{ $transaksi->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaksi.fields.status') }}
                        </th>
                        <td>
                            {{ $transaksi->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transaksis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection