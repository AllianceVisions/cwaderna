@extends('layouts.events_organizer')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('events-organizer.events.index') }}">
                    {{ trans('global.back_to_list') }}
                    
                </a>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.id') }}
                                </th>
                                <td>
                                    {{ $event->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.title') }}
                                </th>
                                <td>
                                    {{ $event->title }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.start_date') }}
                                </th>
                                <td>
                                    {{ $event->start_date }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.end_date') }}
                                </th>
                                <td>
                                    {{ $event->end_date }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.city_id') }}
                                </th>
                                <td>
                                    @php $name = 'name_'.app()->getLocale(); @endphp
                                    {{ $event->city ? $event->city->$name : "" }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.address') }}
                                </th>
                                <td>
                                    {{ $event->address }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.description') }}
                                </th>
                                <td>
                                    {{ $event->description }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.conditions') }}
                                </th>
                                <td>
                                    {{ $event->conditions }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.start_attendance') }}
                                </th>
                                <td>
                                    {{ $event->start_attendance }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.end_attendance') }}
                                </th>
                                <td>
                                    {{ $event->end_attendance }}
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.photo') }}
                                </th>
                                <td>
                                    @if($event->photo)
                                        <a href="{{ asset($event->photo->getUrl()) }}" target="_blank" style="display: inline-block">
                                            <img src="{{ asset($event->photo->getUrl('thumb')) }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-8">
                    @if($event->status != 'pending') 
                        @if($event->status == 'pending_owner_accept')
                            <a href="{{ route('events-organizer.events.change_status',['id' => $event->id,'status' => 'accepted']) }}" class="btn btn-success mb-3">الموافقة علي التسعيرة</a>
                            <a href="{{ route('events-organizer.events.change_status',['id' => $event->id,'status' => 'refused']) }}" class="btn btn-warning text-white mb-3">رفض التسعيرة</a>
                        @elseif($event->status == 'accept')
                            <button class="btn btn-success mb-3" disabled>تم الموافقة</button>
                        @elseif($event->status == 'refused')
                            <button class="btn btn-warning text-white mb-3" disabled>تم الرفض</button>
                        @endif


                        
                        <!-- Modal attendance cader -->
                        <div class="modal fade bd-example-modal-lg" id="attendance_modal" tabindex="1" role="dialog" aria-labelledby="attendance_modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="attendance_modalLabel">{{trans('cruds.event.others.attendance_in_event')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body"> 
                                        <div id="attendance_cader"></div> 
                                    </div> 
                                </div>
                            </div>
                        </div>


                        {{-- specialization --}}
                        <div class="partials-scrollable" style="max-height: 450px">
                            <label>{{ trans('cruds.specialization.title') }}</label>

                            @php $name = 'name_'.app()->getLocale(); @endphp
                            <div id="accordion">
                                @foreach ($event->specializations as $key => $specialize)
                                    <div class="card">
                                        <div class="card-header" id="heading{{$key}}" style="border:0">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link btn-block" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                                    
                                                    <div class="row"> 
                                                        <div class="col-md-3">{{$specialize->$name}}</div>
                                                        <div class="col-md-3"><span class="badge bg-success text-white">{{$specialize->pivot->num_of_caders}}</span></div>
                                                        <div class="col-md-3"><span class="badge bg-warning text-white">{{$specialize->pivot_budget()}}</span></div>  
                                                        <div class="col-md-3">
                                                            <span class="badge bg-secondary text-dark">{{$specialize->pivot_start_attendance()}}</span><br>
                                                            <span class="badge bg-secondary text-dark">{{$specialize->pivot_end_attendance()}}</span>
                                                        </div>  
                                                    </div>
                                                </button>
                                            </h5>
                                        </div>
                                    
                                        <div id="collapse{{$key}}" class="collapse" aria-labelledby="heading{{$key}}" data-parent="#accordion">
                                            <div class="card-body"> 
                                                <table class="table"> 
                                                    <thead>
                                                        <tr>
                                                            <td>{{trans('cruds.user.fields.name')}}</td>
                                                            <td>{{trans('cruds.event.others.attendance')}}</td> 
                                                            <td>{{trans('cruds.event.others.profit')}}</td>
                                                            <td>{{trans('cruds.event.others.price')}}</td> 
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    @foreach($event->caders as $cader)
                                                        @if($cader->pivot->specialization_id == $specialize->id) 
                                                            <tr> 
                                                                <td>{{$cader->user->first_name . " " . $cader->user->last_name}}</td>
                                                                <td>
                                                                    {{$cader->pivot_start_attendance()}} <br>
                                                                    {{$cader->pivot_end_attendance()}} 
                                                                </td> 
                                                                <td>{{$cader->pivot->profit}}</td>
                                                                <td>{{$cader->pivot->price}}</td> 
                                                                <td> 
                                                                    @if($event->status == 'accepted' && $cader->pivot->status == 'accepted')  
                                                                        <button type="button" class="btn btn-outline-info" onclick="showmodal4({{$cader->id}})">سجل الحضور</button>
                                                                    @endif
                                                                </td>
                                                            </tr> 
                                                        @endif
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>  
                                @endforeach
                            </div>

                        </div>

                        {{-- services --}}
                        <div class="partials-scrollable mt-3">
                            <label>{{ trans('cruds.item.title') }}</label>
                            <table class="table"> 
                                <thead>
                                    <tr> 
                                        <td>اسم الخدمة</td> 
                                        <td>وقت الحضور</td>
                                        <td>التسعير</td> 
                                    </tr>
                                </thead>
                                @foreach($event->items as $item) 
                                    <tr> 
                                        <td>{{$item->title}}</td>
                                        <td>
                                            {{$item->pivot_start_attendance()}} <br>
                                            {{$item->pivot_end_attendance()}} 
                                        </td>
                                        <td>{{$item->pivot->price}}</td> 
                                    </tr> 
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('events-organizer.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
@parent
<script>  
    function showmodal4(cader_id){
        $('#attendance_modal').modal('show') 
        $.post('{{ route('events-organizer.events.partials.attendance_cader') }}', {_token:'{{ csrf_token() }}', cader_id:cader_id,event_id:'{{$event->id}}'}, function(data){
            $('#attendance_cader').html(null);
            $('#attendance_cader').html(data);
        });
    } 
</script>
@endsection
