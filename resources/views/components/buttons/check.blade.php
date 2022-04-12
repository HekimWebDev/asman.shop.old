@if ($boolean ?? true)
    <a href="{{ $route }}"
       class="btn btn-warning btn-sm" data-toggle="tooltip"
       data-placement="top" title="" data-original-title="{{ __('Edit premium request') }}">
        <i class="fa fa-clipboard-check fa-fw"></i>
    </a>
@endif
