<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;

    public $guarded = ['id', 'created_at', 'updated_at'];

    public function review(){

        return $this->hasOne(Review::class);

    }
}
