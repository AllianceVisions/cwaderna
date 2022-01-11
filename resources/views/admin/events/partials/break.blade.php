<table class="table table-bordered table-striped table-hover ">
    <thead>
        <tr>
            <td>نوع الأذن</td>
            <td>سبب الأذن</td>
            <td>الوقت المسموح</td>
            <td>وقت الطلب</td>
            <td>حالة الطلب</td>
            <td></td>
        </tr>
    </thead>
    @foreach ($event_breaks as $raw)
        <tr>
            <td>
                {{ $raw->break }}
            </td>
            <td>
                {{ $raw->reason }}
            </td>
            <td>
                {{ $raw->time }}
            </td>
            <td>
                {{ date('F j, Y, g:i a',strtotime($raw->created_at)) }}
            </td>
            <td>
                @if ($raw->status == 'pending')
                    <span class="badge bg-info text-white">قيد الأنتظار</span>
                @elseif($raw->status == 'accepted')
                    <span class="badge bg-success text-white">تم الموافقة</span>
                @elseif($raw->status == 'refused')
                    <span class="badge bg-danger text-white">تم الرفض</span>
                @elseif($raw->status == 'cancel')
                    <span class="badge bg-dark text-white">تم الألغاء</span>
                @endif
            </td>
            <td> 
                @if($raw->status == 'pending') 
                    <a href="{{ route('admin.events.partials.cader_break_status', [ 'id' => $raw->id , 'status' => 'accepted']) }}" class="btn btn-outline-success btn-pill action-buttons-edit" title="قبول">
                        <i  class="fas fa-check actions-custom-i"></i>
                    </a> 
                    <a href="{{ route('admin.events.partials.cader_break_status', [ 'id' => $raw->id , 'status' => 'refused']) }}" class="btn btn-outline-danger btn-pill action-buttons-delete" title="رفض">
                        <i  class="fas fa-times actions-custom-i"></i>
                    </a> 
                @endif 
            </td>
        </tr>
    @endforeach
</table>
