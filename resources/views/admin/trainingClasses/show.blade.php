@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trainingClass.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.training-classes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingClass.fields.id') }}
                        </th>
                        <td>
                            {{ $trainingClass->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingClass.fields.name') }}
                        </th>
                        <td>
                            {{ $trainingClass->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingClass.fields.description') }}
                        </th>
                        <td>
                            {!! $trainingClass->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingClass.fields.start_date') }}
                        </th>
                        <td>
                            {{ $trainingClass->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingClass.fields.end_date') }}
                        </th>
                        <td>
                            {{ $trainingClass->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingClass.fields.photos') }}
                        </th>
                        <td>
                            @if($trainingClass->photos)
                                <a href="{{ $trainingClass->photos->getUrl() }}" target="_blank">
                                    <img src="{{ $trainingClass->photos->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingClass.fields.training_category') }}
                        </th>
                        <td>
                            {{ $trainingClass->training_category->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.training-classes.index') }}">
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
            <a class="nav-link" href="#training_class_training_candidates" role="tab" data-toggle="tab">
                {{ trans('cruds.trainingCandidate.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="training_class_training_candidates">
            @includeIf('admin.trainingClasses.relationships.trainingClassTrainingCandidates', ['trainingCandidates' => $trainingClass->trainingClassTrainingCandidates])
        </div>
    </div>
</div>

@endsection