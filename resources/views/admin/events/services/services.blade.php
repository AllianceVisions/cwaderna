
    <label>{{ trans('cruds.item.title') }}</label>
    <table class="table"> 
        <thead>
            <tr>
                <td>{{trans('cruds.providerMan.title_singular')}}</td>
                <td>{{trans('cruds.providerMan.others.item_name')}}</td>
                <td>{{trans('cruds.providerMan.others.attendance')}}</td>
                <td>{{trans('cruds.providerMan.others.profit')}}</td>
                <td>{{trans('cruds.providerMan.others.price')}}</td>
                <td> 
                    @if(Auth::user()->user_type == 'staff')
                        @if($event->status == 'request_to_pricing')
                            <a role="button"  href="#"  class="btn btn-success" onclick="add_item()">
                                {{trans('global.add')}} {{trans('cruds.item.title_singular')}}
                            </a>
                        @endif
                    @endif
                </td>
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