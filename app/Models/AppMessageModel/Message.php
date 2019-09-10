<?php

namespace App\Models\AppMessageModel;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $table='message';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'body', 'fk_chat_id','fk_user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\AppUserModel\User'::class, 'fk_user_id');
    }

    public function chat()
    {
        return $this->belongsTo('App\Models\AppChatModel\Chat'::class, 'fk_chat_id');
    }
}
