@extends('layouts.admin.master')
@section('styles')
@endsection
@section('title', 'Edit Category')
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Categories</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Foxia</a></li>
                        <li class="breadcrumb-item"><a href="#">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a class="btn btn-primary" href="{{ route('category.list') }}">List</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
           
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">Edit Category</h4>
                        <p class="card-title-desc">The required fields are mentioned by 
                            <span class="text-danger">*</span> 

                        </p>
                        <form class="row g-3 needs-validation" novalidate  action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Name (In English)</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="validationTooltip01" name="name_en" value="{{ $category->name_en }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter name in english.
                                </div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip02" class="form-label">Name (In Bangla)</label>
                                <input type="text" class="form-control" id="validationTooltip02" name="name_bn" value="{{ $category->name_bn }}">
                            </div>
                            
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip04" class="form-label">Status</label>
                                <span class="text-danger">*</span>
                                <select class="form-select" id="validationTooltip04" name="status" required>
                                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
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