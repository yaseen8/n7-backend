<?php

namespace App\Models\AppUserCompanyModel;

use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    public $table='user_company';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'fk_company_id', 'hire', 'fk_user_id'
    ];
}
