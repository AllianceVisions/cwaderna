@extends('layouts.admin')
@section('content')
@can('cader_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.caders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cader.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.cader.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Cader">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cader.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.city_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.user.fields.date_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.gender') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.nationality_id') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.user.fields.identity_num') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th> 
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($caders as $key => $cader)
                        <tr data-entry-id="{{ $cader->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cader->id ?? '' }}
                            </td>
                            <td>
                                {{ $cader->user ? $cader->user->first_name . " " . $cader->user->last_name : '' }}
                            </td>
                            <td>
                                @php $name = 'name_'.app()->getLocale();@endphp
                                {{ $cader->user->city ? $cader->user->city->$name : '' }}
                            </td>
                            <td>
                                {{ $cader->user->email ?? '' }}
                            </td>
                            {{-- <td>
                                {{ $cader->user->date_of_birth ?? '' }}
                            </td>
                            <td>
                                @if($cader->user)
                                    {{ $cader->user::GENDER_SELECT[$cader->user->gender] ?? '' }}
                                @endif
                            </td>  --}}
                            <td>
                                {{ $cader->user->phone ?? '' }}
                            </td>
                            <td>
                                {{ $cader->user->nationality ? $cader->user->nationality->$name : '' }}
                            </td>
                            {{-- <td>
                                {{ $cader->user->identity_num ?? '' }}
                            </td> --}}
                            <td>
                                <label class="c-switch c-switch-pill c-switch-success">
                                    <input onchange="update_approved(this)" value="{{$cader->user_id}}" type="checkbox" class="c-switch-input" {{ ($cader->user->approved ? 'checked' : null) }}>
                                    <span class="c-switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                @can('cader_show')
                                    <a href="{{ route('admin.caders.show', $cader->id) }}" class="btn btn-outline-info btn-pill action-buttons-view" >
                                        <i  class="fas fa-eye actions-custom-i"></i>
                                    </a>
                                @endcan

                                @can('cader_edit')
                                    <a  href="{{ route('admin.caders.edit', $cader->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit">
                                        <i  class="fa fa-edit actions-custom-i"></i> 
                                    </a>
                                @endcan

                                @can('cader_delete')
                                    <?php $route = route('admin.caders.destroy', $cader->id); ?>
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
        $.post('{{ route('admin.caders.update_approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
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
        let table = $('.datatable-Cader:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
    })

</script>
@endsection