<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model{
    protected $fillable = [
        'tg_id',
        'url_group',
        'group_type',
        'name_group',
        'members_count',
    ];
}
