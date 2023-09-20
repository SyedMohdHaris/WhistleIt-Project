<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageLog extends Model
{
    use HasFactory;

    protected $table = 'message_logs';

    protected $fillable = ['senderId','receiverId','channelId','content','messagetype','dataType'];

    public function users(){

        return $this->belongsTo(Users::class);
    }

}
