@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trainingCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.training-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $trainingCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $trainingCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainingCategory.fields.outlet') }}
                        </th>
                        <td>
                            {{ $trainingCategory->outlet->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.training-categories.index') }}">
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
            <a class="nav-link" href="#training_category_training_classes" role="tab" data-toggle="tab">
                {{ trans('cruds.trainingClass.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="training_category_training_classes">
            @includeIf('admin.trainingCategories.relationships.trainingCategoryTrainingClasses', ['trainingClasses' => $trainingCategory->trainingCategoryTrainingClasses])
        </div>
    </div>
</div>

@endsection