@if ($image)
{{-- <picture>
    <source media="(min-width:1200px)" data-srcset="{{ asset('storage/original/' . $image.' 1200w') }}">
<source media="(min-width:860px)" data-srcset="{{ asset('storage/large/' . $image.' 860w') }}">
<source media="(min-width:640px)" data-srcset="{{ asset('storage/medium/' . $image.' 640w') }}">
<source media="(max-width:420px)" data-srcset="{{ asset('storage/mobile/' . $image.' 420w') }}">
<img class="lazyload blur-up img-fluid" src="{{ asset('storage/tiny/' . $image) }}">
</picture> --}}
<img class="img-fluid" src="{{ asset('storage/original/' . $image) }}">
@else
<img src="{{ asset('images/noimage.png') }}" alt="">
@endif
