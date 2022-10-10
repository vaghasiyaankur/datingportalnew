<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['from_user_id', 'to_user_id','portal_id', 'rating_value', 'rating_status'];
}
