<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{

    protected $fillable = [
        'school_id',
        'user_id',
        'desktop_count',
        'laptop_count',
        'tablet_count',
        'sff_count',
        'comment',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::saving(function ($order) {

            if (!$order->exists) {
                $user = Auth::user();

                $order->team_id = $user->currentTeam->id;
            }
        });

        static::saving(function ($order) {

            if(is_null($order->comment))
            {
                $order->comment = '';
            }
        });
    }
}
