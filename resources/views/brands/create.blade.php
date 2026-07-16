<h1>Create Brand</h1>

<form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <input type="text" name="name" placeholder="Brand Name">

    <select name="status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <input type="file" name="logo">
    <input type="submit" value="Create Brand">
</form>

 

</form>