@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.contactus.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-contactus">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.contactus.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.contactus.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.contactus.fields.email') }}
                        </th> 
                        <th>
                            {{ trans('cruds.contactus.fields.message') }}
                        </th> 
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contactus as $key => $raw)
                        <tr data-entry-id="{{ $raw->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $raw->id ?? '' }}
                            </td>  
                            <td>
                                {{ $raw->name ?? '' }}
                            </td>
                            <td>
                                {{ $raw->email ?? '' }}
                            </td>
                            <td>
                                {{ $raw->message ?? '' }}
                            </td> 
                            <td>  
                                <?php $route = route('admin.contactus.destroy', $raw->id); ?>
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
            pageLength: 100,
        });
        let table = $('.datatable-contactus:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
    })

</script>
@endsection
