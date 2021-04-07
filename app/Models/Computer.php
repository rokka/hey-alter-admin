<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor',
        'email',
        'identifier',
        'model',
        'comment',
        'is_deletion_required',
        'needs_donation_receipt',
    ];

    protected static function booted()
    {
        static::creating(function ($user) {

            $last_identifier = DB::table('computers')->max('identifier');

            $last_id = intval(preg_replace('/[^0-9]/', '', $last_identifier)) + 1;

            $user->identifier = "HA-E-" . str_pad($last_id, 4, '0', STR_PAD_LEFT);

            if(is_null($user->model))
            {
                $user->model = '';
            }

            if(is_null($user->comment))
            {
                $user->comment = '';
            }

            if(is_null($user->is_deletion_required))
            {
                $user->is_deletion_required = 0;
            }

            if(is_null($user->needs_donation_receipt))
            {
                $user->needs_donation_receipt = 0;
            }
        });
    }
}
