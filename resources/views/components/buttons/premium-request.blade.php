@if($boolean ?? true)
    <a href="{{ $route }}"
       class="btn btn-dark btn-sm"
       data-toggle="tooltip"
       data-placement="top"
       data-original-title="{{ __('Premium requests') }}">
        <i class="fa fa-clipboard-check fa-fw"></i>
    </a>
@endif
