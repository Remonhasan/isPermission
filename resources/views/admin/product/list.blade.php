@extends('layouts.admin.master')
@section('styles')
@endsection
@section('title', 'Products')
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Products</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Foxia</a></li>
                            <li class="breadcrumb-item"><a href="#">Product</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <a class="btn btn-primary" href="{{ route('product.add') }}">Add</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">SL</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Name (English)</th>
                                        <th class="text-center">Name (Bangla)</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name_en }}" height="60"
                                                    width="60">
                                            </td>
                                            <td class="text-center">{{ $product->name_en }}</td>
                                            <td class="text-center">{{ $product->name_bn }}</td>
                                            <td class="text-center">{{ $product->category_name_en }}</td>
                                            <td class="text-center">
                                                @if ($product->status === 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="col-sm-6">
                                                    <div class="dropdown mt-3 mt-sm-0">
                                                        <a class="btn btn-blue-grey dropdown-toggle" href="#"
                                                            id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </a>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            @if ($permissions['view'])
                                                            <a class="dropdown-item" href="{{ route('product.show', $product->id)}}"><i class="fas fa-eye"></i> View</a>
                                                            @endif
                                                            @if ($permissions['edit'])
                                                            <a class="dropdown-item" href="{{ route('product.edit', $product->id)}}"><i class="fas fa-edit"></i> Edit</a>
                                                            @endif
                                                            @if ($permissions['delete'])
                                                            <a class="dropdown-item" href="{{ route('product.delete', $product->id)}}"><i class="fas fa-trash"></i> Delete</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@section('scripts')
@endsection
@endsection
