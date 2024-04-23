<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.permission.permission', compact('users'));
    }

    public function update(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'user_id'         => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            // Retrieve the user
            $user = User::findOrFail($request->user_id);

            // Update permissions for the user
            $permissions = [
                'category' => [
                    'create' => $request->has('create_category'),
                    'edit' => $request->has('edit_category'),
                    'view' => $request->has('view_category'),
                    'list' => $request->has('list_category'),
                    'delete' => $request->has('delete_category'),
                ],
                'product' => [
                    'create' => $request->has('create_product'),
                    'edit' => $request->has('edit_product'),
                    'view' => $request->has('view_product'),
                    'list' => $request->has('list_product'),
                    'delete' => $request->has('delete_product'),
                ],
                'coupon' => [
                    'create' => $request->has('create_coupon'),
                    'edit' => $request->has('edit_coupon'),
                    'view' => $request->has('view_coupon'),
                    'list' => $request->has('list_coupon'),
                    'delete' => $request->has('delete_coupon'),
                ],
            ];

            foreach ($permissions as $scope => $actions) {
                Permission::updateOrCreate(
                    ['user_id' => $user->id, 'scope' => $scope],
                    $actions
                );
            }

            DB::commit();

            return redirect()->back()->with('success', 'Permissions updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to update permissions.']);
        }
    }
}
