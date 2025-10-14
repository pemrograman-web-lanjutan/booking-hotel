<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_option extends Model
{
    /** @use HasFactory<\Database\Factories\RoomOptionFactory> */
    use HasFactory;

    public $guarded = ['id', 'created_at', 'updated_at'];

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
