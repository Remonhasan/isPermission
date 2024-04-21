<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.list', compact('products'));
    }

    public function add()
    {
        return view('admin.product.add');
    }

    public function store(Request $request)
    {
        try {
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'name_en' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput($inputs);
            }

            // Store product data in cache
            Cache::forever('product_' . $inputs['name_en'], $inputs);

            DB::beginTransaction();

            try {
                product::create($inputs);

                DB::commit();

                toastr()->success('Product created successfully!', 'Success', ['timeOut' => 5000]);
                return redirect()->route('product.list');
            } catch (\Exception $e) {
                DB::rollback();
                // Remove cached product if database transaction fails
                Cache::forget('product_' . $inputs['name_en']);
                return back()->withInput()->withErrors(['error' => 'Failed to create product.']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to create product.']);
        }
    }

    public function edit($id)
    {
        $product = product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $productId)
    {
        try {
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'name_en'     => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput($inputs);
            }

            DB::beginTransaction();

            $productInfo = product::findOrFail($productId);
            $productInfo->update($inputs);

            DB::commit();

            toastr()->success('Product updated successfully!', 'Success', ['timeOut' => 5000]);
            return redirect()->route('product.list');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Failed to update product.']);
        }
    }

    public function destroy($productId)
    {
        $product = product::where('id', $productId)->first();
        if (!empty($product)) {
            $product->delete();

            toastr()->success('Product deleted successfully!', 'Success', ['timeOut' => 5000]);
            return redirect()->back();
        } else {
            return back()->withErrors(['error' => 'Failed to delete product.']);
        }
    }

}
