<?php

namespace App\Models\AppRequestEmailModel;

use Illuminate\Database\Eloquent\Model;

class RequestEmail extends Model
{
    public $table='request_email';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'email'
    ];
}
