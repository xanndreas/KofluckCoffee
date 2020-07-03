@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productStuff.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-stuffs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productStuff.fields.id') }}
                        </th>
                        <td>
                            {{ $productStuff->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productStuff.fields.name') }}
                        </th>
                        <td>
                            {{ $productStuff->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productStuff.fields.price') }}
                        </th>
                        <td>
                            {{ $productStuff->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productStuff.fields.stock') }}
                        </th>
                        <td>
                            {{ $productStuff->stock }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productStuff.fields.product_category') }}
                        </th>
                        <td>
                            {{ $productStuff->product_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productStuff.fields.photos') }}
                        </th>
                        <td>
                            @if($productStuff->photos)
                                <a href="{{ $productStuff->photos->getUrl() }}" target="_blank">
                                    <img src="{{ $productStuff->photos->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-stuffs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#product_stuff_transaksis" role="tab" data-toggle="tab">
                {{ trans('cruds.transaksi.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="product_stuff_transaksis">
            @includeIf('admin.productStuffs.relationships.productStuffTransaksis', ['transaksis' => $productStuff->productStuffTransaksis])
        </div>
    </div>
</div>

@endsection