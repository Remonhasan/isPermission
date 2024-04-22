@extends('layouts.admin.master')
@section('styles')
@endsection
@section('title', 'Edit Product')
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
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a class="btn btn-primary" href="{{ route('product.list') }}">List</a>
                    </div>
                </div>
            </div>
        </div>

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
           
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">Edit Product</h4>
                        <p class="card-title-desc">The required fields are mentioned by 
                            <span class="text-danger">*</span> 

                        </p>
                        <form class="row g-3 needs-validation" novalidate  action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value={{ $product->id }} name="product_id">

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Name (In English)</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="validationTooltip01" name="name_en" value="{{ $product->name_en }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter name in english.
                                </div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip02" class="form-label">Name (In Bangla)</label>
                                <input type="text" class="form-control" id="validationTooltip02" name="name_bn" value="{{ $product->name_bn }}">
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip04" class="form-label">Category</label>
                                <span class="text-danger">*</span>
                                <select class="form-select" id="validationTooltip04" name="category_id" required>
                                       <option value="">Select</option>
                                        @foreach($categories as $category)
                                        <option 
                                            value="{{ $category->id }}"
                                            {{ $product->category_id === $category->id ? 'selected' : '' }}>
                                            {{ $category->name_en }}
                                        </option>
                                    @endforeach
                                    
                                </select>
                                <div class="invalid-tooltip">
                                    Please select category.
                                </div>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Code</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="validationTooltip01" name="code" value="{{ $product->code }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter product code.
                                </div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Short Description (In English)</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="validationTooltip01" name="short_description_en" value="{{ $product->short_description_en }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter short description in english.
                                </div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip02" class="form-label">Short Description (In Bangla)</label>
                                <input type="text" class="form-control" id="validationTooltip02" name="short_description_bn" value="{{ $product->short_description_en }}">
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Long Description (In English)</label>
                                <span class="text-danger">*</span>
                                <textarea class="form-control" id="validationTooltip01" name="long_description_en" rows="3" required>{{ $product->long_description_en }}</textarea>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter long description in english.
                                </div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip02" class="form-label">Long Description (In Bangla)</label>
                                <textarea class="form-control" id="validationTooltip02" name="long_description_bn" rows="3">{{ $product->long_description_bn }}</textarea>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Price</label>
                                <span class="text-danger">*</span>
                                <input step="0.01" type="number" id="typeNumber" class="form-control"  name="price" value="{{ $product->price }}" required/>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter price.
                                </div>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Discount</label>
                                <input step="0.01" type="number" id="typeNumber" class="form-control"  name="discount" value="{{ $product->discount }}"/>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Quantity</label>
                                <span class="text-danger">*</span>
                                <input type="number" id="typeNumber" class="form-control"  name="quantity" required value="{{ $product->quantity }}"/>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter quantity.
                                </div>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="formFile" class="form-label">Image</label>
                                <span class="text-danger">*</span>
                                <input type="file" class="form-control" name="image" id="image" value={{ $product->image }}
                                        placeholder="upload..." />
                                <img src="{{ asset($product->image) }}" alt="" height="60" width="60">
                            </div>
                            
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip04" class="form-label">Status</label>
                                <span class="text-danger">*</span>
                                <select class="form-select" id="validationTooltip04" name="status" required>
                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Please select status.
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

       
    </div> <!-- container-fluid -->
</div>
@section('scripts')
@endsection
@endsection