<div>
    @can($viewGate) 
        <a href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}" class="btn btn-outline-info btn-pill action-buttons-view"  title="{{ trans('global.view') }}"><i  class="fas fa-eye actions-custom-i"></i></a>
    @endcan
    @can($editGate) 
        <a href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit"  title="{{ trans('global.edit') }}"><i  class="fa fa-edit actions-custom-i"></i></a>
    @endcan
    @can($deleteGate)
        <?php $route = route('admin.' . $crudRoutePart . '.destroy', $row->id); ?>
        <a  href="#" onclick="deleteConfirmation('{{$route}}')" class="btn btn-outline-danger btn-pill action-buttons-delete">
            <i  class="fa fa-trash actions-custom-i"></i>
        </a>  
    @endcan
</div>
