@extends('layouts.frontend')
@section('styles')  
<style> 

    .partials-scrollable{
        background: #80808017;
        padding: 20px;
        max-height: 300px;
        overflow: scroll;
    } 

    .partials-scrollable::-webkit-scrollbar {
        width: 5px;
    }

    .partials-scrollable::-webkit-scrollbar-track {
        background:rgba(0,0,0,.0); 
        border-radius: 10px;
    }

    .partials-scrollable::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: rgba(0,0,0,.3); 
    }
    .partials-scrollable::-webkit-scrollbar-thumb:hover {
        background: black; 
    }
</style>
@endsection
@section('content') 

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
        <li><a href="#">الرئيسية</a></li>
        <li class="active"><a href="#">طلبات الخدمات والكوادر</a></li>
        </ul>
        <!-- /.list-unstyled -->
        <h2 class="inner-banner__title">طلبات الخدمات والكوادر</h2>
        <!-- /.inner-banner__title -->
    </div>
    <!-- /.container -->
</section>

<div class="cart">
    <div class="container">
        <br /><br /><br />
        <div class="table-responsive">
            @foreach($events as $event)
                <table class="table datatable"> 
                    <thead class="thead-primary">
                        <tr>
                            <th scope="col" colspan="2">{{$event->title}}</th>
                            <th scope="col" colspan="4">{{$event->city ? $event->city->name_ar : ""}} <small>{{$event->address}}</small> </th>
                            <th scope="col"><span class="badge bg-default">{{ $event->start_date }}  <br /> {{$event->end_date}}</span></th>
                            <th scope="col"><a href="{{route('frontend.events.request',$event->id)}}" class="btn btn-success">طلب تسعير</a></th>
                        </tr>
                    </thead>
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <div class="partials-scrollable" style="max-height: 320px">
                            <table class="table"> 
    
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">اسم الكادر</th>
                                        <th scope="col">وقت الحضور</th>
                                        <th scope="col">التخصص</th>
                                        <th scope="col">حذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($event->caders->count() > 0)
                                        @foreach($event->caders as $cader)
                                            <tr>
                                                <th scope="row">{{$cader->user->first_name . " " . $cader->user->last_name}}</th>
                                                <td>
                                                    {{$cader->pivot_start_attendance()}} <br>
                                                    {{$cader->pivot_end_attendance()}} 
                                                </td>
                                                <td>{{\App\Models\Specialization::find($cader->pivot->specialization_id)->name_ar ?? ""}}</td>
                                                <td>
                                                    <form action="{{ route('frontend.events.cader.destroy') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                                        @csrf
                                                        <input type="hidden" name="cader_id" value="{{$cader->id}}">
                                                        <input type="hidden" name="event_id" value="{{$event->id}}">
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr> 
                                        @endforeach
                                    @else 
                                        <td>لم يتم الأضافة بعد</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="partials-scrollable" style="max-height: 320px">
                            <table class="table"> 

                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">اسم الخدمة</th>
                                        <th scope="col">المدة</th>
                                        <th scope="col">حذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($event->items->count() > 0)
                                        @foreach($event->items as $item)
                                            <tr>
                                                <td>{{$item->title}}</td>
                                                <td>
                                                    {{$item->pivot_start_attendance()}} <br>
                                                    {{$item->pivot_end_attendance()}} 
                                                </td>
                                                <td>
                                                    <form action="{{ route('frontend.events.service.destroy') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                                        @csrf
                                                        <input type="hidden" name="item_id" value="{{$item->id}}">
                                                        <input type="hidden" name="event_id" value="{{$event->id}}">
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr> 
                                        @endforeach
                                    @else 
                                        <td>لم يتم الأضافة بعد</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 

                <br />
                
            @endforeach
        </div>
        
        <div class="post-pagination">
            {{ $events->links('vendor.pagination.bootstrap-4') }}
        </div> 
    </div>
</div>
@endsection  

@section('scripts')
@parent
<script> 
</script>
@endsection