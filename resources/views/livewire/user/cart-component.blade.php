<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">
                        @if ($cartItems->isEmpty())
                            <div class="text-center">
                                <h4>Your cart is empty.</h4>
                                <a href="{{ route('category.all') }}" class="btn btn-primary">Back to Categories</a>
                            </div>
                        @else
                            <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Products</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Price</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Quantity</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Remove</h4>
                                    </div>
                                </div>
                            </div>

                            @foreach ($cartItems as $item)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="">
                                                <label class="product-name">

                                                    <img src="{{ asset('uploads/category/' . $item->category->image) }}"
                                                        style="width: 50px; height: 50px"
                                                        alt="{{ $item->category->name }}">
                                                    {{ $item->category->name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">${{ $item->category->price }}</label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <span class="btn btn1"
                                                        wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"><i
                                                            class="fa fa-minus"></i></span>
                                                    <input type="text" value="{{ $item->quantity }}"
                                                        class="input-quantity" readonly />
                                                    <span class="btn btn1"
                                                        wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"><i
                                                            class="fa fa-plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button wire:click="removeItem({{ $item->id }})"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="total-amount">
                                <h5>Total Amount: ${{ $this->calculateTotal() }}</h5>
                                <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
