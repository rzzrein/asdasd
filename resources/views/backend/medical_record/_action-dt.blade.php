<div class="action-hide table-action">
    <!-- @if(checkPerm($permission.'-update')) -->
        <a href="#" class="btn-action encrypt-modal" data-toggle="tooltip" title="Edit" data-id="{{ $id }}">
            <i class="fa fa-lock"></i>
        </a>
    <!-- @endif -->
    <!-- @if(checkPerm($permission.'-delete')) -->
        <a href="" class="btn-action btn-delete" data-id="{{ $id }}" data-toggle="tooltip" title="Delete">
            <i class="fa fa-trash"></i>
        </a>
    <!-- @endif -->
</div>
