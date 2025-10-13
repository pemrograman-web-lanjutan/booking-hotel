<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    public $guarded = ['id', 'created_at', 'updated_at'];

    public function media_rooms(){

        return $this->hasMany(MediaRoom::class);

    }
}
