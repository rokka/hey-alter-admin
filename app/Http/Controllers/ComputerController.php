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
    public function index()
    {
        return view('computers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Computer $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Computer $computer)
    {
        if($computer->team->id != Auth::user()->currentTeam->id)
        {
            abort(403, 'Forbidden');
        }

        return view('computers.show', compact('computer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->input("type_name") == 'desktop')
        {
            $type = 1;
        }
        else if($request->input("type_name") == 'notebook')
        {
            $type = 2;
        }
        else
        {
           $type = 0;
        }

        return view('computers.create')
                ->with('model', $request->input("model"))
                ->with('cpu', $request->input("cpu"))
                ->with('memory_in_gb', $request->input("memory_in_gb"))
                ->with('hard_drive_type', $request->input("hard_drive_type"))
                ->with('hard_drive_space_in_gb', $request->input("hard_drive_space_in_gb"))
                ->with('has_vga_videoport', $request->input("has_vga_videoport"))
                ->with('has_dvi_videoport', $request->input("has_dvi_videoport"))
                ->with('has_hdmi_videoport', $request->input("has_hdmi_videoport"))
                ->with('has_displayport_videoport', $request->input("has_displayport_videoport"))
                ->with('type', $type)
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

        return redirect()->route('computers.index')->with('message', $computer->identifier . ' wurde gespeichert.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Computer $computer
     * @return \Illuminate\Http\Response
     */
    public function edit(Computer $computer)
    {
        if($computer->team->id != Auth::user()->currentTeam->id)
        {
            abort(403, 'Forbidden');
        }

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
        if($computer->team->id != Auth::user()->currentTeam->id)
        {
            abort(403, 'Forbidden');
        }

        $computer->is_deletion_required = $request->has('is_deletion_required');
        $computer->needs_donation_receipt = $request->has('needs_donation_receipt');
        $computer->has_webcam = $request->has('has_webcam');
        $computer->has_wlan = $request->has('has_wlan');
        $computer->has_vga_videoport = $request->has('has_vga_videoport');
        $computer->has_dvi_videoport = $request->has('has_dvi_videoport');
        $computer->has_hdmi_videoport = $request->has('has_hdmi_videoport');
        $computer->has_displayport_videoport = $request->has('has_displayport_videoport');

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

    public function search(Request $request)
    {
        $user = Auth::user();

        $query = $request->searchTerm;
        $filter = $request->get('state');

        if ($request->ajax())
        {

            if($request->get('state'))
            {
                $computers = Computer::with('team')->where(function ($q) use ($filter) {

                        $q->where('state', 'LIKE', '%' . $filter . '%');

                })
                    ->where('team_id', $user->currentTeam->id)
                    ->where('type', 'like', ($request->has('type') ? $request->input('type') : '%'))
                    ->where('state', 'like', ($request->has('state') ? $request->input('state') : '%'))
                    ->orderBy('id', 'desc')
                    ->get();
            }
            elseif ($query != '')
            {
                $computers = Computer::with('team')->where(function ($q) use ($query) {

                    $columns = ['number', 'donor', 'model', 'email', 'cpu', 'required_equipment', 'comment'];

                    foreach ($columns as $column) {
                        $q->orWhere($column, 'LIKE', '%' . $query . '%');

                    }
                })
                    ->where('team_id', $user->currentTeam->id)
                    ->where('type', 'like', ($request->has('type') ? $request->input('type') : '%'))
                    ->where('state', 'like', ($request->has('state') ? $request->input('state') : '%'))
                    ->orderBy('id', 'desc')
                    ->get();
            }
            else
            {
                $computers = Computer::with('team')
                    ->where('team_id', $user->currentTeam->id)
                    ->where('type', 'like', ($request->has('type') ? $request->input('type') : '%'))
                    ->where('state', 'like', ($request->has('state') ? $request->input('state') : '%'))
                    ->orderBy('id','desc')->get();
            }

            return view('computers.table', compact('computers'));
        }
    }
}
