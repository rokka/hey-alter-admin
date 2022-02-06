<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class School extends Model
{

    protected $fillable = [
        'name',
        'type',
        'zip',
        'city',
        'street',
        'phone',
        'contact_person',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    protected static function booted()
    {
        static::saving(function ($school) {

            if (!$school->exists) {
                $user = Auth::user();

                $school->team_id = $user->currentTeam->id;
            }
            
            if (is_null($school->type)) {
                $school->type = '';
            }

            if (is_null($school->zip)) {
                $school->zip = '';
            }

            if (is_null($school->city)) {
                $school->city = '';
            }

            if (is_null($school->street)) {
                $school->street = '';
            }

            if (is_null($school->phone)) {
                $school->phone = '';
            }

            if (is_null($school->contact_person)) {
                $school->contact_person = '';
            }
        });
    }
}
