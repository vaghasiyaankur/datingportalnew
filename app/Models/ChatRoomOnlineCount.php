<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoomOnlineCount extends Model
{  
    protected $table = 'chat_room_online_counts';

    protected $fillable = [
        'chatRoomDetail_id','online'
    ];

}
