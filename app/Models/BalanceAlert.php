<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'threshold_amount',
        'is_alerted',
    ];
}