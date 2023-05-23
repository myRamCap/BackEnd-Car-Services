<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Notification extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'corporate_id',
        'service_center_id',
        'datefrom',
        'dateto',
        'title',
        'content',
        'image_url',
    ];
}
 