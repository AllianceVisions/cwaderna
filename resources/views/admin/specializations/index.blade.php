@extends('layouts.admin')
@section('content')
@can('specialization_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.specializations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.specialization.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.specialization.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Specialization">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.specialization.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialization.fields.name_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialization.fields.name_ar') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($specializations as $key => $specialization)
                        <tr data-entry-id="{{ $specialization->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $specialization->id ?? '' }}
                            </td>
                            <td>
                                {{ $specialization->name_en ?? '' }}
                            </td>
                            <td>
                                {{ $specialization->name_ar ?? '' }}
                            </td>
                            <td>
                                @can('specialization_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.specializations.show', $specialization->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('specialization_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.specializations.edit', $specialization->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('specialization_delete')
                                    <form action="{{ route('admin.specializations.destroy', $specialization->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        let table = $('.datatable-Specialization:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
    })

</script>
@endsection