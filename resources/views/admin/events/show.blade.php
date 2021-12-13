@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body"> 
        <div class="form-group">
            
            <div class="form-group"> 
                <div id="map3"  style="width: 100%; height: 600px"></div>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                    
                </a>
            </div>  
            <div class="row">
                <div class="col-md-6">
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
                                    {{ trans('cruds.event.fields.event_organizer_id') }}
                                </th>
                                <td>
                                    {{ $event->event_organizer->company_name ?? '' }}
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
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            
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
                                    {{ trans('cruds.event.fields.status') }}
                                </th>
                                <td>
                                    {{ $event->status ? trans('global.event_status.'.$event->status) : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.date') }}
                                </th>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $event->start_date }}</span> <br> <span class="badge bg-secondary">{{ $event->end_date }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.attendance') }}
                                </th>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $event->start_attendance }}</span> <br> <span class="badge bg-secondary">{{ $event->end_attendance }}</span>
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.photo') }}
                                </th>
                                <td>
                                    @if($event->photo)
                                        <a href="{{ $event->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $event->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                @if($event->status != 'pending')  

                    <!-- Modal add cader-->
                    <div class="modal fade" id="add_cader_modal" tabindex="1" role="dialog" aria-labelledby="add_cader_modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add_cader_modalLabel">{{trans('cruds.event.others.add_cader_to_event')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.events.add_cader')}}" method="POST">
                                        @csrf 

                                        {{-- cader_id --}}
                                        <div id="caders_select"></div> 

                                        <input type="hidden" value="{{$event->id}}" name="event_id">
                                        <input type="hidden" id="event_specialize"  name="specialize_id">

                                        <div class="row">
                                            <div class="col-md-6">
                                                {{-- profit --}}
                                                <div class="form-group">
                                                    <label class="required" for="profit">{{ trans('cruds.event.others.profit') }}</label>
                                                    <input class="form-control {{ $errors->has('profit') ? 'is-invalid' : '' }}" type="number" name="profit" id="profit_modal" value="{{ old('profit') }}" required>
                                                    @if($errors->has('profit'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('profit') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                {{-- price --}}
                                                <div class="form-group">
                                                    <label class="required" for="price">{{ trans('cruds.event.others.price') }}</label>
                                                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price_modal" value="{{ old('price') }}" required>
                                                    @if($errors->has('price'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('price') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{-- start_attendance --}}
                                                <div class="form-group">
                                                    <label class="required" for="start_attendance">{{ trans('cruds.event.fields.start_attendance') }}</label>
                                                    <input class="form-control datetime {{ $errors->has('start_attendance') ? 'is-invalid' : '' }}" type="text" name="start_attendance" id="start_attendance_modal" value="{{ old('start_attendance') }}" required>
                                                    @if($errors->has('start_attendance'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('start_attendance') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                {{-- end_attendance --}}
                                                <div class="form-group">
                                                    <label class="required" for="end_attendance">{{ trans('cruds.event.fields.end_attendance') }}</label>
                                                    <input class="form-control datetime {{ $errors->has('end_attendance') ? 'is-invalid' : '' }}" type="text" name="end_attendance" id="end_attendance_modal" value="{{ old('end_attendance') }}" required>
                                                    @if($errors->has('end_attendance'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('end_attendance') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div> 
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-success">{{trans('global.save')}}</button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <!-- Modal edit cader -->
                    <div class="modal fade" id="edit_cader_modal" tabindex="1" role="dialog" aria-labelledby="edit_cader_modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit_cader_modalLabel">{{trans('cruds.event.others.edit_cader_in_event')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.events.update_cader')}}" method="POST" id="edit_cader_form">
                                        @csrf 

                                        <input type="hidden" value="{{$event->id}}" name="event_id"> 
                                        <input type="hidden" value="" name="cader_id" id="cader_id">
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{-- profit --}}
                                                <div class="form-group">
                                                    <label class="required" for="profit">{{ trans('cruds.event.others.profit') }}</label>
                                                    <input class="form-control {{ $errors->has('profit') ? 'is-invalid' : '' }}" type="number" name="profit" id="profit_modal" value="{{ old('profit') }}" required>
                                                    @if($errors->has('profit'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('profit') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                {{-- price --}}
                                                <div class="form-group">
                                                    <label class="required" for="price">{{ trans('cruds.event.others.price') }}</label>
                                                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price_modal" value="{{ old('price') }}" required>
                                                    @if($errors->has('price'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('price') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                {{-- start_attendance --}}
                                                <div class="form-group">
                                                    <label class="required" for="start_attendance">{{ trans('cruds.event.fields.start_attendance') }}</label>
                                                    <input class="form-control datetime {{ $errors->has('start_attendance') ? 'is-invalid' : '' }}" type="text" name="start_attendance" id="start_attendance_modal" value="{{ old('start_attendance') }}" required>
                                                    @if($errors->has('start_attendance'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('start_attendance') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                {{-- end_attendance --}}
                                                <div class="form-group">
                                                    <label class="required" for="end_attendance">{{ trans('cruds.event.fields.end_attendance') }}</label>
                                                    <input class="form-control datetime {{ $errors->has('end_attendance') ? 'is-invalid' : '' }}" type="text" name="end_attendance" id="end_attendance_modal" value="{{ old('end_attendance') }}" required>
                                                    @if($errors->has('end_attendance'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('end_attendance') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div> 
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-success">{{trans('global.save')}}</button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <!-- Modal edit service -->
                    <div class="modal fade" id="edit_service_modal" tabindex="1" role="dialog" aria-labelledby="edit_service_modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit_service_modalLabel">{{trans('cruds.event.others.edit_service_in_event')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.events.update_item')}}" method="POST" id="edit_service_form">
                                        @csrf 

                                        <input type="hidden" value="{{$event->id}}" name="event_id"> 
                                        <input type="hidden" value="" name="item_id" id="item_id">
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{-- profit --}}
                                                <div class="form-group">
                                                    <label class="required" for="profit">{{ trans('cruds.event.others.profit_service') }}</label>
                                                    <input class="form-control {{ $errors->has('profit') ? 'is-invalid' : '' }}" type="number" name="profit" id="profit_modal" value="{{ old('profit') }}" required>
                                                    @if($errors->has('profit'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('profit') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                {{-- price --}}
                                                <div class="form-group">
                                                    <label class="required" for="price">{{ trans('cruds.event.others.price') }}</label>
                                                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price_modal" value="{{ old('price') }}" required>
                                                    @if($errors->has('price'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('price') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                {{-- start_attendance --}}
                                                <div class="form-group">
                                                    <label class="required" for="start_attendance">{{ trans('cruds.event.fields.start_attendance') }}</label>
                                                    <input class="form-control datetime {{ $errors->has('start_attendance') ? 'is-invalid' : '' }}" type="text" name="start_attendance" id="start_attendance_modal" value="{{ old('start_attendance') }}" required>
                                                    @if($errors->has('start_attendance'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('start_attendance') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                {{-- end_attendance --}}
                                                <div class="form-group">
                                                    <label class="required" for="end_attendance">{{ trans('cruds.event.fields.end_attendance') }}</label>
                                                    <input class="form-control datetime {{ $errors->has('end_attendance') ? 'is-invalid' : '' }}" type="text" name="end_attendance" id="end_attendance_modal" value="{{ old('end_attendance') }}" required>
                                                    @if($errors->has('end_attendance'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('end_attendance') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div> 
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-success">{{trans('global.save')}}</button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                    
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

                    @if($event->status == 'request_to_pricing')
                        <a href="{{ route('admin.events.send_pricing',$event->id) }}" class="btn btn-danger mb-3">{{ trans('cruds.event.others.send_price') }}</a>
                    @elseif($event->status == 'pending_owner_accept') 
                        <button class="btn btn-danger mb-3" disabled>{{trans('global.event_status.pending_owner_accept')}}</button>
                    @elseif($event->status == 'accepted')
                        <button class="btn btn-success mb-3" disabled>{{trans('global.event_status.accepted')}}</button>
                    @elseif($event->status == 'refused')
                        <button class="btn btn-warning text-white mb-3" disabled>{{trans('global.event_status.refused')}}</button>
                    @endif



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
                                                    <div class="col-md-2">{{$specialize->$name}}</div>
                                                    <div class="col-md-2"><span class="badge bg-success text-white">{{ trans('cruds.event.fields.num_of_caders') }} {{$specialize->pivot->num_of_caders}}</span></div>
                                                    <div class="col-md-2"><span class="badge bg-info text-white">{{ trans('cruds.event.fields.budget') }} {{$specialize->pivot_budget()}}</span></div>  
                                                    <div class="col-md-3">
                                                        <span class="badge bg-secondary text-dark">{{$specialize->pivot_start_attendance()}}</span><br>
                                                        <span class="badge bg-secondary text-dark">{{$specialize->pivot_end_attendance()}}</span>
                                                    </div>  
                                                    <div class="col-md-3">
                                                        @if($event->status == 'request_to_pricing')
                                                            <a role="button" href="#" class="btn btn-success" onclick="showmodal({{$specialize->id}},'{{$specialize->pivot_start_attendance()}}','{{$specialize->pivot_end_attendance()}}')">
                                                                {{trans('cruds.event.others.add_cader')}}
                                                            </a>
                                                        @endif
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
                                                        <td>{{trans('cruds.event.others.by')}}</td>
                                                        <td> 
                                                        </td>
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
                                                            <td>{{ trans('global.event_request_by.'.$cader->pivot->request_type) }}</td>
                                                            <td class="text-center"> 
                                                                @if($cader->pivot->status == 'send_pricing') 
                                                                    <a href="{{route('admin.events.cancel_cader',[$event->id,$cader->id])}}" class="btn btn-outline-warning">ألغاء</a> <br>
                                                                    <span class="text-center text-white badge bg-warning">في أنتظار رد الكادر</span>
                                                                @elseif($cader->pivot->status == 'accepted') 
                                                                    <span class="text-center text-white badge bg-success">تم الموافقة</span>
                                                                @elseif($cader->pivot->status == 'refused') 
                                                                    <span class="text-center text-white badge bg-danger">تم الرفض من الكادر</span>
                                                                @elseif($cader->pivot->status == 'cancel') 
                                                                    <span class="text-center text-white badge bg-danger">تم ألغاء الكادر</span> <br> 
                                                                    @if($event->status == 'request_to_pricing')
                                                                        <a href="{{route('admin.events.send_pricing_to_cader',[$event->id,$cader->id])}}" class="btn btn-outline-success">أرسال تسعيرة مرة أخري</a> 
                                                                        <button type="button" class="btn btn-outline-info" onclick="showmodal2({{$cader->pivot->price ?? 0}},{{$cader->pivot->profit ?? 0}},'{{$cader->pivot_start_attendance()}}','{{$cader->pivot_end_attendance()}}',{{$cader->id}})">{{ trans('global.edit') }}</button>
                                                                    @endif
                                                                @else 
                                                                    <a href="{{route('admin.events.send_pricing_to_cader',[$event->id,$cader->id])}}" class="btn btn-outline-success">أرسال تسعيرة للكادر</a>
                                                                    <button type="button" class="btn btn-outline-info" onclick="showmodal2({{$cader->pivot->price ?? 0}},{{$cader->pivot->profit ?? 0}},'{{$cader->pivot_start_attendance()}}','{{$cader->pivot_end_attendance()}}',{{$cader->id}})">{{ trans('global.edit') }}</button>
                                                                    @if($cader->pivot->request_type == 'by_admin')
                                                                        <form style="display: inline" action="{{ route('admin.events.delete_cader') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                                                            @csrf
                                                                            <input type="hidden" name="cader_id" value="{{$cader->id}}">
                                                                            <input type="hidden" name="event_id" value="{{$event->id}}">
                                                                            <button class="btn btn-outline-danger" type="submit">{{ trans('global.delete') }}</button>
                                                                        </form>
                                                                    @else 
                                                                        <a href="{{route('admin.events.cancel_cader',[$event->id,$cader->id])}}" class="btn btn-outline-warning">ألغاء</a> <br>
                                                                    @endif
                                                                @endif

                                                                @if($event->status == 'accepted' && $cader->pivot->status == 'accepted') 
                                                                    <br>
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
                                    <td>{{trans('cruds.providerMan.title_singular')}}</td>
                                    <td>{{trans('cruds.providerMan.others.item_name')}}</td>
                                    <td>{{trans('cruds.providerMan.others.attendance')}}</td>
                                    <td>{{trans('cruds.providerMan.others.profit')}}</td>
                                    <td>{{trans('cruds.providerMan.others.price')}}</td>
                                    <td></td>
                                </tr>
                            </thead>
                            @foreach($event->items as $item)
                                <form action="{{ route('admin.events.update_item') }}" method="POST">
                                    @csrf
                                    <tr> 
                                        <td>{{$item->provider_man->company_name}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>
                                            {{$item->pivot_start_attendance()}} <br>
                                            {{$item->pivot_end_attendance()}} 
                                        </td>
                                        <td>{{$item->pivot->profit ? $item->pivot->profit : $item->price}}</td>
                                        <td>{{$item->pivot->price}}</td>
                                        <td>
                                            @if($event->status == 'request_to_pricing')
                                                <button type="button" class="btn btn-outline-info" onclick="showmodal3({{$item->pivot->price ?? 0}},{{$item->pivot->profit ?? 0}},'{{$item->pivot_start_attendance()}}','{{$item->pivot_end_attendance()}}',{{$item->id}})">{{ trans('global.edit') }}</button>
                                            @endif
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                        </table>
                    </div>
                @endif
            </div> 

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
@parent
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCq2UTcMzYp__KQb0P_By0dmzCjP9Twors&libraries=places&v=weekly"></script>
<script>

    let infoObj = []; 
    let map ; 
    let titles = [];
    let markers = [];

    function myMap3() {
        var mapCanvas = document.getElementById("map3");
        var mapOptions = {
            center: new google.maps.LatLng('{{ $event->latitude}}', '{{ $event->longitude }}'),
            zoom: 14,
            mapTypeId: "roadmap",
        };
        map = new google.maps.Map(mapCanvas, mapOptions);

        var circle = new google.maps.Circle({
            center:new google.maps.LatLng('{{ $event->latitude}}', '{{ $event->longitude }}'), 
            radius: parseInt('{{ $event->area}}'), 
            fillColor: "#0000FF", 
            fillOpacity: 0.3, 
            map: map, 
            strokeColor: "#FFFFFF", 
            strokeOpacity: 0.6, 
            strokeWeight: 2
        });
        @foreach($event->caders as $cader)
            titles.push({
                'id' : '{{ $cader->user_id }}',
                'lat' : '{{ $cader->latitude}}',
                'lng' : '{{ $cader->longitude}}',
                'name' : '{{ $cader->user->first_name}}' + ' ' + '{{ $cader->user->last_name}}',
                'photo' : 'http://localhost/cwaderna/public/storage/3/conversions/61afe1277f28b_Wallpapers-HD-Assassins-Creed-Gallery-88-Plus-PIC-WPW2013516-thumb.jpg'
            });
        @endforeach
        
        for(var i = 0; i < parseInt('{{ $event->caders()->get()->count() }}') ; i++){ 
            var contentString = '<img style="padding:8px" src="' + titles[i].photo + '"> <h5>' + titles[i].name + '</h5> ';

            const marker = new google.maps.Marker({
                position: new google.maps.LatLng(titles[i].lat, titles[i].lng), 
                map:map,
                title:titles[i].id,
            });

            const infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 200,
            });

            marker.addListener("click", function(){
                closeOtherInfo();
                infowindow.open(map,marker);
                infoObj[0] = infowindow;
            }); 
            markers.push(marker);
        }
    }
    google.maps.event.addDomListener(window, 'load', myMap3); 
    function functiontofindIndexByKeyValue(arraytosearch, key, valuetosearch) {

        for (var i = 0; i < arraytosearch.length; i++) {

            if (arraytosearch[i][key] == valuetosearch) {
                return i;
            }
        }
        return null;
    } 
    function closeOtherInfo(){
        if(infoObj.length > 0){
            infoObj[0].set('marker',null);
            infoObj[0].close();
            infoObj[0].length = 0; 
        }
    }
    function addmarker(lat,lng,title = ''){
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
            circles[i].setMap(null);
        }

        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat,lng), 
            map,
            title: title,
        });
        markers.push(marker);
        
        var circle = new google.maps.Circle({
            center:new google.maps.LatLng(lat,lng), 
            radius: parseInt($('#area').val()), 
            fillColor: "#0000FF", 
            fillOpacity: 0.2, 
            map: map, 
            strokeColor: "#FFFFFF", 
            strokeOpacity: 0.6, 
            strokeWeight: 2
        });
        circles.push(circle);
    }
</script>

<script>
    var channel = pusher.subscribe('stream-location');

    channel.bind('App\\Events\\ChangeLocation',function(obj){ 
        
        var index = functiontofindIndexByKeyValue(markers, "title", obj['user_id']);
        
        markers[index].setPosition(new google.maps.LatLng(obj['latitude'], obj['longitude']))
            
    });
</script>
<script> 
    function showmodal(id,start_attendance,end_attendance){
        $('#add_cader_modal').modal('show')
        $('#add_cader_modal #start_attendance_modal').val(null);
        $('#add_cader_modal #start_attendance_modal').val(start_attendance);
        $('#add_cader_modal #end_attendance_modal').val(null);
        $('#add_cader_modal #end_attendance_modal').val(end_attendance);
        $('#event_specialize').val(null);
        $('#event_specialize').val(id);
        $.post('{{ route('admin.events.partials.add_cader') }}', {_token:'{{ csrf_token() }}', specialize_id:id,event_id:'{{$event->id}}'}, function(data){
            $('#caders_select').html(null);
            $('#caders_select').html(data);
        });
    }

    function showmodal2(price,profit,start_attendance,end_attendance,cader_id){
        $('#edit_cader_modal').modal('show')
        $('#edit_cader_modal #start_attendance_modal').val(null);
        $('#edit_cader_modal #start_attendance_modal').val(start_attendance);
        $('#edit_cader_modal #end_attendance_modal').val(null);
        $('#edit_cader_modal #end_attendance_modal').val(end_attendance);
        $('#edit_cader_modal #price_modal').val(null);
        $('#edit_cader_modal #price_modal').val(price);
        $('#edit_cader_modal #profit_modal').val(null);
        $('#edit_cader_modal #profit_modal').val(profit); 
        $('#edit_cader_modal #cader_id').val(null);
        $('#edit_cader_modal #cader_id').val(cader_id); 
    }

    function showmodal3(price,profit,start_attendance,end_attendance,item_id){
        $('#edit_service_modal').modal('show')
        $('#edit_service_modal #start_attendance_modal').val(null);
        $('#edit_service_modal #start_attendance_modal').val(start_attendance);
        $('#edit_service_modal #end_attendance_modal').val(null);
        $('#edit_service_modal #end_attendance_modal').val(end_attendance);
        $('#edit_service_modal #price_modal').val(null);
        $('#edit_service_modal #price_modal').val(price);
        $('#edit_service_modal #profit_modal').val(null);
        $('#edit_service_modal #profit_modal').val(profit); 
        $('#edit_service_modal #item_id').val(null);
        $('#edit_service_modal #item_id').val(item_id); 
    }

    function showmodal4(cader_id){
        $('#attendance_modal').modal('show') 
        $.post('{{ route('admin.events.partials.attendance_cader') }}', {_token:'{{ csrf_token() }}', cader_id:cader_id,event_id:'{{$event->id}}'}, function(data){
            $('#attendance_cader').html(null);
            $('#attendance_cader').html(data);
        });
    } 
</script>
@endsection
