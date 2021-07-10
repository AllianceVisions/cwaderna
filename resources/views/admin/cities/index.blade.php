@extends('layouts.admin')
@section('content')

@section('styles')
<style>
.dataTables_scrollBody, .dataTables_wrapper {
    position: static !important;
}
.dropdown-button {
    cursor: pointer;
    font-size: 2em;
    display:block
}
.dropdown-menu i {
    font-size: 1.33333333em;
    line-height: 0.75em;
    vertical-align: -15%;
    color: #000;
}
</style>
@endsection

@can('city_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cities.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.city.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.city.title') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-city">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.city.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.city.fields.name_ar') }}
                        </th>
                        <th>
                            {{ trans('cruds.city.fields.name_en') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cities as $key => $city)
                        <tr data-entry-id="{{ $city->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $city->id ?? '' }}
                            </td>
                            <td>
                                {{ $city->name_ar ?? '' }}
                            </td>
                            <td>
                                {{ $city->name_en ?? '' }}
                            </td>
                            <td>  
                                @can('city_edit')
                                    <a  href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit" title="{{ trans('global.edit') }}" style="display: inline"> 
                                        <i class="fa fa-edit actions-custom-i"></i>
                                        
                                    </a>
                                @endcan
                                
                                @can('city_delete')
                                    <form style="display: inline" id="delete-{{ $city->id }}" action="{{ route('admin.cities.destroy', $city->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <a style="display: inline" title="{{ trans('global.delete') }}" class="btn btn-outline-danger btn-pill action-buttons-delete"  href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $city->id }}').submit()">
                                        <i class="fa fa-trash actions-custom-i"></i>
                                        
                                    </a>
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
            pageLength: 25,
        });
        let table = $('.datatable-city:not(.ajaxTable)').DataTable({ 
                buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    
    })

</script>
@endsection