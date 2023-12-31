<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channels extends Model
{
    use HasFactory;

    protected $table = 'channels';

    protected $fillable = [
        'name',
        'description',
        'owner',
        'teamId'
    ];

    public function teams(){
        return $this->belongsTo(Teams::class);
    }

    public function users(){
        return $this->belongsToMany(Users::class,'user_channels');
    }
}
