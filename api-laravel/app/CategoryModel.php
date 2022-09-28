<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    //
    protected $primaryKey = 'category_id';

    public $timestamps = true;

    protected $table = 'categories';

    protected $fillable = ['category_name', 'category_meta_title', 'category_meta_desc', 'category_meta_keywords'];

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            ProductModel::class,
            'product_categories',
            'category_id',
            'product_id')
            ->using(ProductCategoryModel::class);
    }

}
