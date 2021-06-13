@extends('events_organizer.layout.events_organizer')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('events-organizer.events.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
            </a>
        </div>
    </div>
    
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
            ajax: "{{ route('events-organizer.events.index') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                { data: 'id', name: 'id' },
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
                { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            columnDefs: [{
                visible: false,
                targets: 1
            },{
                visible: false,
                targets: 3
            },{
                visible: false,
                targets: 5
            },{
                visible: false,
                targets: 6
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