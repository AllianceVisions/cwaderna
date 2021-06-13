@extends('admin.layout.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.user.title') }} 
    </div>

    <div class="card-body "> 
        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
            <thead>
                <tr>
                    <th width="10">
                        
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th> 
                    <th>
                        {{ trans('cruds.user.fields.last_name') }}
                    </th> 
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th> 
                    <th>
                        {{ trans('cruds.user.fields.city_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.roles') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.photo') }}
                    </th>
                    <th>
                        &nbsp;
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

    function update_approved(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('admin.users.update_approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                location.reload();
            }
            else{
                location.reload();
            }
        });
    }

    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('admin.users.index') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                { data: 'id', name: 'id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email' },
                @php $name = 'name_'.app()->getLocale();@endphp
                { data: 'city', name: 'city.{{$name}}' }, 
                { data: 'phone', name: 'phone' },
                { data: 'roles', name: 'roles.title' },
                { data: 'photo', name: 'photo' },
                { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            columnDefs: [{
                visible: false,
                targets: 3
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
            pageLength: 25,
        };
        
        let table = $('.datatable-User').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
        });
    
    });

</script>
@endsection