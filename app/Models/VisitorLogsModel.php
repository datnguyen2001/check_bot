<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLogsModel extends Model
{
    use HasFactory;
    protected $table='visitor_logs';
    protected $fillable=[
        'ip',
        'country',
        'city',
        'page',
        'enter_time',
        'leave_time',
    ];
}
