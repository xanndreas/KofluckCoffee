@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.trainingCandidate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.training-candidates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.trainingCandidate.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trainingCandidate.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="whatsapp">{{ trans('cruds.trainingCandidate.fields.whatsapp') }}</label>
                <input class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}" type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', '') }}" required>
                @if($errors->has('whatsapp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('whatsapp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trainingCandidate.fields.whatsapp_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="training_class_id">{{ trans('cruds.trainingCandidate.fields.training_class') }}</label>
                <select class="form-control select2 {{ $errors->has('training_class') ? 'is-invalid' : '' }}" name="training_class_id" id="training_class_id" required>
                    @foreach($training_classes as $id => $training_class)
                        <option value="{{ $id }}" {{ old('training_class_id') == $id ? 'selected' : '' }}>{{ $training_class }}</option>
                    @endforeach
                </select>
                @if($errors->has('training_class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('training_class') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trainingCandidate.fields.training_class_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.trainingCandidate.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trainingCandidate.fields.user_helper') }}</span>
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