<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Models\Team;
use App\Mail\ComputerCreated;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor',
        'email',
        'number',
        'identifier',
        'type',
        'model',
        'comment',
        'is_deletion_required',
        'needs_donation_receipt',
        'has_webcam',
        'has_wlan',
        'required_equipment',
        'needs_donation_receipt',
        'state',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getIdentifierAttribute()
    {
        return $this->team->abbreviation . "-" . str_pad($this->number, 4, '0', STR_PAD_LEFT);
    }

    protected static function booted()
    {
        static::saving(function ($computer) {

            if(!$computer->exists)
            {
                $user = Auth::user();

                $last_number = DB::table('computers')->where('team_id', $user->currentTeam->id)->max('number');
                $last_number = intval($last_number);

                $computer->team_id = $user->currentTeam->id;
                $computer->number = $last_number + 1;
            }

            if(is_null($computer->model))
            {
                $computer->model = '';
            }

            if(is_null($computer->comment))
            {
                $computer->comment = '';
            }

            if(is_null($computer->required_equipment))
            {
                $computer->required_equipment = '';
            }
        });

        static::created(function($computer) {
	        Mail::send(new ComputerCreated($computer));
	    });
    }
}
