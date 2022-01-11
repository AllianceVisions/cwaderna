<h5 class="text-center mb-2">الكوادر في الفعالية</h5>
@foreach($event->caders()->wherePivot('status','accepted')->get() as $cader) 
    <div class="card" onclick="zoomInMap('{{ $cader->id }}')"" style="cursor: pointer"> 
        <div class="card-body"> 
            <div class="row">
                <div class="col-md-6">
                    @if ($cader->user && $cader->user->photo)
                        @php
                            $image = str_replace('public/public','public',asset($cader->user->photo->getUrl('thumb')));
                        @endphp
                        <img src="{{ $image  }}" alt="avatar">
                    @else
                        <img src="{{ asset('user.png') }}" alt="avatar">
                    @endif
                    <span class="badge badge-light">
                        {{ $cader->user->first_name }}  {{ $cader->user->last_name}} <br> 
                        @php
                            $specialization_id = $cader->events()->where('event_id',$event->id)->first()->pivot->specialization_id;
                        @endphp
                        {{ \App\Models\Specialization::find($specialization_id)->name_ar ?? '' }}
                    </span>
                    <br>
                    @if ($cader->out_of_zone)
                        <span class="badge badge-danger">خارج نطاق الفعالية</span>
                    @else
                        <span class="badge badge-success">داخل نطاق الفعالية</span>
                    @endif 
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-outline-info" onclick="cader_attendance({{$cader->id}})">سجل الحضور</button> 
                    <button type="button" class="btn btn-outline-success" onclick="cader_break({{$cader->id}})">
                        طلبات الأذن
                        <span class="badge badge-light"> {{ \App\Models\EventBreak::where('cader_id',$cader->id)->where('event_id',$event->id)->count() }} </span>
                    </button> 
                </div>
            </div>
        </div>
    </div> 
@endforeach