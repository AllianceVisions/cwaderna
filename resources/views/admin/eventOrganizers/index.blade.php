@extends('layouts.admin')
@section('content')
@can('event_organizer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.event-organizers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.eventOrganizer.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.eventOrganizer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-EventOrganizer">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.eventOrganizer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th> 
                        <th>
                            {{ trans('cruds.eventOrganizer.fields.company_name') }}
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
                            {{ trans('cruds.user.fields.photo') }}
                        </th> 
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th> 
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach($eventorganizers as $key => $eventorganizer)
                        <tr data-entry-id="{{ $eventorganizer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $eventorganizer->id ?? '' }}
                            </td>
                            <td>
                                {{ $eventorganizer->user ? $eventorganizer->user->first_name . " " . $eventorganizer->user->last_name : '' }}
                            </td>
                            <td>
                                {{ $eventorganizer->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $eventorganizer->user->email ?? '' }}
                            </td>
                            <td>
                                @php $name = 'name_'.app()->getLocale();@endphp
                                {{ $eventorganizer->user->city ? $eventorganizer->user->city->$name : '' }}
                            </td>
                            <td>
                                {{ $eventorganizer->user->phone ?? '' }}
                            </td> 
                            </td> 
                            <td>
                                @if($eventorganizer->user && $eventorganizer->user->photo)
                                    <a href="{{ $eventorganizer->user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $eventorganizer->user->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td> 
                            <td>
                                <label class="c-switch c-switch-pill c-switch-success">
                                    <input onchange="update_approved(this)" value="{{$eventorganizer->user_id}}" type="checkbox" class="c-switch-input" {{ ($eventorganizer->user->approved ? 'checked' : null) }}>
                                    <span class="c-switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                @can('event_organizer_show')
                                    <a  href="{{ route('admin.event-organizers.show', $eventorganizer->id) }}" title="{{ trans('global.view') }}" class="btn btn-outline-info btn-pill action-buttons-view">
                                        <i class="fas fa-eye actions-custom-i"></i> 
                                    </a>
                                @endcan 
                    
                                @can('event_organizer_edit')
                                    <a  href="{{ route('admin.event-organizers.edit', $eventorganizer->id) }}" title="{{ trans('global.edit') }}" class="btn btn-outline-success btn-pill action-buttons-edit"> 
                                        <i class="fa fa-edit actions-custom-i"></i> 
                                    </a>
                                @endcan 

                                @can('event_organizer_delete')
                                    <?php $route = route('admin.event-organizers.destroy', $eventorganizer->id); ?>
                                    <a  href="#" onclick="deleteConfirmation('{{$route}}')" class="btn btn-outline-danger btn-pill action-buttons-delete">
                                        <i  class="fa fa-trash actions-custom-i"></i>
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

    function update_approved(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('admin.event-organizers.update_approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){ 
            if(data == 1){
                showFrontendAlert('success',"{{ trans('global.flash.user.approve') }}");
            }else{
                showFrontendAlert('error',"{{ trans('global.flash.error') }}");
            }
        });
    }

    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 25,
        });
        let table = $('.datatable-EventOrganizer:not(.ajaxTable)').DataTable({ 
            buttons: dtButtons 
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        }); 
        
    })

</script>
@endsection
