<h5 class="text-center mb-2">الكوادر في الفعالية</h5>
@foreach($event->caders()->wherePivot('status','accepted')->get() as $cader) 
    <div class="card" onclick="zoomInMap('{{ $cader->latitude }}', {{ $cader->longitude }} )" style="cursor: pointer"> 
        <div class="card-body"> 
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
    </div> 
@endforeach