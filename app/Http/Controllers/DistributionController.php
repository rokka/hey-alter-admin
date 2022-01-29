<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Computer;
use App\Models\Distribution;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\StoreDistributionRequest;

class DistributionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $schools = School::with('team')->where('team_id', $user->currentTeam->id)->orderBy('name','asc')->get();

        $distributions = Distribution::with('computer')->where('team_id', $user->currentTeam->id)->orderBy('created_at', 'desc')->get();

        return view('distributions.index', compact('schools', 'distributions'));
    }

    public function store(StoreDistributionRequest $request)
    {
        $user = Auth::user();

        $hash = Distribution::BuildHash($request->firstname, $request->lastname, $request->birthday);

        $computer = Computer::where('team_id', $user->currentTeam->id)
            ->where('number', $request->computer_number)
            ->first();

        $distribution = new Distribution();
        $distribution->team_id = $user->currentTeam->id;
        $distribution->computer_id = $computer->id;
        $distribution->hash = $hash;
        $distribution->save();

        $computer->state = 'delivered';
        $computer->save();

        return redirect()->route('distributions.index')->with('message', 'Die Ausgabe wurde erfolgreich gespeichert.');
    }
}