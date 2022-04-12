<form class="d-inline delete-form" action="{{ $route }}"
      method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
            data-placement="top" title="" data-original-title="{{ __('Delete') }}">
        <i class="fa fa-trash fa-fw"></i>
    </button>
</form>
