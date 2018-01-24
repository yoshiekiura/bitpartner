<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'acc',
        'pressure',
        'rgb',
        'soiltemp',
        'temperature',
        'moisture',
        'lux',
        'heading',
        'timestamp'
    ];

    function tempInF()
    {
        return round($this->temperature * (9/5) + 32, 2);
    }

}