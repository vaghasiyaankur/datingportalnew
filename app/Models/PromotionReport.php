<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserPromotation;

class PromotionReport extends Model
{
    protected $fillable = ['user_id', 'user_promotion_id', 'description', 'notify'];

    /**
     * Relationship with `users` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }

    /**
     * Relationship with `statuses` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userPromotion()
    {
        return $this->belongsTo(UserPromotation::class,'user_promotion_id');
    }
}
