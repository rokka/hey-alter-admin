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
        'teacher',
        'state',
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

    public function computers()
    {
        return $this->hasManyThrough(Computer::class, Position::class);
    }

    public function desktops()
    {
        return $this->hasManyThrough(Computer::class, Position::class)->where('type', 1);
    }

    public function laptops()
    {
        return $this->hasManyThrough(Computer::class, Position::class)->where('type', 2);
    }

    public function tablets()
    {
        return $this->hasManyThrough(Computer::class, Position::class)->where('type', 3);
    }

    public function small_form_factors()
    {
        return $this->hasManyThrough(Computer::class, Position::class)->where('type', 4);
    }

    public function unkonwn_types()
    {
        return $this->hasManyThrough(Computer::class, Position::class)->where('type', 0);
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

            if(is_null($order->teacher))
            {
                $order->teacher = '';
            }
        });
    }
}
