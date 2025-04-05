<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'success' => true,
                'message' => 'Categories retrieved successfully',
                'data' => $categories
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
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

            Category::create($inputs);

            return response()->json([
                'success' => true,
                'message' => 'Categories created successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $categoryId)
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

            
            $categoryInfo = Category::findOrFail($categoryId);
            $categoryInfo->update($inputs);

            return response()->json([
                'success' => true,
                'message' => 'Categories updated successfully',
                'data' => $categoryInfo
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($categoryId)
    {
        try {
            
            $category = Category::getCategory($categoryId);
            
            if(!empty($category)){
                $category->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Categories deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
}
