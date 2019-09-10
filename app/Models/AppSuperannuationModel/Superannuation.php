<?php

namespace App\Models\AppSuperannuationModel;

use Illuminate\Database\Eloquent\Model;

class Superannuation extends Model
{
    public $table='superannuation';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'fund_name', 'account_name', 'membership_number','fk_user_id'
    ];
}
