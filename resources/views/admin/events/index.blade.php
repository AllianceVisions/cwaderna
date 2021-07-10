@extends('layouts.admin')
@section('content')
@can('event_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.events.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
    </div> 
    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Event">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.event.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.event_organizer_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.city_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.conditions') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.specializations') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.attendance') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.status') }}
                    </th>
                    <th>  
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('admin.events.index') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                { data: 'id', name: 'id' },
                { data: 'event_organizer_company_name', name: 'event_organizer.company_name' },
                { data: 'title', name: 'title' },
                @php $name = 'name_'.app()->getLocale();@endphp
                { data: 'city', name: 'city.{{$name}}' }, 
                { data: 'address', name: 'address' },
                { data: 'conditions', name: 'conditions' },
                { data: 'description', name: 'description' },
                { data: 'specializations', name: 'specializations.{{$name}}' , sortable: false, searchable: false},
                { data: 'date', name: 'date', sortable: false, searchable: false },
                { data: 'attendance', name: 'attendance' , sortable: false, searchable: false},
                { data: 'photo', name: 'photo', sortable: false, searchable: false },
                { data: 'status', name: 'status', },
                { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            columnDefs: [{
                visible: false,
                targets: 1
            },{
                visible: false,
                targets: 4
            },{
                visible: false,
                targets: 6
            },{
                visible: false,
                targets: 7
            },{
                visible: false,
                targets: 8
            },{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        };
        let table = $('.datatable-Event').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
    });

</script>
@endsection