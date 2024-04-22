<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $products     = $productModel->geProductList();

        return view('admin.product.list', compact('products'));
    }

    public function add()
    {
        $categories = Category::all();
        return view('admin.product.add', compact('categories'));
    }

    public function store(Request $request)
    {
        try {

            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'name_en'              => 'required|unique:products',
                'category_id'          => 'required',
                'code'                 => 'required',
                'short_description_en' => 'required',
                'long_description_en'  => 'required',
                'image'                => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price'                => 'required',
                'quantity'             => 'required',
                'status'               => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput($inputs);
            }

            DB::beginTransaction();

            // Image
            $image     = $request->file('image');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('upload'), $imageName);
            $imageUrl = 'upload/' . $imageName;

            $inputs['image'] = $imageUrl;

            Product::create($inputs);

            DB::commit();

            toastr()->success('Product created successfully!', 'Success', ['timeOut' => 5000]);
            return redirect()->route('product.list');
        } catch (\Exception $e) {
            // Get specific error
            // dd($e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create product.']);
        }
    }

    public function edit($id)
    {
        $product    = product::findOrFail($id);
        $categories = Category::latest()->where('status', 1)->get();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $productId)
    {
        try {

            $inputs = $request->all();
            $productId = $request->product_id;

            $validator = Validator::make($inputs, [
                'name_en'              => 'required|unique:products',
                'category_id'          => 'required',
                'code'                 => 'required',
                'short_description_en' => 'required',
                'long_description_en'  => 'required',
                'image'                => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price'                => 'required',
                'quantity'             => 'required',
                'status'               => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput($inputs);
            }

            DB::beginTransaction();

            // Image
            $image     = $request->file('image');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('upload'), $imageName);
            $imageUrl = 'upload/' . $imageName;

            $inputs['image'] = $imageUrl;

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

    public function show(Product $product)
    {
        return view('admin.product.view', ['product' => $product]);
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
