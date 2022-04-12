<x-admin.app-layout>
    <x-slot name="header">
        {{ __('Edit premium request') }}
    </x-slot>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.ads.types.update', [$ad->id, $type->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="expire-date-required">
                                {{ __('Expire date') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <input type="date" name="expire_date" class="form-control"
                                   id="expire-date-required"
                                   value="{{ old('expire_date', is_null($type->expire_date) ? now()->format('Y-m-d') : $type->expire_date->format('Y-m-d')) }}"
                                   min="{{ now()->format('Y-m-d') }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       class="custom-control-input @error('status') is-invalid @enderror" id="status"
                                       name="is_active" value="1"
                                    {{ !old('is_active', $type->is_active) ?: 'checked' }}>
                                <label class="custom-control-label" for="status">{{ __('Status') }}</label>
                            </div>

                            @error('is_active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-fw fa-pen"></i> {{ __('Edit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
