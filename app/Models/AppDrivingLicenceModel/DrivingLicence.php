<?php

namespace App\Models\AppDrivingLicenceModel;

use Illuminate\Database\Eloquent\Model;

class DrivingLicence extends Model
{
    public $table='driving_license';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'license_number', 'expiry', 'state','fk_user_id','note'
    ];
}
