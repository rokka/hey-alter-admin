<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Team;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor',
        'email',
        'number',
        'identifier',
        'model',
        'comment',
        'is_deletion_required',
        'needs_donation_receipt',
        'has_webcam',
        'required_equipment',
        'needs_donation_receipt',
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
        static::creating(function ($computer) {

            $user = Auth::user();

            $last_number = DB::table('computers')->where('team_id', $user->currentTeam->id)->max('number');
            $last_number = intval($last_number);

            $computer->team_id = $user->currentTeam->id;
            $computer->number = $last_number + 1;

            if(is_null($computer->model))
            {
                $computer->model = '';
            }

            if(is_null($computer->comment))
            {
                $computer->comment = '';
            }

            if(is_null($computer->is_deletion_required))
            {
                $computer->is_deletion_required = 0;
            }

            if(is_null($computer->needs_donation_receipt))
            {
                $computer->needs_donation_receipt = 0;
            }

            if(is_null($computer->has_webcam))
            {
                $computer->has_webcam = 0;
            }

            if(is_null($computer->required_equipment))
            {
                $computer->required_equipment = '';
            }
        });
    }
}
