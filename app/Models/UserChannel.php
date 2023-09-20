<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChannel extends Model
{
    use HasFactory;
    protected $table = 'user_channels';
    protected $fillable = ['userId','channelId'];
}
