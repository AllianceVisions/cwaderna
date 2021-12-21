
    @php $name = 'name_'.app()->getLocale(); @endphp 
    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
        @foreach ($event->specializations as $key => $specialize)
            <li class="nav-item">
                <a class="nav-link
                            @isset($relation_tab_specialization)
                                @if($relation_tab_specialization == $specialize->id) 
                                    active 
                                @endif 
                            @else 
                                @if($loop->first) 
                                    active 
                                @endif 
                            @endisset" 
                    id="pills-{{$specialize->id}}-tab" data-toggle="pill" href="#pills-{{$specialize->id}}" role="tab" aria-controls="pills-{{$specialize->id}}" aria-selected="true"> 
                    <span class="badge badge-success">{{$specialize->pivot->num_of_caders}}</span>
                    {{$specialize->$name}}
                </a>
            </li>
        @endforeach
    </ul>
    

    <div class="tab-content" id="pills-tabContent">
        @foreach ($event->specializations as $key => $specialize)
            <div class="tab-pane fade 
                        @isset($relation_tab_specialization)
                            @if($relation_tab_specialization == $specialize->id) 
                                active show
                            @endif 
                        @else 
                            @if($loop->first) 
                                active show
                            @endif 
                        @endisset"
                id="pills-{{$specialize->id}}" role="tabpanel" aria-labelledby="pills-{{$specialize->id}}-tab"> 
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                @if($event->caders()->wherePivot('specialization_id',$specialize->id)->count() > 0)
                                    <table class="table table-striped table-bordered"> 
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
                                                            <button onclick="cader_status({{ $event->id }},{{ $cader->id }},'cancel',{{$specialize->id}})" class="btn btn-outline-warning">ألغاء</button> <br>
                                                            <span class="text-center text-white badge bg-warning">في أنتظار رد الكادر</span>
                                                        @elseif($cader->pivot->status == 'accepted') 
                                                            <span class="text-center text-white badge bg-success">تم الموافقة</span>
                                                        @elseif($cader->pivot->status == 'refused') 
                                                            <span class="text-center text-white badge bg-danger">تم الرفض من الكادر</span>
                                                        @elseif($cader->pivot->status == 'cancel') 
                                                            <span class="text-center text-white badge bg-danger">تم ألغاء الكادر</span> <br> 
                                                            @if($event->status == 'request_to_pricing')
                                                                <button onclick="cader_status({{ $event->id }},{{ $cader->id }},'send_pricing',{{$specialize->id}})" class="btn btn-outline-success">أرسال تسعيرة مرة أخري</button>
                                                                <button type="button" class="btn btn-outline-info" onclick="edit_cader({{$cader->pivot->price ?? 0}},{{$cader->pivot->profit ?? 0}},'{{$cader->pivot_start_attendance()}}','{{$cader->pivot_end_attendance()}}',{{$cader->id}},'{{trans('cruds.event.others.edit_cader_to_event')}}',{{$specialize->id}})">{{ trans('global.edit') }}</button>
                                                            @endif
                                                        @else 
                                                            <button onclick="cader_status({{ $event->id }},{{ $cader->id }},'send_pricing')" class="btn btn-outline-success">أرسال تسعيرة للكادر</button>
                                                            <button type="button" class="btn btn-outline-info" onclick="edit_cader({{$cader->pivot->price ?? 0}},{{$cader->pivot->profit ?? 0}},'{{$cader->pivot_start_attendance()}}','{{$cader->pivot_end_attendance()}}',{{$cader->id}},'{{trans('cruds.event.others.edit_cader_to_event')}}',{{$specialize->id}})">{{ trans('global.edit') }}</button>
                                                            @if($cader->pivot->request_type == 'by_admin') 
                                                                <button onclick="delete_cader('{{ route('admin.events.delete_cader') }}',{{ $event->id }},{{ $cader->id }},{{$specialize->id}})" class="btn btn-outline-danger" type="submit">{{ trans('global.delete') }}</button>
                                                            @else 
                                                                <button onclick="cader_status({{ $event->id }},{{ $cader->id }},'cancel')" class="btn btn-outline-warning">ألغاء</button> <br>
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
                                @else 
                                    <div class="alert alert-warning text-center">لم يتم الأضافة بعد</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                @if($event->status == 'request_to_pricing')
                                    <a role="button"  href="#"  class="btn btn-success" 
                                        onclick="add_cader( {{$specialize->id}},
                                                            '{{$specialize->pivot_start_attendance()}}',
                                                            '{{$specialize->pivot_end_attendance()}}',
                                                            '{{trans('cruds.event.others.add_cader_to_event')}}')">
                                        {{trans('global.add')}} {{$specialize->$name}}
                                    </a>
                                @endif
                            </div>
                            <div class="card-body"> 
                                
                                <div class="card" style="max-width: 20rem;">
                                    <div class="card-header bg-twitter content-center">
                                        <i class="fas fa-dollar-sign icon text-white" style=" font-size: 30px; margin: 8px;"></i>  
                                    </div>
                                    <div class="card-body row text-center">
                                        <div class="col">
                                            <div class="text-uppercase text-muted small">{{ trans('cruds.event.others.num_of_caders') }}</div>
                                            <div class="text-value-l">{{$specialize->pivot->num_of_caders}}</div>
                                        </div>
                                        <div class="vr"></div>
                                        <div class="col">
                                            <div class="text-uppercase text-muted small">{{ trans('cruds.event.fields.budget') }}</div>
                                            <div class="text-value-l">{{$specialize->pivot_budget()}}</div>
                                        </div>
                                    </div>
                                </div> 
                                    
                                <div class="row justify-content-around">
                                    <div class="col-4">
                                        <div class="badge badge-light">{{ trans('cruds.event.fields.start_attendance') }} <br> <br>{{$specialize->pivot_start_attendance()}}</div> 
                                    </div>
                                    <div class="col-4">
                                        <div class="badge badge-dark">{{ trans('cruds.event.fields.end_attendance') }} <br> <br> {{$specialize->pivot_end_attendance()}}</div>
                                    </div>
                                </div> 
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div> 
@section('scripts')
@parent

