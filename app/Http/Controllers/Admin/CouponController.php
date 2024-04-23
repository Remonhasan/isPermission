<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.list', compact('coupons'));
    }

    public function add()
    {
        return view('admin.coupon.add');
    }

    public function store(Request $request)
    {
        try {
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'code' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput($inputs);
            }

            DB::beginTransaction();


            Coupon::create($inputs);

            DB::commit();

            toastr()->success('Coupon created successfully!', 'Success', ['timeOut' => 5000]);
            return redirect()->route('coupon.list');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to create coupon.']);
        }
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $couponId)
    {
        try {
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'code'     => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput($inputs);
            }

            DB::beginTransaction();

            $coupon = Coupon::findOrFail($couponId);
            $coupon->update($inputs);

            DB::commit();

            toastr()->success('Coupon updated successfully!', 'Success', ['timeOut' => 5000]);
            return redirect()->route('coupon.list');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Failed to update coupon.']);
        }
    }

    public function destroy($categoryId)
    {
        $coupon = Coupon::where('id', $categoryId)->first();
        if (!empty($coupon)) {
            $coupon->delete();

            toastr()->success('Coupon deleted successfully!', 'Success', ['timeOut' => 5000]);
            return redirect()->back();
        } else {
            return back()->withErrors(['error' => 'Failed to delete coupon.']);
        }
    }
}
