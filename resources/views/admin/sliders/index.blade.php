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

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sliders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.slider.title_singular') }}
            </a>
        </div>
    </div> 
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.slider.title') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-sliders">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.link') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.slider') }}
                        </th> 
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $key => $slider)
                        <tr data-entry-id="{{ $slider->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $slider->id ?? '' }}
                            </td>
                            <td>
                                {{ $slider->title ?? '' }}
                            </td>
                            <td>
                                {{ $slider->description ?? '' }}
                            </td>
                            <td>
                                {{ $slider->link ?? '' }}
                            </td>
                            <td> 
                                @if($slider->slider)
                                    <a href="{{ asset($slider->slider->getUrl()) }}" target="_blank" style="display: inline-block">
                                        <img src="{{ asset($slider->slider->getUrl('thumb')) }}">
                                    </a>
                                @endif
                            </td>
                            <td>   
                                    <a  href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit" title="{{ trans('global.edit') }}" style="display: inline"> 
                                        <i class="fa fa-edit actions-custom-i"></i>
                                        
                                    </a> 
                                
                                    <?php $route = route('admin.sliders.destroy', $slider->id); ?>
                                    <a  href="#" onclick="deleteConfirmation('{{$route}}')" class="btn btn-outline-danger btn-pill action-buttons-delete">
                                        <i  class="fa fa-trash actions-custom-i"></i>
                                    </a>  
                            
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
        let table = $('.datatable-sliders:not(.ajaxTable)').DataTable({ 
                buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    
    })

</script>
@endsection