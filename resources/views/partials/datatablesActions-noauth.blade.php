<div>
    <div style="display: inline-block;padding:16px 0"> 
        <a href="{{ route($crudRoutePart . '.show', $row->id) }}" class="btn btn-outline-info btn-pill action-buttons-view"  title="{{ trans('global.view') }}"><i  class="fas fa-eye actions-custom-i"></i></a>
    </div>
    <div style="display: inline-block;" >
        <a href="{{ route($crudRoutePart . '.edit', $row->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit"  title="{{ trans('global.edit') }}"><i  class="fa fa-edit actions-custom-i"></i></a>
    </div>


    <form  action="{{ route($crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
        <button class="btn btn-outline-danger btn-pill action-buttons-delete" type="submit" title="{{ trans('global.delete') }}" ><i  class="fa fa-trash actions-custom-i"></i> </button>
    </form>  
</div>
