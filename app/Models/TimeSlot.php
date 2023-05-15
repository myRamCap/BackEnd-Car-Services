<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TimeSlot extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'service_center_id',
        'time',
        'max_limit',
    ];
}
 