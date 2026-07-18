<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Brand</h1>
    <form action="{{ route('brands.update', $brands->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $brands->name }}" required>
        </div>
        <div>
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="1" {{ $brands->status === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $brands->status === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div>
            <label for="current_logo">Current Logo:</label>
            @if($brands->logo)
                <img src="{{ Storage::url($brands->logo) }}" alt="{{ $brands->name }}" width="100">
            @else
                No Logo
            @endif
        </div>
        <div>
            <label for="logo">Logo:</label>
            <input type="file" name="logo" id="logo">
        </div>
        <button type="submit">Update Brand</button>
    </form>
</body>
</html>