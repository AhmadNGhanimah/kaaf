@extends('layouts.app')

@section('title', 'Category')
@section('content')
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4 class="text-center">Checkout Your Order</h4>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Item Total Amount:
                            <span class="float-end">${{ $totalAmount }}</span>
                        </h4>
                        <h4 class="text-primary">
                            Basic Information
                        </h4>
                        <hr>

                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" name="fullname" class="form-control text-capitalize"
                                        placeholder="Enter Full Name" value="{{ auth()->user()->name }}" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" name="phone" class="form-control text-capitalize"
                                        placeholder="Enter Phone Number" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control text-capitalize"
                                        value="{{ auth()->user()->email }}" placeholder="Enter Email Address" required />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Full Address</label>
                                    <textarea name="address" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Select Payment</label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <button type="submit" class="btn btn-primary">Place Order (Cash on
                                                Delivery)</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
