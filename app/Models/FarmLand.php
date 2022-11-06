<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class FarmLand extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'farm_lands';
    protected $fillable = ['user_id','tiles','name'];
}
