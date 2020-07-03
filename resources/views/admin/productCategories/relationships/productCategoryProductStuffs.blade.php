@can('product_stuff_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.product-stuffs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productStuff.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.productStuff.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-productCategoryProductStuffs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productStuff.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.productStuff.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.productStuff.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.productStuff.fields.stock') }}
                        </th>
                        <th>
                            {{ trans('cruds.productStuff.fields.product_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.productStuff.fields.photos') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productStuffs as $key => $productStuff)
                        <tr data-entry-id="{{ $productStuff->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productStuff->id ?? '' }}
                            </td>
                            <td>
                                {{ $productStuff->name ?? '' }}
                            </td>
                            <td>
                                {{ $productStuff->price ?? '' }}
                            </td>
                            <td>
                                {{ $productStuff->stock ?? '' }}
                            </td>
                            <td>
                                {{ $productStuff->product_category->name ?? '' }}
                            </td>
                            <td>
                                @if($productStuff->photos)
                                    <a href="{{ $productStuff->photos->getUrl() }}" target="_blank">
                                        <img src="{{ $productStuff->photos->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('product_stuff_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.product-stuffs.show', $productStuff->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('product_stuff_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.product-stuffs.edit', $productStuff->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('product_stuff_delete')
                                    <form action="{{ route('admin.product-stuffs.destroy', $productStuff->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_stuff_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-stuffs.massDestroy') }}",
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
  let table = $('.datatable-productCategoryProductStuffs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection