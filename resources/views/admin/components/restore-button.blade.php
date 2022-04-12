<form class="d-inline" action="{{ $route }}" method="POST">
    @csrf
    @method('POST')
    <button type="submit" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top"
            title="{{ __("Restore") }}">
            <span class="btn-inner--icon">
              <i class="fa fa-trash-restore-alt fa-fw"></i>
            </span>
    </button>
</form>
