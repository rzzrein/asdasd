<div class="action-hide table-action">
    @if(checkPerm($permission.'-update'))
        <a href="{{ url($page.'/'.$id.'/edit') }}" class="btn-action" data-toggle="tooltip" title="Edit">
            <i class="fa fa-edit"></i>
        </a>
    @endif
    @if(checkPerm($permission.'-delete'))
        <a href="#" class="btn-action btn-delete" data-id="{{ $id }}" data-toggle="tooltip" title="Delete">
            <i class="fa fa-trash"></i>
        </a>
    @endif
</div>
