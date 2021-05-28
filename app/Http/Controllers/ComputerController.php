<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;
use App\Models\Computer;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $computers = Computer::with('team')
            ->where('team_id', $user->currentTeam->id)
            ->where('type', 'like', ($request->has('type') ? $request->input('type') : '%'))
            ->where('state', 'like', ($request->has('state') ? $request->input('state') : '%'))
            ->orderBy('id','desc')->get();

        return view('computers.index', compact('computers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('computers.create')
                ->with('cpu', $request->input("cpu"))
                ->with('memory_in_gb', $request->input("memory_in_gb"))
                ->with('hard_drive_type', $request->input("hard_drive_type"))
                ->with('hard_drive_space_in_gb', $request->input("hard_drive_space_in_gb"))
            ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreComputerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComputerRequest $request)
    {
        $computer = Computer::create($request->validated());

        return redirect()->route('computers.index')->with('message', $computer->identifier . ' stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Computer $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Computer $computer)
    {
        return view('computers.show', compact('computer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Computer $computer
     * @return \Illuminate\Http\Response
     */
    public function edit(Computer $computer)
    {
        return view('computers.edit', compact('computer'));
    }

    public function edit2(Request $request, $location, $number)
    {
        $user = Auth::user();

        $team = Team::where('abbreviation', 'HA-' . $location)->first();

        if(is_null($team))
        {
            abort(404, 'Unkown team');
        }

        if($team->id != $user->currentTeam->id)
        {
            abort(403, 'Unauthorized');
        }
 
        $computer = Computer::where('team_id', $team->id)->where('number', $number)->first();

        if(is_null($computer))
        {
            abort(404, 'Unkown computer');
        }

        if($request->has("model") && strlen($request->input("model") > 0)) $computer->model = $request->input("model");
        if($request->has("cpu")) $computer->cpu = $request->input("cpu");
        if($request->has("memory_in_gb"))  $computer->memory_in_gb = $request->input("memory_in_gb");
        if($request->has("hard_drive_type")) $computer->hard_drive_type = $request->input("hard_drive_type");
        if($request->has("hard_drive_space_in_gb")) $computer->hard_drive_space_in_gb = $request->input("hard_drive_space_in_gb");
        if($request->has("type_name") && $request->input("type_name") == 'desktop') $computer->type = 1;
        if($request->has("type_name") && $request->input("type_name") == 'laptop') $computer->type = 2;
        
        return view('computers.edit', compact('computer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Computer $computer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComputerRequest $request, Computer $computer)
    {
        $computer->is_deletion_required = $request->has('is_deletion_required');
        $computer->needs_donation_receipt = $request->has('needs_donation_receipt');
        $computer->has_webcam = $request->has('has_webcam');
        $computer->has_wlan = $request->has('has_wlan');

        $computer->update($request->all());

        return view('computers.show', compact('computer'));
    }

    public function display($location, $number)
    {
        $computer = null;

        $team = Team::where('abbreviation', 'HA-' . $location)->first();

        if(!is_null($team))
        {
            $computer = Computer::where('team_id', $team->id)->where('number', $number)->first();


            if (Auth::check())
            {
                return redirect()->action(
                    [ComputerController::class, 'show'], ['computer' => $computer]
                );
            }
        }

        return view('computers.display')
            ->with('computer', $computer)
            ->with('location', $location)
            ->with('number', $number);
    }
}
