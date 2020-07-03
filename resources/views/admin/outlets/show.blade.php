@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.outlet.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.outlets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.outlet.fields.id') }}
                        </th>
                        <td>
                            {{ $outlet->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outlet.fields.name') }}
                        </th>
                        <td>
                            {{ $outlet->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outlet.fields.maps') }}
                        </th>
                        <td>
                            {{ $outlet->maps }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outlet.fields.description') }}
                        </th>
                        <td>
                            {!! $outlet->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outlet.fields.est') }}
                        </th>
                        <td>
                            {{ $outlet->est }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.outlets.index') }}">
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
            <a class="nav-link" href="#outlet_training_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.trainingCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#outlet_galleries" role="tab" data-toggle="tab">
                {{ trans('cruds.gallery.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="outlet_training_categories">
            @includeIf('admin.outlets.relationships.outletTrainingCategories', ['trainingCategories' => $outlet->outletTrainingCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="outlet_galleries">
            @includeIf('admin.outlets.relationships.outletGalleries', ['galleries' => $outlet->outletGalleries])
        </div>
    </div>
</div>

@endsection