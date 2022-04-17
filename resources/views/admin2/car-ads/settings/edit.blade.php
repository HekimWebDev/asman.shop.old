<x-admin.app-layout>
    <x-slot name="header">
        {{ __('Ad settings') }}
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
                    <form method="POST" action="{{ route('admin.ads.settings.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="archive_day_limit">
                                {{ __('Archive day limit') }}
                                <span class="required text-danger">*</span>
                            </label>
                            <input
                                @class([
                                    "form-control",
                                    "is-invalid" => $errors->has('archive_day_limit')
                                ])
                                type="number"
                                name="archive_day_limit"
                                id="archive_day_limit"
                                min="1"
                                value="{{ old('archive_day_limit', $adSettings->archive_day_limit) }}"
                                required
                            />

                            @error('archive_day_limit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-save fa-fw"></i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
