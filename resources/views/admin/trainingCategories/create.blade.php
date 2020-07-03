@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.trainingCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.training-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.trainingCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trainingCategory.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="outlet_id">{{ trans('cruds.trainingCategory.fields.outlet') }}</label>
                <select class="form-control select2 {{ $errors->has('outlet') ? 'is-invalid' : '' }}" name="outlet_id" id="outlet_id" required>
                    @foreach($outlets as $id => $outlet)
                        <option value="{{ $id }}" {{ old('outlet_id') == $id ? 'selected' : '' }}>{{ $outlet }}</option>
                    @endforeach
                </select>
                @if($errors->has('outlet'))
                    <div class="invalid-feedback">
                        {{ $errors->first('outlet') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trainingCategory.fields.outlet_helper') }}</span>
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