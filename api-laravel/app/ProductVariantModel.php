<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariantModel extends Model
{
    //

    protected $table = 'product_variants';

    protected $primaryKey = 'variant_id';

    public $timestamps = true;

    protected $fillable =['sap_product_code', 'web_product_code', 'variant_name', 'product_id'];

    public function product()
    {
        $this->belongsTo(ProductModel::class);
    }
}
