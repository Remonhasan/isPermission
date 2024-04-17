<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
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
        DB::beginTransaction();

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

            Category::create($inputs);

            DB::commit();

            toastr()->success('Category created successfully!', 'Success', ['timeOut' => 5000]);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Failed to create category.']);
        }
    }

    /**
     * Show all categories
     * Route Model Binding
     * @param  mixed $category
     * @return void
     */
    public function show(Category $category)
    {
        return view('admin.category.view', ['category' => $category]);
    }

}
