<x-admin.app-layout>

    @push('styles')
    <script src="{{ asset('admin/vendor/ckeditor/ckeditor.js') }}"></script>
    @endpush

    <x-slot name="header">
        {{ __('Create attribute') }}
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
                    <form method="POST" action="{{ route('admin.attributes.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="attribute_group">
                                {{ __('Group') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <select
                                class="form-control border selectpicker show-tick @error('attribute_group_id') is-invalid @enderror"
                                name="attribute_group_id" id="attribute_group" data-live-search="true"
                                data-style="btn-white" required>
                                <option value="">{{ __('Select group..') }}</option>
                                @foreach ($attribute_groups as $attribute_group)
                                <option value="{{ $attribute_group->id }}"
                                    {{ old('attribute_group_id') == $attribute_group->id ? 'selected' : '' }}>
                                    {{ $attribute_group->name ?? '' }}</option>
                                @endforeach
                            </select>

                            @error('attribute_group_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="name">
                                    {{ __('Name') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                @include('admin.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                <input type="hidden" id="name" name="name:{{ $key }}"
                                    class="form-control @error('name:'.$key) is-invalid @enderror"
                                    input-lang="{{ $key }}" value="{{ old('name:'.$key) }}" required>

                                @error('name:'.$key)
                                <span style="display: none" input-lang="{{ $key }}" class="invalid-feedback"
                                    role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @endforeach

                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="description">
                                    {{ __('Description') }}
                                </label>
                                @include('admin.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                <div style="display: none;" input-lang="{{ $key }}">
                                    <textarea id="description" name="description:{{ $key }}"
                                        class="ckeditor form-control @error('description:'.$key) is-invalid @enderror">{{ old('description:'.$key) ?? '' }}</textarea>
                                </div>

                                @error('description:'.$key)
                                <span style="display: none" input-lang="{{ $key }}" class="invalid-feedback"
                                    role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                    class="custom-control-input @error('status') is-invalid @enderror" id="status"
                                    name="status" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">{{ __('Status') }}</label>
                            </div>

                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm float-right">
                                    <i class="fa fa-fw fa-plus"></i> {{ __('Create') }}
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('js/form-lang.js') }}"></script>
    @endpush

</x-admin.app-layout>
