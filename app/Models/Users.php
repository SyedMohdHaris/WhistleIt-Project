<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['name','email','password','workspaceId'];

    public function workspaces(){

        $this->belongsTo(Workspace::class);
    }

    public function teams(){

        $this->belongsToMany(Teams::class,'user_teams');
    }

    public function channels(){

        $this->belongsToMany(Channels::class,'user_channels');
    }
}
