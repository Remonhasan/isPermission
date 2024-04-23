@extends('layouts.admin.master')
@section('styles')
@endsection
@section('title', 'Coupons')
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
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <a class="btn btn-primary" href="{{ route('coupon.add') }}">Add</a>
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
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Date From</th>
                                        <th class="text-center">Date To</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($coupons as $key => $coupon)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $coupon->code }}</td>
                                            <td class="text-center">{{ $coupon->discount_amount }}</td>
                                            <td class="text-center">{{ $coupon->start_date }}</td>
                                            <td class="text-center">{{ $coupon->end_date }}</td>
                                            <td class="text-center">
                                                @if ($coupon->status === 1)
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
                                                            <a class="dropdown-item" href="{{ route('coupon.edit', $coupon->id)}}"><i class="fas fa-edit"></i> Edit</a>
                                                            <a class="dropdown-item" href="{{ route('coupon.delete', $coupon->id)}}"><i class="fas fa-trash"></i> Delete</a>
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
