<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostJob extends Model{
    protected $fillable = [
        'post_id',
        'chat_id',
        'chat_type',
        'day',
        'time',
        'status',
    ];
}