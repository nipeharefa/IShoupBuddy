<?php

namespace App\Models;

use App\Helpers\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use UserTrait;

    protected $fillable = ['rating', 'body', 'product_vendor_id'];

    public function ProductVendor()
    {
        return $this->belongsTo(ProductVendor::class);
    }

    public function Product()
    {
        return $this->ProductVendor->Product();
    }

    public function Vendor()
    {
        return $this->ProductVendor->Vendor();
    }

    public function getSummary()
    {
        return 1;
    }
}
