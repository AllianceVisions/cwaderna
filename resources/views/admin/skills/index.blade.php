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

@can('skill_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.skills.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.skill.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.skill.title') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-skill">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.skill.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.skill.fields.name_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.skill.fields.name_ar') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $key => $skill)
                        <tr data-entry-id="{{ $skill->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $skill->id ?? '' }}
                            </td>
                            <td>
                                {{ $skill->name_en ?? '' }}
                            </td>
                            <td>
                                {{ $skill->name_ar ?? '' }}
                            </td>
                            <td>  
                                @can('skill_edit')
                                    <a  href="{{ route('admin.skills.edit', $skill->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit" title="{{ trans('global.edit') }}" style="display: inline"> 
                                        <i class="fa fa-edit actions-custom-i"></i>
                                        
                                    </a>
                                @endcan
                                
                                @can('skill_delete')
                                    <form style="display: inline" id="delete-{{ $skill->id }}" action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <a style="display: inline" title="{{ trans('global.delete') }}" class="btn btn-outline-danger btn-pill action-buttons-delete"  href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $skill->id }}').submit()">
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
        let table = $('.datatable-skill:not(.ajaxTable)').DataTable({ 
                buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
    })

</script>
@endsection