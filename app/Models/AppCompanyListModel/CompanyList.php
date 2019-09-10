<?php

namespace App\Models\AppCompanyListModel;

use Illuminate\Database\Eloquent\Model;

class CompanyList extends Model
{
    public $table='company_list';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
