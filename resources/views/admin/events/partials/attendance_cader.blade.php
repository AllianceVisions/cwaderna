
@php
    $begin = new DateTime( str_replace('/','-',$event->start_date) );
    $end   = new DateTime( str_replace('/','-',$event->end_date) );
@endphp

<div class="partials-scrollable" style="max-height: 450px;background: #80808000;">
    @for($i = $begin; $i <= $end; $i->modify('+1 day'))  
        <h4 class="mt-3">{{ $i->format("Y-m-d") }}</h4>
        <table class="table table-bordered table-striped table-hover "> 
            <thead>
                <tr>
                    <td>{{trans('cruds.event.others.attendance')}}</td>
                    <td>{{trans('cruds.event.others.location')}}</td>
                    <td>{{trans('cruds.event.others.distance')}}</td> 
                    <td></td>
                </tr>
            </thead>
            @foreach($attendance as $raw) 
                @if($i->format('Y-m-d') == $raw->pivot->attendance1)
                    <tr> 
                        <td>{{$raw->pivot->attendance2}}</td>
                        <td>
                            {{$raw->pivot->longitude}} <br>
                            {{$raw->pivot->latitude}}
                        </td>
                        <td>
                            {{$raw->pivot->distance}} <br>
                            @if($raw->pivot->out_of_zone)
                                <span class="badge bg-danger text-white">خارج نطاق الفعالية</span>
                            @else 
                                <span class="badge bg-success text-white">داخل نطاق الفعالية</span>
                            @endif
                        </td>
                        <td>
                            @if($raw->pivot->type == 'attend')
                                <span class="badge bg-info text-white">تأكيد حضور</span>
                            @else 
                                <span class="badge bg-warning text-white">تأكيد أنصراف</span>
                            @endif
                        </td>
                    </tr> 
                @endif
            @endforeach
        </table>    
        <hr>
    @endfor
</div>
