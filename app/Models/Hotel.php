<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    /** @use HasFactory<\Database\Factories\HotelFactory> */
    use HasFactory;

    public $guarded = ['id', 'created_at', 'updated_at'];

    public function rooms(){

        return $this->hasMany(Room::class);

    }
}
