<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.list', compact('categories'));
    }

    public function add()
    {
        return view('admin.category.add');
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

            // Store category data in cache
            Cache::forever('category_' . $inputs['name_en'], $inputs);

            DB::beginTransaction();

            try {
                Category::create($inputs);

                DB::commit();

                toastr()->success('Category created successfully!', 'Success', ['timeOut' => 5000]);
                return redirect()->route('category.list');
            } catch (\Exception $e) {
                DB::rollback();
                // Remove cached category if database transaction fails
                Cache::forget('category_' . $inputs['name_en']);
                return back()->withInput()->withErrors(['error' => 'Failed to create category.']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to create category.']);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $categoryId)
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

            $categoryInfo = Category::findOrFail($categoryId);
            $categoryInfo->update($inputs);

            DB::commit();

            toastr()->success('Category updated successfully!', 'Success', ['timeOut' => 5000]);
            return redirect()->route('category.list');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Failed to update category.']);
        }
    }

    public function destroy($categoryId)
    {
        $category = Category::where('id', $categoryId)->first();
        if (!empty($category)) {
            $category->delete();

            toastr()->success('Category deleted successfully!', 'Success', ['timeOut' => 5000]);
            return redirect()->back();
        } else {
            return back()->withErrors(['error' => 'Failed to delete category.']);
        }
    }

    public function showCachedCategory($name)
    {
        if (Cache::has('category_' . $name)) {
            // Retrieve the category data from the cache
            $cachedCategory = Cache::get('category_' . $name);

            // Output the cached category data
            return response()->json($cachedCategory);
        } else {
            return response()->json(['error' => 'Category data not found in cache.'], 404);
        }
    }
}
