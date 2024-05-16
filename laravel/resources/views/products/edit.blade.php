<x-app-layout>
    <form action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        @isset($product)
            @method('PUT')
        @endisset
        <div class="row">
            <label for="name">Name</label>
            <input class="text-black" type="text" name="name" id="name" value="{{ isset($product) ? old('name', $product->name) : old('name') }}">
        </div>
        <div class="row">
            <label for="description">Description</label>
            <input class="text-black" type="text" name="description" id="description" value="{{ isset($product) ? old('description', $product->description) : old('desc') }}">
        </div>
        <div class="row">
            <label for="price">Price</label>
            <input class="text-black" type="number" name="price" id="price" value="{{ isset($product) ? old('price', $product->price) : old('price') }}">
        </div>
        <div class="row">
            <label for="category_id">CategoryId</label>
            <input class="text-black" type="text" name="category_id" id="category_id" value="{{ isset($product) ? old('category_id', $product->category_id) : old('category_id') }}">
            <!-- <select name="category_id" id="category_id"> -->
            <!--     @foreach($categories as $category) -->
            <!--         <option value="{{ $category->id }}">{{ $category->name }}</option> -->
            <!--     @endforeach -->
            <!-- </select> -->
        </div>
        <div class="row">
            <label class="block mt-2" for="featured_image">
                <span class="sr-only">Choose image</span>
                <input type="file" id="featured_image" name="featured_image" class="block w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-violet-50 file:text-violet-700
                hover:file:bg-violet-100"/>
            </label>
            <div class="shrink-0 my-2">
                <img id="featured_image_preview" class="h-64 w-128 object-cover rounded-md" src="{{ isset($product) ? Storage::url($product->featured_image) : '' }}" alt="Featured image preview" />
            </div>
        </div>
        <div class="row">
            <x-primary-button type="submit">
                {{ isset($product) ? __('UPDATE PRODUCT') : __('CREATE PRODUCT') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        // create onchange event listener for featured_image input
        document.getElementById('featured_image').onchange = function(evt) {
            const [file] = this.files
            if (file) {
                // if there is an image, create a preview in featured_image_preview
                document.getElementById('featured_image_preview').src = URL.createObjectURL(file)
            }
        }
    </script>
</x-app-layout>

