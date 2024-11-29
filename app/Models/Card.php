<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'post_id',
        'card_name',
        'card_type',
        'start_date',
        'end_date',
        'time',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'count_group',
        'status',
    ];
}