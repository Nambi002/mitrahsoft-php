





<option value="{{ $category->id }}"
    {{ isset($category_edit) && $category_edit->parent_id == $category->id ? 'selected' : '' }}>
    
    {{ str_repeat('-> ', $level) }} {{ $category->name }}
</option>

@if($category->children && $category->children->count())
    @foreach($category->children as $child)
        @include('partials.category-option', [
            'category' => $child,
            'level' => $level + 1,
            'category_edit' => isset($category_edit) ? $category_edit : null
        ])
    @endforeach
@endif



