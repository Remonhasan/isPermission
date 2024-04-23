@extends('layouts.admin.master')
@section('styles')
@endsection
@section('title', 'Edit Coupon')
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Coupons</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Foxia</a></li>
                        <li class="breadcrumb-item"><a href="#">Coupon</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a class="btn btn-primary" href="{{ route('coupon.list') }}">List</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
           
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">Edit Coupon</h4>
                        <p class="card-title-desc">The required fields are mentioned by 
                            <span class="text-danger">*</span> 

                        </p>
                        <form class="row g-3 needs-validation" novalidate  action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                            @csrf
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Code</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="validationTooltip01" name="code" value="{{ $coupon->code }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter code in english.
                                </div>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Discount Amount</label>
                                <span class="text-danger">*</span>
                                <input step="0.01" type="number" id="typeNumber" class="form-control" value="{{ $coupon->discount_amount }}" name="discount_amount" required/>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter discount amount.
                                </div>
                            </div>

                            <div class="col-md-12 position-relative">
                                <label for="validationTooltip02" class="form-label">Description</label>
                                <textarea class="form-control" id="validationTooltip02" name="description" rows="3">{{ $coupon->description }}</textarea>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="example-date-input" class="col-sm-2 col-form-label">Start Date</label>
                                <span class="text-danger">*</span>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date"  name="start_date" placeholder="Select" id="validationTooltip02" value="{{ $coupon->start_date }}">
                                </div>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="example-date-input" class="col-sm-2 col-form-label">End Date</label>
                                <span class="text-danger">*</span>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date"  name="end_date" placeholder="Select" id="validationTooltip02" value="{{ $coupon->end_date }}" >
                                </div>
                            </div>
                            
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip04" class="form-label">Status</label>
                                <span class="text-danger">*</span>
                                <select class="form-select" id="validationTooltip04" name="status" required>
                                    <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive</option>
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