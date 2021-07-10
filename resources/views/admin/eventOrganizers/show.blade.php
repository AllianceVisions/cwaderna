@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.eventOrganizer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-organizers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $eventOrganizer->user ? $eventOrganizer->user->id : "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.first_name') }}
                        </th>
                        <td>
                            {{ $eventOrganizer->user ? $eventOrganizer->user->first_name : "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.last_name') }}
                        </th>
                        <td>
                            {{ $eventOrganizer->user ? $eventOrganizer->user->last_name : "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $eventOrganizer->user ? $eventOrganizer->user->email : "" }}
                        </td>
                    </tr> 
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.city_id') }}
                        </th>
                        <td>
                            @php $name = 'name_'.app()->getLocale();@endphp
                            {{ $eventOrganizer->user->city ? $eventOrganizer->user->city->$name : "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $eventOrganizer->user ? $eventOrganizer->user->phone : "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.nationality_id') }}
                        </th>
                        <td>
                            {{ $eventOrganizer->user ? $eventOrganizer->user->nationality->$name : "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.identity_num') }}
                        </th>
                        <td>
                            {{ $eventOrganizer->user ? $eventOrganizer->user->identity_num : "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.gender') }}
                        </th>
                        <td>
                            {{ $eventOrganizer->user ? App\Models\User::GENDER_SELECT[$eventOrganizer->user->gender] : "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.photo') }}
                        </th>
                        <td>
                            @if($eventOrganizer->user && $eventOrganizer->user->photo)
                                <a href="{{ asset($eventOrganizer->user->photo->getUrl()) }}" target="_blank" style="display: inline-block">
                                    <img src="{{ asset($eventOrganizer->user->photo->getUrl('thumb')) }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventOrganizer.fields.company_name') }}
                        </th>
                        <td>
                            {{ $eventOrganizer->company_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventOrganizer.fields.identity') }}
                        </th>
                        <td>
                            @if($eventOrganizer->identity)
                                <a href="{{ asset($eventOrganizer->identity->getUrl()) }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventOrganizer.fields.commerical_reg') }}
                        </th>
                        <td>
                            @if($eventOrganizer->commerical_reg)
                                <a href="{{ asset($eventOrganizer->commerical_reg->getUrl()) }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-organizers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
