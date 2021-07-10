@extends('layouts.admin')
@section('content')
@can('item_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.items.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.item.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.item.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Item">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.item.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.provider_man') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $key => $item)
                        <tr data-entry-id="{{ $item->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $item->id ?? '' }}
                            </td>
                            <td>
                                @php $name = 'name_'.app()->getLocale();@endphp
                                {{ $item->category->$name ?? '' }}
                            </td>
                            <td>
                                {{ $item->provider_man->user ? $item->provider_man->user->email  : '' }}
                            </td>
                            <td>
                                {{ $item->title ?? '' }}
                            </td>
                            <td>
                                {{ $item->description ?? '' }}
                            </td>
                            <td>
                                {{ $item->price ?? '' }}
                            </td>
                            <td>
                                @if($item->photo)
                                    <a href="{{ asset($item->photo->getUrl()) }}" target="_blank" style="display: inline-block">
                                        <img src="{{ asset($item->photo->getUrl('thumb')) }}">
                                    </a>
                                @endif
                            </td>
                            <td> 
                                @can('item_edit')
                                    <a href="{{ route('admin.items.edit', $item->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit"   title="{{ trans('global.edit') }}"><i  class="fa fa-edit actions-custom-i"></i></a>
                                @endcan

                                @can('item_delete')
                                    <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button  class="btn btn-outline-danger btn-pill action-buttons-delete"  type="submit" title="{{ trans('global.delete') }}" ><i  class="fa fa-trash actions-custom-i"></i> </button>
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });
        let table = $('.datatable-Item:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
    })

</script>
@endsection
