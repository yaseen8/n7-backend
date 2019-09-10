<?php

namespace App\Models\AppUserModel;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\AppUserCompanyModel\UserCompany;
use App\Models\AppTaxDetailModel\TaxDetail;
use App\Models\AppSuperannuationModel\Superannuation;
use App\Models\AppSecurityLicenceModel\SecurityLicence;
use App\Models\AppPaymentModeModel\PaymentMode;
use App\Models\AppDrivingLicenceModel\DrivingLicence;
use App\Models\AppMessageModel\Message;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $table='users';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'name','surname','username','password','user_type', 'email', 'mobile','dob','address','nok_name','nok_contact'
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function user_company()
    {
        return $this->hasOne(UserCompany::class,'fk_user_id');
    }

    public function tax_detail()
    {
        return $this->hasOne(TaxDetail::class,'fk_user_id');
    }

    public function superannuation()
    {
        return $this->hasOne(Superannuation::class,'fk_user_id');
    }

    public function security_licence()
    {
        return $this->hasOne(SecurityLicence::class,'fk_user_id');
    }

    public function payment_mode()
    {
        return $this->hasOne(PaymentMode::class,'fk_user_id');
    }

    public function drivig_licence()
    {
        return $this->hasOne(DrivingLicence::class,'fk_user_id');
    }

    public function message()
    {
        return $this->hasOne(Message::class,'fk_user_id');
    }

}
