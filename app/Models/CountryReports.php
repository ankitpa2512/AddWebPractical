<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CountryReports extends Model
{
    protected $table = 'country_reports';

    protected $casts = [
        'data' => 'array'
    ];
}
