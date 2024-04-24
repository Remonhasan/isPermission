@extends('layouts.admin.master')
@section('styles')
@endsection
@section('title', 'Profile')
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Profile</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Foxia</a></li>
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                    </ol>
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
        
                        <h4 class="card-title">Update Profile</h4>

                        <form class="row g-3 needs-validation" novalidate  action="{{ route('profile.update') }}" method="POST">
                            @csrf

                            <input type="hidden" value={{ $userInfo->id }} name="profile_id">

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="validationTooltip01" name="name" value="{{ $userInfo->name }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter name.
                                </div>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Email</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="validationTooltip01" name="email" value="{{ $userInfo->email }}" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter email.
                                </div>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Password</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="validationTooltip01" name="password" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please enter password.
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