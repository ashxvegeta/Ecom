<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Brands</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->status }}</td>
                    <td><img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" width="100"></td>
                    <td>
                        <a href="{{ route('brands.edit', $brand->id) }}">Edit</a>
                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>