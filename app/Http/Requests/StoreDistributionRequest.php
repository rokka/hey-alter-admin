<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Distribution;

class StoreDistributionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname' => [ 'required', 'string' ],
            'lastname' => [ 'required', 'string' ],
            'birthday' => [ 'required', 'string' ],
            'computer_number' => [ 'required', 'string' ],
        ];
    }

    public function withValidator($factory)
    {        
        $user = Auth::user();

        $hash = Distribution::BuildHash($this->firstname, $this->lastname, $this->birthday);

        $distribution = DB::table('distributions')->where('hash', $hash);

        $computer = DB::table('computers')
            ->where('team_id', $user->currentTeam->id)
            ->where('number', $this->computer_number)
            ->first();

        $factory->after(function ($factory) use ($user, $computer, $distribution)
        {
            if( $distribution->exists())
            {
                $factory->errors()->add('firstname', 'An diese Person wurde schon ein Computer ausgegeben.');
            }

            if (!isset($computer))
            {
                $factory->errors()->add('computer_number', 'Diese Computernummer ist nicht bekannt. Wenn auf dem Label "' . $user->currentTeam->abbreviation . '-0123" steht bitte nur "123" eingeben.');
            }
            else if ($computer->state != 'refurbished')
            {
                $factory->errors()->add('computer_number', 'Diese Computernummer hat nicht den Status "Aufbereitet".');
            }
        });

        return $factory;
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}