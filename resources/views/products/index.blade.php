<h1>Products Page Working</h1>

@if($products->isEmpty())

    <p>No Products Found</p>

@endif

<h1>Products</h1>

<table border="1">

<tr>
    <th>Name</th>
    <th>Brand</th>
    <th>Categories</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Status</th>
    <th>Images</th>
    <th>Actions</th>
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
        @foreach($product->categories as $category)
            {{ $category->name }}<br>
        @endforeach
    </td>

    <td>
       {{ $product->productItems->first()->price ?? 'N/A' }}
    </td>

    <td>
       {{ $product->productItems->first()->stock ?? 'N/A' }}
    </td>

    <td>
        {{ $product->status ? 'Active' : 'Inactive' }}
    </td>

    <td>
        @if($product->productImages->isNotEmpty())

                <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}" alt="Product Image" width="50">
      
        @else
            No Images
        @endif
    </td>
    <td>
        <a href="{{ route('products.edit', $product->id) }}">Edit</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
@endforeach


</table>