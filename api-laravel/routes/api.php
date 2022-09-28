<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/test', function(){
    return response()->json([
        "err" => false,
        "message" => "It worked"
    ]);
});

//env('APP_ENV', "local") === "local"
//    ? env('APP_LOCAL_URL_PREFIX')
//    : env('APP_PROD_URL_PREFIX')

Route::prefix(
    "local")
    ->group(function(){

    // group you  auth routes into auth prefix
    Route::prefix('/auth')->group(function (){
        Route::post('/login', 'AuthController@login');
        Route::post('/register', 'AuthController@register');
    });

    Route::middleware('auth:sanctum')->group(function (){

        /**
         * @url /categories/
         * @params category_id
         * @methods get, post & put
         * @desc get all categories, add category, & update category
         */
        Route::prefix('/categories')->group(function() {

            Route::get('/', 'CategoryController@getAllCategories'); # get all categories

            Route::get('/{category_id}', 'CategoryController@getCategoryById'); # get category by id

            Route::post('/', 'CategoryController@createCategory'); # add category

            Route::put('/{category_id}', 'CategoryController@updateCategory'); # update category

            Route::get('/products/{category_id}', 'ProductController@getAllProducts'); # get all categories

            Route::delete('/{category_id}', 'CategoryController@deleteCategory');

        });


        /**
         * @url /product
         * @params product_id
         * @methods get, post & put
         * @desc get all products, add product, & update product
         */
        Route::prefix('/products/')->group(function() {

            Route::get('/{product_id}', 'ProductController@getProductById');

            Route::post('/', 'ProductController@addProduct'); # add new category

            Route::put('/{product_id}', 'ProductController@updateProduct'); # update category

            Route::delete('/{product_id}', 'ProductController@deleteProduct');

        });

        /**
         * @url /products/variants
         * @params variant_id
         * @methods get, post & put
         * @desc get all variant, add variant, & update variant
         */
        Route::prefix('/variants')->group(function() {

            Route::get('/{product_id}/all', 'VariantController@getProductVariants'); # get all product variant

            Route::post('/', 'VariantController@addVariant'); # add new variant

            Route::get('/{variant_id}', 'VariantController@getVarintById'); # get variant

            Route::put('/', 'VariantController@updateVariant');

            Route::delete('/{variant_id}', 'VariantController@deleteVariant');

        });

        Route::get('/logout', 'AuthController@logout');


    }); // end of auth:sanctum route middleware

//    Route::group([
//        'prefix' => 'products'
//    ], function () {});



});
