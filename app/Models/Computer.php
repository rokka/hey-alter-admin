<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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
        'has_vga_videoport',
        'has_dvi_videoport',
        'has_hdmi_videoport',
        'has_displayport_videoport',
        'required_equipment',
        'needs_donation_receipt',
        'state',
        'cpu',
        'memory_in_gb',
        'hard_drive_type',
        'hard_drive_space_in_gb',
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

            if(is_null($computer->cpu))
            {
                $computer->cpu = '';
            }

            if(is_null($computer->memory_in_gb))
            {
                $computer->memory_in_gb = 0;
            }

            if(is_null($computer->hard_drive_type))
            {
                $computer->hard_drive_type = 0;
            }

            if(is_null($computer->hard_drive_space_in_gb))
            {
                $computer->hard_drive_space_in_gb = 0;
            }
        });

        static::created(function($computer) {
            
            $user = Auth::user();

            $zulip_bot_username = env('ZULIP_BOT_USERNAME', '');
            $zulip_bot_password = env('ZULIP_BOT_PASSWORD', '');

            if($user->currentTeam->notfification_on_computer_created &&
               $user->currentTeam->notfification_stream != '' &&
               $zulip_bot_username != '' &&
               $zulip_bot_password != '')
            {
                $url = URL::to($computer->identifier);
                
                $stream = $user->currentTeam->notfification_stream;
                $topic = "Computerliste";
                $message = "Es wurde ein neuer Computer hinzugefügt: {$computer->identifier} ([Details ansehen]({$url}))";

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://chat.heyalter.com/api/v1/messages');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "type=stream&to=$stream&subject=$topic&content=$message");
                curl_setopt($ch, CURLOPT_USERPWD, $zulip_bot_username . ':' . $zulip_bot_password);
        
                $headers = array();
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close($ch);
            }
	    });
    }
}
