<?php

namespace App\Models\AppPaymentModeModel;

use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    public $table='payment_mode';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'bank_name', 'bsb_number', 'account_number','mode','rate','site_allocated','additional_rate','additional_site_name','fk_user_id'
    ];
}
