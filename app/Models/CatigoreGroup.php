<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatigoreGroup extends Model
{
    protected $fillable = [
        'catigory_id',
        'group_id',
    ];
}
/*
            $table->integer('catigory_id');
            $table->integer('group_id');
*/