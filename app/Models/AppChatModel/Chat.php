<?php

namespace App\Models\AppChatModel;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $table='chat';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'chat_from', 'chat_to'
    ];
}
