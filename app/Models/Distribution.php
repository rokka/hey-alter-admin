<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

use App\Models\Team;
use App\Mail\ComputerCreated;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'school_id',
        'hash',
    ];
    
    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }

    public static function BuildHash($firstname, $lastname, $birthday)
    {
        $key = strtolower($firstname . "_" . $lastname . "_" . $birthday);
        $hash = hash('sha256', $key);

        return $hash;
    }
}
