<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Traits\UserTrait;

class Review extends Model
{
    use UserTrait;

    protected $fillable = ['rating', 'body', 'product_vendor_id'];

    public function ProductVendor()
    {
        return $this->belongsTo(ProductVendor::class);
    }

    public function Product() {

        return $this->ProductVendor->Product();
    }

    public function Vendor() {

        return $this->ProductVendor->Vendor();
    }
}
