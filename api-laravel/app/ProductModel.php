<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    //

    protected $primaryKey = 'product_id';

    public $timestamps = true;

    protected $table = 'products';

    protected $fillable = ['product_name','slug'];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CategoryModel::class)
            ->using(ProductCategoryModel::class)
            ->withTimestamps()
            ->withPivot('product_id');
    }

    public function variants(){
        return $this->hasMany(ProductVariantModel::class, 'product_id');
    }
}
