@extends('layouts.app')

@section('title', 'Order Success')

@section('content')
    <div class="py-3 py-md-5">
        <div class="container text-center">
            <h4>Order Placed Successfully!</h4>
            <p>Thank you for your order. We will contact you shortly for delivery details.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
        </div>
    </div>
@endsection
