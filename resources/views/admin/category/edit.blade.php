@extends('layouts.admin')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3> Edit Category
                        <a href="{{ route('admin.category') }}" class="btn btn-sm btn-primary float-end text-white">Go To
                            Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/category/' . $category_id->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control "
                                    value="{{ old('name', $category_id->name) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price">Price</label>
                                <input type="text" name="price" value="{{ old('price', $category_id->price) }}"
                                    class="form-control ">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control ">{{ old('description', $category_id->description) }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="smallDescription">Small Description</label>
                                <textarea name="smallDescription" class="form-control ">{{ old('smallDescription', $category_id->smallDescription) }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control " accept="image/*">
                                <img src="{{ asset('/uploads/category/' . $category_id->image) }}" alt=""
                                    width="50px" height="50px">
                            </div>



                            <div class="col-md-12 mb-3">
                                <button class="btn btn-primary float-end text-white">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
