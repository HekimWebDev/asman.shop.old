<div class="dropdown inline border-primary float-right">
    <button class="btn btn-outline-secondary btn-sm dropdown-toggle lang-toggle" type="button" data-toggle="dropdown">
        <i class="flag-icon flag-icon-{{ config('lang.locales.'.app()->getLocale().'.flag') }}"></i>
    </button>
    <div class="dropdown-menu">
        @foreach (config('lang.locales') as $key => $locale)
        <button type="button" class="dropdown-item" data-lang="{{ $key }}" data-flag="{{ $locale['flag'] }}">
            <i class="flag-icon flag-icon-{{ $locale['flag'] }}"></i>
            {{ __($locale['name']) }}
        </button>
        @endforeach
    </div>
</div>
