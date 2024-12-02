<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $products     = $productModel->geProductList();
        $userId      = Auth::id();
        $permissions = Permission::getPermission($userId,'product')->first();

        return view('admin.product.list', compact('products','permissions'));
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

            return redirect()->route('product.list')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            // Get specific error
            // dd($e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create product.']);
        }
    }

    public function edit($id)
    {
        $product    = product::findOrFail($id);
        $categories = Category::getLatest();

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

            return redirect()->route('product.list')->with('success', 'Product updated successfully!');
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
        $product = Product::getProduct($productId);

        if (!empty($product)) {
            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully!');
        } else {
            return back()->withErrors(['error' => 'Failed to delete product.']);
        }
    }

    public function getProductByCategory(Request $request)
    {
        // Retrieve the category ID from the request
        $categoryId = $request->input('categoryId');

        // Query products based on the category ID
        if ($categoryId === 'all') {
            $products = Product::all(); // Fetch all products
           
        } else {
            $products = Product::where('category_id', $categoryId)->get(); // Fetch products by category ID
        }

        // Return the products as JSON response
        return response()->json(['products' => $products]);
    }
}
