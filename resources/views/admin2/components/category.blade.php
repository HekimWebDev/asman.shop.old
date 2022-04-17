@foreach ($childs as $child)
    <option {{ ($category->id ?? '') === $child->id ? 'disabled' : '' }}
        {{ old('parent_id') == $child->id ? 'selected' : '' }}
        {{ request()->routeIs('admin.categories.edit') && $child->one_c_id == $category->one_c_parent_id ? 'selected' : '' }}
        {{-- {{ request()->routeIs('admin.pc-collects.index') && $child->pcCollect() ? 'selected' : '' }} --}} {{ ($category_id ?? null) === $child->id ? 'selected' : '' }}
        value="{{ $child->id }}">
        @for ($i = 0; $i < $spaces; $i++) &emsp; @endfor {{ $child->name ?? '' }} @if ($child->childs->isNotEmpty()) @include('admin2.components.category',
            ['childs' => $child->childs, 'spaces' => $spaces + 1]) @endif
    </option>
@endforeach
