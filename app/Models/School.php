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
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getIdentifierAttribute()
    {
        return $this->team->name . "-" . str_pad($this->number, 4, '0', STR_PAD_LEFT);
    }

    protected static function booted()
    {
        static::saving(function ($school) {

            if (!$school->exists) {
                $user = Auth::user();

                $last_number = DB::table('schools')->where('team_id', $user->currentTeam->id)->max('number');
                $last_number = intval($last_number);

                $school->team_id = $user->currentTeam->id;
                $school->number = $last_number + 1;
            }
            static::saving(function ($school) {

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

            });
        });
    }
}
