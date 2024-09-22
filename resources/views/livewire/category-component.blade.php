<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <h4 class="text-center">Our Category</h4>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Price</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-block">
                            <input type="radio" name="priceSort" id="high" wire:model="priceInput"
                                value="high-to-low">
                            <label for="high">High to Low </label>
                        </div>
                        <div class="d-block">
                            <input type="radio" name="priceSort" id="low" wire:model="priceInput"
                                value="low-to-high">
                            <label for="low">Low to
                                High </label>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Newest Arrivals</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-block">
                            <input type="radio" name="arrivalSort" id="newest" wire:model="arrivelInput"
                                value="newest">
                            <label for="newest">Newest to Oldest</label>
                        </div>
                        <div class="d-block">
                            <input type="radio" name="arrivalSort" id="oldest" wire:model="arrivelInput"
                                value="oldest">
                            <label for="oldest">Oldest to Newest</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-4">
                            <div class="product-card">
                                <a href="{{ route('frontend.categoryDetails', $category->id) }}">
                                    <div class="product-card-img">
                                        <label class="stock bg-success">In Stock</label>
                                        <img src="{{ asset('uploads/category/' . $category->image) }}"
                                            alt="{{ $category->name }}">
                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $category->name }}</p>
                                        <h5 class="product-name">
                                            {{ $category->smallDescription }}
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{ $category->price }}</span>
                                        </div>
                                        <div class="mt-2">
                                            @auth
                                                <form action="{{ route('cart.add', $category->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Add To Cart</button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-primary">Add To
                                                    Cart</a>
                                            @endauth

                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>

    </div>
</div>
