<h1>Products Page Working</h1>

@if($products->count() == 0)

    <p>No Products Found</p>

@endif

<h1>Products</h1>

<table border="1">

<tr>
    <th>Name</th>
    <th>Brand</th>
    <th>Status</th>
</tr>


@foreach($products as $product)

<tr>

    <td>
        {{ $product->name }}
    </td>


    <td>
        {{ $product->brand->name ?? 'No Brand' }}
    </td>


    <td>
        {{ $product->status ? 'Active' : 'Inactive' }}
    </td>

</tr>

@endforeach


</table>