<?php

namespace App\Models\AppTaxDetailModel;

use Illuminate\Database\Eloquent\Model;

class TaxDetail extends Model
{
    public $table='tax_detail';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'tax_free', 'australian_residence', 'education_debt','fk_user_id','financial_debt','additional_information'
    ];
}
