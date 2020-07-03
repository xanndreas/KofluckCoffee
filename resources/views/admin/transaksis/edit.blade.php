@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.transaksi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaksis.update", [$transaksi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.transaksi.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $transaksi->code) }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaksi.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_stuff_id">{{ trans('cruds.transaksi.fields.product_stuff') }}</label>
                <select class="form-control select2 {{ $errors->has('product_stuff') ? 'is-invalid' : '' }}" name="product_stuff_id" id="product_stuff_id">
                    @foreach($product_stuffs as $id => $product_stuff)
                        <option value="{{ $id }}" {{ ($transaksi->product_stuff ? $transaksi->product_stuff->id : old('product_stuff_id')) == $id ? 'selected' : '' }}>{{ $product_stuff }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_stuff'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_stuff') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaksi.fields.product_stuff_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.transaksi.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($transaksi->user ? $transaksi->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaksi.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="qty">{{ trans('cruds.transaksi.fields.qty') }}</label>
                <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" type="number" name="qty" id="qty" value="{{ old('qty', $transaksi->qty) }}" step="1" required>
                @if($errors->has('qty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaksi.fields.qty_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.transaksi.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $transaksi->price) }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaksi.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.transaksi.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', $transaksi->status) }}" step="1" required>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaksi.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection