<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{

    protected $fillable = [
        'name',
        'type',
        'zip',
        'city',
        'street',
        'phone',
    ];

    protected static function booted()
    {
        static::saving(function ($school) {

            if(is_null($school->type))
            {
                $school->type = '';
            }

            if(is_null($school->zip))
            {
                $school->zip = '';
            }

            if(is_null($school->city))
            {
                $school->city = '';
            }

            if(is_null($school->street))
            {
                $school->street = '';
            }

            if(is_null($school->phone))
            {
                $school->phone = '';
            }

        });
    }
}
