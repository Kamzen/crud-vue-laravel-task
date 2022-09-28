<?php

namespace App\Http\Controllers;

use App\ProductModel;
use App\ProductVariantModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariantController extends Controller
{
    //        not adding validations
    public function getProductVariants(Request $request){

        $product_id = $request->route()->parameter('product_id');

        $productVariants = ProductModel::find($product_id)->variants;

        return response()->json([
            'variants' => $productVariants
        ]);

    }

    public function getVarintById(Request $request){

        $variant_id = $request->route()->parameter('variant_id');

        $variant = ProductVariantModel::find($variant_id);

        if (!$variant){
            return response()->json([
                'variantNotFound' => true
            ]);
        }

        return response()->json([
            'variant' => $variant
        ]);

    }

    public function addVariant(Request $request){

//        check if variant code is already there
        if(ProductVariantModel::where(['sap_product_code' => $request->input('sap_product_code')])
            ->orWhere(['web_product_code' => $request->input('web_product_code')])
            ->count()){
            return response()->json(['exist' => 'Variant belongs to a product please add a different']);
        }

        $nVariant = ProductVariantModel::create($request->all());

        return response()->json([
            'error' => false,
            'message' => 'Variant created successfully',
            'resp' => $nVariant
        ]);
    }

    public function updateVariant(Request $request){

        if(ProductVariantModel::where('variant_id', $request->input('variant_id'))
                ->get()
                ->count() <= 0){
            return response()->json(['variantNotFound' => true]);
        }

        ProductVariantModel::find($request->input('variant_id'))
            ->fill($request->all())
            ->save();

        return response()->json([
            'error' => false,
            'message' => 'Variant updated successfully',
        ]);

    }

    public function deleteVariant(Request $request){

        $variant_id = $request->route()->parameter('variant_id');

        $deleted = ProductModel::find($variant_id)->delete();

        return response()->json([
            'error' => false,
            'message' => 'Deleted',
            'deleted' => $deleted
        ]);

    }
}
