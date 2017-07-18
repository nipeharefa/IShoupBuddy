<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Traits\UserTrait;

class Report extends Model
{
    use UserTrait;

    protected $fillable = ['user_id', 'review_id'];

    public function Review()
    {
        return $this->belongsTo(Review::class);
    }
}
