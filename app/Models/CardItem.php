<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardItem extends Model
{
    protected $fillable = [
        'card_id',
        'group_id',
    ];
}
