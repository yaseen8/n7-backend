<?php

namespace App\Models\AppTimesheetModel;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    public $table='timesheet';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'check_in', 'check_out', 'check_in_location','check_out_location', 'fk_user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\AppUserModel\User'::class, 'fk_user_id');
    }
}
