@extends('layouts.admin.master')
@section('styles')
@endsection
@section('title', 'Add Permission')
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Permissions</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Foxia</a></li>
                            <li class="breadcrumb-item"><a href="#">Permission</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
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

                <div class="container">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add new permission</h4>
                            <form class="row g-3 needs-validation" novalidate action="{{ route('permission.update') }}"
                                method="POST">
                                @csrf
                                <div class="col-md-6 position-relative">
                                    <label for="validationTooltip04" class="form-label">User</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-select" id="userDropdown" name="user_id" required>
                                        <option value="">Select</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-tooltip">
                                        Please select user.
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-4">
                                        <div class="form-group">
                                            <label for="category_permissions mb-1">Category Permissions:</label>
                                            <hr>
                                            <div>
                                                <input type="checkbox" id="create_category" name="create_category">
                                                <label for="create_product">Create</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="edit_category" name="edit_category">
                                                <label for="edit_product">Edit</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="view_category" name="view_category">
                                                <label for="view_category">View</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="list_category" name="list_category">
                                                <label for="list_product">List</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="delete_category" name="delete_category">
                                                <label for="delete_category">Delete</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <div class="form-group">
                                            <label for="product_permissions mb-1">Product Permissions:</label>
                                            <hr>
                                            <div>
                                                <input type="checkbox" id="create_product" name="create_product">
                                                <label for="create_product">Create</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="edit_product" name="edit_product">
                                                <label for="edit_product">Edit</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="view_product" name="view_product">
                                                <label for="view_product">View</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="list_product" name="list_product">
                                                <label for="list_product">List</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="delete_product" name="delete_product">
                                                <label for="delete_product">Delete</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_permissions mb-1">Coupon Permissions:</label>
                                            <hr>
                                            <div>
                                                <input type="checkbox" id="create_coupon" name="create_coupon">
                                                <label for="create_coupon">Create</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="edit_coupon" name="edit_coupon">
                                                <label for="edit_coupon">Edit</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="view_pcoupon" name="view_coupon">
                                                <label for="view_coupon">View</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="list_coupon" name="list_coupon">
                                                <label for="list_coupon">List</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="delete_coupon" name="delete_coupon">
                                                <label for="delete_coupon">Delete</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Permissions</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div> <!-- container-fluid -->
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            // Check if there's a saved user ID in localStorage
            var savedUserId = localStorage.getItem('selectedUserId');
            if (savedUserId) {
                // Set the dropdown to the saved user ID
                $('#userDropdown').val(savedUserId);

                // Trigger change event to load the permissions for the selected user
                loadPermissions(savedUserId);
            }

            // When a user is selected, save the user ID and load the permissions
            $('#userDropdown').change(function() {
                var selectedUserId = $(this).val();

                if (selectedUserId) {
                    // Save the selected user ID in localStorage
                    localStorage.setItem('selectedUserId', selectedUserId);

                    // Load the permissions for the selected user
                    loadPermissions(selectedUserId);
                }
            });

            // Function to load permissions for a selected user
            function loadPermissions(userId) {
                $.ajax({
                    type: 'GET',
                    url: '/admin/permission/get-user-permissions/' + userId,
                    success: function(data) {
                        // Uncheck all checkboxes first
                        $("input[type='checkbox']").prop('checked', false);

                        // Loop through permissions and set checkboxes based on the scope
                        data.permissions.forEach(function(permission) {
                            if (permission.scope === "category") {
                                if (permission.create) $('#create_category').prop('checked',
                                    true);
                                if (permission.edit) $('#edit_category').prop('checked', true);
                                if (permission.view) $('#view_category').prop('checked', true);
                                if (permission.list) $('#list_category').prop('checked', true);
                                if (permission.delete) $('#delete_category').prop('checked',
                                    true);
                            } else if (permission.scope === "product") {
                                if (permission.create) $('#create_product').prop('checked',
                                    true);
                                if (permission.edit) $('#edit_product').prop('checked', true);
                                if (permission.view) $('#view_product').prop('checked', true);
                                if (permission.list) $('#list_product').prop('checked', true);
                                if (permission.delete) $('#delete_product').prop('checked',
                                    true);
                            } else if (permission.scope === "coupon") {
                                if (permission.create) $('#create_coupon').prop('checked',
                                true);
                                if (permission.edit) $('#edit_coupon').prop('checked', true);
                                if (permission.view) $('#view_coupon').prop('checked', true);
                                if (permission.list) $('#list_coupon').prop('checked', true);
                                if (permission.delete) $('#delete_coupon').prop('checked',
                                true);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching permissions:', error);
                    }
                });
            }
        });
    </script>
@endpush
