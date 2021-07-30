@extends('layouts.admin')
@section('content')
@can('provider_man_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.provider-men.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.providerMan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.providerMan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProviderMan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.providerMan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.gender') }}
                        </th> 
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.city_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.nationality_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.identity_num') }}
                        </th> 
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th> 
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($providerMen as $key => $providerMan)
                        <tr data-entry-id="{{ $providerMan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $providerMan->id ?? '' }}
                            </td>
                            <td>
                                {{ $providerMan->user ? $providerMan->user->first_name . " " . $providerMan->user->last_name :  '' }}
                            </td>
                            <td>
                                {{ $providerMan->user->email ?? '' }}
                            </td>
                            <td>
                                @if($providerMan->user)
                                    {{ $providerMan->user::GENDER_SELECT[$providerMan->user->gender] ?? '' }}
                                @endif
                            </td> 
                            <td>
                                {{ $providerMan->user->phone ?? '' }}
                            </td>
                            <td>
                                @php $name = 'name_'.app()->getLocale();@endphp
                                {{ $providerMan->user->city ? $providerMan->user->city->$name : '' }}
                            </td>
                            <td>
                                {{ $providerMan->user->nationality ? $providerMan->user->nationality->$name : '' }}
                            </td>
                            <td>
                                {{ $providerMan->user->identity_num ?? '' }}
                            </td> 
                            <td>
                                <label class="c-switch c-switch-pill c-switch-success">
                                    <input onchange="update_approved(this)" value="{{$providerMan->user_id}}" type="checkbox" class="c-switch-input" {{ ($providerMan->user->approved ? 'checked' : null) }}>
                                    <span class="c-switch-slider"></span>
                                </label>
                            </td>
                            <td> 

                                @can('provider_man_edit')
                                    <a href="{{ route('admin.provider-men.edit', $providerMan->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit"   title="{{ trans('global.edit') }}"><i  class="fa fa-edit actions-custom-i"></i></a>
                                @endcan

                                @can('provider_man_delete') 
                                    <?php $route = route('admin.provider-men.destroy', $providerMan->id); ?>
                                    <a  href="#" onclick="deleteConfirmation('{{$route}}')" class="btn btn-outline-danger btn-pill action-buttons-delete">
                                        <i  class="fa fa-trash actions-custom-i"></i>
                                    </a> 
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    
    function update_approved(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('admin.provider-men.update_approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                showFrontendAlert('success',"{{ trans('global.flash.user.approve') }}");
            }else{
                showFrontendAlert('error',"{{ trans('global.flash.error') }}");
            }
        });
    } 

    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 
        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });
        let table = $('.datatable-ProviderMan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
    })

</script>
@endsection
