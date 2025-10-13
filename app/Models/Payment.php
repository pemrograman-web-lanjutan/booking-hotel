<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    public $guarded = ['id', 'created_at', 'updated_at'];

    public function booking(){

        return $this->belongsTo(Booking::class);

    }
}
