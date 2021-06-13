@extends('events_organizer.layout.events_organizer')
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
                                    {{ trans('cruds.event.fields.specializations') }}
                                </th>
                                <td>
                                    @php $name = 'name_'.app()->getLocale(); @endphp
                                    @foreach ($event->specializations as $specialize)
                                        <span class="badge bg-secondary">{{$specialize->$name}} <span class="badge bg-success text-white">{{$specialize->pivot->num_of_caders}}</span></span>
                                    @endforeach
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
                <div class="col-md-6">

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