<script> 

    function delete_cader(route,event_id,cader_id,specialize_id) { 
        swal({
            title: "{{trans('global.flash.delete_')}}",
            text: "{{trans('global.flash.sure_')}}",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "{{trans('global.flash.yes_')}}",
            cancelButtonText: "{{trans('global.flash.no_')}}",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) { 

                $.ajax({
                    type: 'Post',
                    url: route,
                    data: { _token: '{{ csrf_token() }}' ,event_id:event_id ,cader_id:cader_id,specialize_id:specialize_id}, 
                    success: function (data) { 
                        showFrontendAlert('success', 'تم حذف الكادر من الفعالية', '');
                        $('#event_caders').html(null);
                        $('#event_caders').html(data); 
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }

    function cader_status(event_id,cader_id,type,specialize_id){
        let message = '';
        if(type == 'send_pricing'){
            message = 'تم الأرسال';
        }else if(type == 'cancel'){
            message ='تم الألغاء';
        }
		$.ajax({
			url: "{{route('admin.events.cader_status')}}" ,
			method: 'POST',
            data: { _token: '{{ csrf_token() }}', event_id: event_id ,cader_id: cader_id, type: type , specialize_id:specialize_id}, 
			success:function(data){
                showFrontendAlert('success', message, '');
                $('#event_caders').html(null);
                $('#event_caders').html(data); 
			},
            error: function( data ){ 
                showFrontendAlert('error', 'حدث خطاء حاول لاحفا', '');
            }
		})
    }
    
    $(document).on('submit','#add-cader',function(event){ 
		event.preventDefault(); //prevent default action 
		var post_url = $(this).attr("action"); //get form action url
		var request_method = $(this).attr("method"); //get form GET/POST method
		var form_data = $(this).serialize(); //Encode form elements for submission
        $('#jquery-error').html(null);
        $('#jquery-error').css('display','none');
		$.ajax({
			url:post_url,
			method:request_method,
			data:form_data,
			success:function(data){
                showFrontendAlert('success', 'تم أضافة الكادر للفعالية', '');
                $('#event_caders').html(null);
                $('#event_caders').html(data);
                $('#modal').modal('hide');
			},
            error: function( data ){
                if(data.status === 422){
                    $('#jquery-error').css('display','block');
                    let response = $.parseJSON(data.responseText);
                    $.each(response.errors, function (key, value){
                        $('#jquery-error').append("<p> " + value + " </p>");
                    });
                }
            }
		})
    })   

    
    $(document).on('submit','#edit-cader',function(event){ 
		event.preventDefault(); //prevent default action 
		var post_url = $(this).attr("action"); //get form action url
		var request_method = $(this).attr("method"); //get form GET/POST method
		var form_data = $(this).serialize(); //Encode form elements for submission
        $('#jquery-error').html(null);
        $('#jquery-error').css('display','none');
		$.ajax({
			url:post_url,
			method:request_method,
			data:form_data,
			success:function(data){
                showFrontendAlert('success', 'تم التعديل', '');
                $('#event_caders').html(null);
                $('#event_caders').html(data);
                $('#modal').modal('hide');
			},
            error: function( data ){
                if(data.status === 422){
                    $('#jquery-error').css('display','block');
                    let response = $.parseJSON(data.responseText);
                    $.each(response.errors, function (key, value){
                        $('#jquery-error').append("<p> " + value + " </p>");
                    });
                }
            }
		})
    })   
</script>

@endsection