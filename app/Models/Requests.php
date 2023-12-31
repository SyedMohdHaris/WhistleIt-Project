<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable = [
        'name',
        'requestType',
        'receiverId',
        'senderId',
        'locationId'
    ];

}
