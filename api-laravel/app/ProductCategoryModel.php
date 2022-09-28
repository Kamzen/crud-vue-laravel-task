<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductCategoryModel extends Pivot
{
    //

    protected $table = 'product_categories';
    protected $foreignKey = ['product_id', 'category_id'];
}
