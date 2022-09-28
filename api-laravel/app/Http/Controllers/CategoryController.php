<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //

    public function getAllCategories(): \Illuminate\Http\JsonResponse
    {

        try {

            $categories = CategoryModel::all();

            if($categories->count() <= 0){
                return response()->json([
                    'err' => false,
                    'msg' => 'Categories are empty'
                ], 200);
            }

            return response()->json([
                'err' => false,
                'msg' => 'Categories successfully fetched',
                'resp' => $categories
            ]);

        }catch(Exception $e){

            return response()->json([
                'err' => true,
                'msg' => $e
            ], 400); // \Illuminate\Http\Response::HTTP_BAD_REQUEST you can use the Response status codes

        }
    }

    public function getCategoryById(Request $request): \Illuminate\Http\JsonResponse
    {

        try{

            $categoryId = $request->route()->parameter('category_id');

            $category = CategoryModel::all()->where('category_id', $categoryId);

            if($category->count() <= 0){

                return response()->json([
                    'error' => true,
                    'message' => 'No category found'
                ], 404);

            }

            return response()->json([
                'error' => false,
                'message' => 'Category fetched',
                'resp' => $category->first()
            ]);

        }catch (Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e
            ], 400);
        }

    }

    public function createCategory(Request $request): \Illuminate\Http\JsonResponse
    {

        // no validations okay, but for real system your back and front should have validations



        $nCategory = CategoryModel::create($request->all());

        if(!$nCategory){
            return response()->json([
                'error' => true,
                'message' => 'Error creating category'
            ], 400);

        }

        return response()->json([
            'error' => false,
            'message' => 'Category created successfully',
            'resp' => $nCategory
        ]);

    }

    public function updateCategory(Request $request){

        $updatedCategory = CategoryModel::where('category_id', $request['category_id']);

        if($updatedCategory->count() <= 0){

            return response()->json([
                'error' => true,
                'message' => 'Category not found'
            ], 404);

        }

        if(!$updatedCategory->update($request->all())){

            return response()->json([
                'error' => true,
                'message' => 'Error updating your category'
            ], 400);
        }

        return response()->json([
            'error' => false,
            'message' => 'Category updated successfully',
            'resp' => $updatedCategory->get()->first()
        ]);


    }

    public function deleteCategory(Request $request){

        $categoryId = $request->route()->parameter('category_id');

        $category = CategoryModel::find($categoryId)->delete();

        return response()->json([
            'error' => false,
            'message' => 'Deleted',
            'deleted' => $category
        ]);

    }

//    private function create($categoryData): bool
//    {
//
//        $nCategory = new CategoryModel;
//
//        $nCategory->fill($categoryData);
//
//        return $nCategory->save();
//
//    }
}
