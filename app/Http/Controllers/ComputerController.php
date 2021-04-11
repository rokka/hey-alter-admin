<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;
use App\Models\Computer;
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
        $user = Auth::user();

        $computers = Computer::with('team')->where('team_id', $user->currentTeam->id)->get();

        return view('computers.index', compact('computers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('computers.create');
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
    public function show(Computer $computer)
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
                
        $computer->update($request->all());
        
        return view('computers.show', compact('computer'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Computer $computer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Computer $computer)
    {
        $computer->delete();

        return back()->with('message', 'item deleted successfully');
    }
}
