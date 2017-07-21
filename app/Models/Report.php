<?php

namespace App\Models;

use App\Helpers\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use UserTrait;

    protected $fillable = ['user_id', 'review_id'];

    public function Review()
    {
        return $this->belongsTo(Review::class);
    }
}
