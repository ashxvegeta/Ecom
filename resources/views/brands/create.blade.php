<h1>Create Brand</h1>

<form action="{{ route('brands.store') }}" method="POST">

    @csrf

    <input type="text" name="name" placeholder="Brand Name">

    <select name="status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <button type="submit">
        Save
    </button>

</form>