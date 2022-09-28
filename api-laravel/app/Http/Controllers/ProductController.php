<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\ProductCategoryModel;
use App\ProductModel;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //

    public function getAllProducts(Request $request)
    {

        $category_id = $request->route()->parameter('category_id');

        try {
            $products = CategoryModel::with(['products:product_id,product_name'])
                ->where('category_id', $category_id); // not really necessary for selecting column names but if your json response is too big

            if ($products->count() <= 0) {
                return response()->json([
                    'error' => false,
                    'message' => 'No products associated with the category found',
                    'notFound' => 'Category product is empty'
                ]);
            }

            return response()->json([
                'error' => false,
                'message' => 'Products fetched successfully',
                'products' => $products->get('category_id')->all()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Network for now' // for now
            ], 400);
        }


//        return ProductModel::find(1)->variants;

    }

    public function getProductById(Request $request)
    {
        try {

            $product_id = $request->route()->parameter('product_id');
            $product = ProductModel::all()->where('product_id', $product_id);

            if ($product->count() <= 0) {

                return response()->json([
                    'error' => true,
                    'message' => 'No product found'
                ], 404);

            }

            return response()->json([
                'error' => false,
                'message' => 'Product fetched',
                'product' => $product->first()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ], 400);
        }
    }

    public function addProduct(Request $request)
    {

        $product = ProductModel::create($request->only('slug', 'product_name'));

        $ids = $request->get('ids');

        if($request->filled('ids')){

            foreach ($ids as $id) {
//          only add if relationship is not there thank you

                DB::table('product_categories')->insert([
                    'product_id' => $product->product_id,
                    'category_id' => $id
                ]);

            }

        }

            return response()->json([
                'error' => false,
                'message' => 'Category created successfully',
                'resp' => $product
            ]);

    }

    public function updateProduct(Request $request)
    {

        $updateProduct = ProductModel::where('product_id', $request['product_id'])
            ->update($request->only('product_name', 'slug'));


        $ids = $request->get('ids');

       if($request->filled('ids')){
           foreach ($ids as $id) {
//            only add if relationship is not there thank you
               if (ProductCategoryModel::where([
                       'product_id' => $request->input('product_id'),
                       'category_id' => $id
                   ])->count() <= 0) {

                   DB::table('product_categories')->insert([
                       'product_id' => $request->input('product_id'),
                       'category_id' => $id
                   ]);
               }

//            $updateProduct->attach([
//                'product_id' => $updateProduct->product_id,
//                'category_id' => $id
//            ]);

           }
       }

        return response()->json([
            'error' => false,
            'message' => 'Product updated successfully',
            'resp' => $updateProduct
        ]);

    }

    public function deleteProduct(Request $request){

        $product_id = $request->route()->parameter('product_id');

        $deleted = ProductModel::find($product_id)->delete();

        return response()->json([
            'error' => false,
            'message' => 'Deleted',
            'deleted' => $deleted
        ]);

    }

}
