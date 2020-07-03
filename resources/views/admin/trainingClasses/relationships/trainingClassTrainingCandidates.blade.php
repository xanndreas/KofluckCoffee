@can('training_candidate_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.training-candidates.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.trainingCandidate.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.trainingCandidate.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-trainingClassTrainingCandidates">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.trainingCandidate.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainingCandidate.fields.full_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainingCandidate.fields.whatsapp') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainingCandidate.fields.training_class') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainingCandidate.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trainingCandidates as $key => $trainingCandidate)
                        <tr data-entry-id="{{ $trainingCandidate->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $trainingCandidate->id ?? '' }}
                            </td>
                            <td>
                                {{ $trainingCandidate->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $trainingCandidate->whatsapp ?? '' }}
                            </td>
                            <td>
                                {{ $trainingCandidate->training_class->name ?? '' }}
                            </td>
                            <td>
                                {{ $trainingCandidate->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $trainingCandidate->user->email ?? '' }}
                            </td>
                            <td>
                                @can('training_candidate_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.training-candidates.show', $trainingCandidate->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('training_candidate_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.training-candidates.edit', $trainingCandidate->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('training_candidate_delete')
                                    <form action="{{ route('admin.training-candidates.destroy', $trainingCandidate->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('training_candidate_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.training-candidates.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-trainingClassTrainingCandidates:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection