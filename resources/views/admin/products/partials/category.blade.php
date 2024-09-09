@if($category)
    <a href="{{ route('admin.categories.edit', $category) }}">{{ $category->name }}</a>
@endif
