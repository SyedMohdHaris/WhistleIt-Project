<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $fillable = ['name','adminId','description','workspaceId'];

    public function users(){

        return $this->hasMany(Users::class,'user_teams');
    }
}
