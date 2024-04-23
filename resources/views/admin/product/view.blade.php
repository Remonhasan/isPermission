@extends('layouts.admin.master')
@section('styles')
@endsection
@section('title', 'Add Product')
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Product</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Foxia</a></li>
                            <li class="breadcrumb-item"><a href="#">Product</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <a class="btn btn-primary" href="{{ route('product.list') }}">List</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">View Product</h4>
                            <p class="card-title-desc">Product Details
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Name (In English) : {{ $product->name_en }}</p>
                                    <p>Name (In Bangla) : {{ $product->name_bn }}</p>
                                    <p>Category Name : {{ $product->category_id }}</p>
                                    <p>code : {{ $product->code }}</p>
                                    <p>Short Description (In English): {{ $product->short_description_en }}</p>
                                    <p>Short Description (In Bangla) : {{ $product->short_description_bn }}</p>
                                    <p>Long Description (In English): {{ $product->long_description_en }}</p>
                                    <p>Long Description (In Bangla) : {{ $product->long_description_bn }}</p>
                                    <p>Price : {{ $product->price }}</p>
                                    <p>Discount : {{ $product->discount }}</p>
                                    <p>Quantity : {{ $product->quantity }}</p>
                                    <p>Status : {{ $product->status == 1 ? 'Active' : 'Inactive' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ asset($product->image) }}" alt="" height="100" width="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div> <!-- container-fluid -->
    </div>
@section('scripts')
@endsection
@endsection
