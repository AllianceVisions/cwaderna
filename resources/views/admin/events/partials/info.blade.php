
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
                        {{ trans('cruds.event.fields.area') }}
                    </th>
                    <td>
                        {{ $event->area }} متر
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