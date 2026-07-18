<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ $category->name }}">
    <br>
    <label for="status">Status:</label>
    <select name="status">
        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
    <br>

    @if($category->parent_id)
        <label for="parent_id">Parent Category:</label>
        <select name="parent_id">
            <option value="">None</option>
            @foreach($parents as $parent)
                <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
            @endforeach

    @endif
        </select>
        <br>

    <label for="image">Current Image:</label>
    @if($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="100">
    @endif
    <label for="image">Image:</label>
    <input type="file" name="image">
    <br>
    <button type="submit">Update</button>
    
</body>
</html>