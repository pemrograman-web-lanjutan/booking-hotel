<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media_room extends Model
{
    /** @use HasFactory<\Database\Factories\MediaRoomFactory> */
    use HasFactory;

    public $guarded = ['id', 'created_at', 'updated_at'];

}
