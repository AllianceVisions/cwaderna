@extends('layouts.provider_man')
@section('content')  

<div class="card">
    <div class="card-header">
        {{ trans('cruds.orders.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr>
                        <th width="10">

                        </th> 
                        <th>
                            {{ trans('cruds.event.fields.event_organizer_id') }}
                        </th> 
                        <th>
                            {{ trans('cruds.event.others.attendance') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.price') }}
                        </th> 
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                        @php $items = $event->items()->where('items.provider_man_id',$provider_man->id)->get(); @endphp
                        @foreach($items as $item)
                            <tr data-entry-id="{{ $event->id }}">
                                <td> 
                                </td>   
                                <td>
                                    {{$event->title}}
                                </td>
                                <td>
                                    {{$item->pivot->start_attendance}} <br> 
                                    {{$item->pivot->end_attendance}}
                                </td>
                                <td>
                                    {{$item->title}}
                                </td>
                                <td> 
                                    {{$item->pivot->profit}}
                                </td>
                            </tr>
                        @endforeach
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
        let table = $('.datatable-Order:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
    })

</script>
@endsection
