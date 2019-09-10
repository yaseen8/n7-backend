<?php

namespace App\Models\AppSecurityLicenceModel;

use Illuminate\Database\Eloquent\Model;

class SecurityLicence extends Model
{
    public $table='security_license';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'license_number', 'expiry', 'certificate','fk_user_id'
    ];
}
