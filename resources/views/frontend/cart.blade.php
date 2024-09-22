@extends('layouts.app')

@section('title', 'Cart')
@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('removed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('removed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">
                        @if ($cartItems->isEmpty())
                            <div class="alert text-center">
                                <h4>Empty Cart</h4>
                                <p>No Have Any Items</p>
                                <a href="{{ route('frontend.category') }}" class="btn btn-primary">Go To Category</a>

                            </div>
                        @else
                            <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                                <div class="row">
                                    <div class="col-md-5">
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

                            @php
                                $totalPrice = 0;
                            @endphp

                            @foreach ($cartItems as $cartItem)
                                @php
                                    $itemTotal = $cartItem->category->price * $cartItem->quantity;
                                    $totalPrice += $itemTotal;
                                @endphp
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-5 my-auto">
                                            <label class="product-name">
                                                <img src="{{ asset('uploads/category/' . $cartItem->category->image) }}"
                                                    style="width: 50px; height: 50px" alt="">
                                                {{ $cartItem->category->name }}
                                            </label>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">${{ $cartItem->category->price }}</label>
                                        </div>
                                        <div class="col-md-3 col-9">
                                            <div class="quantity">
                                                <form action="{{ route('cart.update', $cartItem->id) }}" method="POST"
                                                    class="d-flex align-items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            onclick="decFunction({{ $cartItem->id }})">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                        <input type="text" id="quantity-{{ $cartItem->id }}"
                                                            name="quantity" value="{{ $cartItem->quantity }}"
                                                            class="text-center" style="width: 60px;" min="1" />
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            onclick="incFunction({{ $cartItem->id }})">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary ms-2">Update</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="cart-total">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="total">
                                            <h4>Total Price: ${{ $totalPrice }} </h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkout">
                                            <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    function incFunction(cartItemId) {
        let quantityInput = document.getElementById(`quantity-${cartItemId}`);
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    }

    function decFunction(cartItemId) {
        let quantityInput = document.getElementById(`quantity-${cartItemId}`);
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    }
</script>
