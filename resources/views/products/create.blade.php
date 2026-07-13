<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create Product</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Basic Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            {{-- Product Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name <span class="text-red-500">*</span></label>
                <input
                    type="text"
                    name="name"
                    id="product-name"
                    value="{{ old('name') }}"
                    placeholder="Enter product name"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

        

            {{-- Brand Dropdown --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                <select
                    name="brand_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">-- Select Brand --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Category Multi Select --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categories</label>
                <select
                    name="category_ids[]"
                    multiple
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    style="min-height: 120px;"
                >
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ in_array($category->id, old('category_ids', [])) ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-400 mt-1">Hold Ctrl / Cmd to select multiple.</p>
                @error('category_ids') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Price --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price (₹) <span class="text-red-500">*</span></label>
                <input
                    type="number"
                    name="price"
                    value="{{ old('price') }}"
                    placeholder="0.00"
                    step="0.01"
                    min="0"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Stock --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock <span class="text-red-500">*</span></label>
                <input
                    type="number"
                    name="stock"
                    value="{{ old('stock') }}"
                    placeholder="0"
                    min="0"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- SKU --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                <input
                    type="text"
                    name="sku"
                    value="{{ old('sku') }}"
                    placeholder="e.g. PROD-001"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('sku') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select
                    name="status"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="1"   {{ old('status', '1') == '1'   ? 'selected' : '' }}>Active</option>
                   <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                   
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

        </div>

        {{-- Short Description --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
            <textarea
                name="short_description"
                rows="2"
                placeholder="Brief summary shown in product listings..."
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >{{ old('short_description') }}</textarea>
            @error('short_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Description --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Description</label>
            <textarea
                name="description"
                rows="6"
                placeholder="Detailed product description..."
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Images --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Product Images</label>
            <input
                type="file"
                name="images[]"
                multiple
                accept="image/*"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <p class="text-xs text-gray-400 mt-1">Select multiple images. First image will be the thumbnail.</p>
            @error('images')   <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Featured Toggle --}}
        <div class="mb-8">
            <label class="flex items-center gap-3 cursor-pointer w-fit">
                <input
                    type="hidden"
                    name="featured"
                    value="0"
                >
                <input
                    type="checkbox"
                    name="featured"
                    value="1"
                    {{ old('featured') ? 'checked' : '' }}
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                >
                <span class="text-sm font-medium text-gray-700">Mark as Featured Product</span>
            </label>
        </div>

        {{-- Submit --}}
        <div class="flex gap-4">
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition"
            >
                Save Product
            </button>
            
          
            </a>
        </div>

    </form>
</div>

