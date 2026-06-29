<option value="{{ $category->id }}"
    {{ isset($category_edit) && $category_edit== $category->id ? 'selected' : '' }}>
    
    {{ str_repeat('-> ', $level) }} {{ $category->name }}
</option>

@if($category->children && $category->children->count())
    @foreach($category->children as $child)
        @include('partials.categorys-option', [
            'category' => $child,
            'level' => $level + 1,
            'category_edit' => isset($category_edit) ? $category_edit : null
        ])
    @endforeach
@endif



