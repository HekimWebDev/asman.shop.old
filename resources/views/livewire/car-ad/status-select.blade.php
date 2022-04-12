<div>
    <label>
        <select class="form-control" wire:change="changeEvent($event.target.value)">
            @foreach($statuses as $key => $value)
                <option value="{{ $key }}" @if ($carAd->status === $key) selected @endif>{{ __($value) }}</option>
            @endforeach
        </select>
    </label>
</div>
