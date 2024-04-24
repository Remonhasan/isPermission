<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $userInfo = User::userInfoById($userId);

        return view('admin.profile.profile', compact('userInfo'));
    }

    public function update(Request $request)
    {
        try {

            $inputs = $request->all();
            $profileId = $request->profile_id;

            $validator = Validator::make($inputs, [
                'name'     => 'required|string',
                'email'    => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput($inputs);
            }

            DB::beginTransaction();

            $inputs['password'] = Hash::make($request->password);

            $coupon = User::findOrFail($profileId);
            $coupon->update($inputs);

            DB::commit();

            return redirect()->route('profile.list')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Failed to update profile.']);
        }
    }
}
