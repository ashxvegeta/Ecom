<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



    <h1>Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <div>
            <label for="parent_id">Parent Category:</label>
            <select name="parent_id" id="parent_id">
                <option value="none">None</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Create Category</button>
    </form>
    
</body>
</html>