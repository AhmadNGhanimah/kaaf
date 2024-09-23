<div class="container">
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif

    </div>

    <div class="p-3 border rounded bg-light">
        <h4 class="mb-3">Price</h4>
        <div class="form-group">
            <div class="form-check">
                <input type="radio" class="form-check-input" name="priceSort" id="high" wire:model="priceInput"
                    value="high-to-low">
                <label class="form-check-label" for="high">High to Low</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="priceSort" id="low" wire:model="priceInput"
                    value="low-to-high">
                <label class="form-check-label" for="low">Low to High</label>
            </div>
        </div>
    </div>



    <h4 class="mb-4">Our Categories</h4>
    <div class="row">
        @foreach ($categories as $categoryItem)
            <div class="col-md-4 mb-4">
                <div class="categoryItem-card">
                    <div class="categoryItem-card-img">
                        <label class="stock bg-success">In Stock</label>
                        <img src="{{ asset('/uploads/category/' . $categoryItem->image) }}"
                            alt="{{ $categoryItem->name }}">
                    </div>
                    <div class="categoryItem-card-body">
                        <h5 class="categoryItem-name">{{ $categoryItem->name }}</h5>
                        <div>
                            <span class="original-price">${{ $categoryItem->price }}</span>
                            <p>{{ $categoryItem->smallDescription }}</p>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary" wire:click="addToCart({{ $categoryItem->id }})">
                                Add To Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
