<?php

namespace App\Models\AppJobDetailModel;

use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    public $table='job_detail';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable = [
        'job_location', 'start_time', 'end_time','fk_user_id'
    ];
}
