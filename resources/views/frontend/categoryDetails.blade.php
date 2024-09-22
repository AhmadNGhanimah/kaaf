@extends('layouts.app')

@section('title', 'Category')
@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                @forelse ($categories as $category)
                    <div class="col-md-5 mt-3">
                        <div class="bg-white border">
                            <img src=" {{ asset('uploads/category/' . $category->image) }}" class="w-100" alt="Img">
                        </div>
                    </div>
                    <div class="col-md-7 mt-3">

                        <div class="product-view">
                            <h4 class="product-name">
                                {{ $category->name }}<br />
                                <label class="label-stock bg-success p-1 m-1 rounded-3 text-white">In Stock</label>
                            </h4>
                            <hr>
                            <p class="product-path">
                                Home / Category /
                            </p>
                            <div>
                                {{-- <span class="selling-price">$399</span> --}}
                                <label for="">Price : </label>
                                <span class="original-price"> ${{ $category->price }}</span>
                            </div>

                            <div class="mt-3">
                                <h5 class="mb-0">Small Description</h5>
                                <p>
                                    {{ $category->smallDescription }}
                                </p>
                            </div>

                        </div>
                    @empty
                @endforelse

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="text-center">Description</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-center">
                            {{ $category->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
