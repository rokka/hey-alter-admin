<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('schools.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        if($school->team->id != Auth::user()->currentTeam->id)
        {
            abort(403, 'Forbidden');
        }

        return view('schools.show', compact('school'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSchoolRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolRequest $request)
    {
        $school = School::create($request->validated());

        return redirect()->route('schools.index')->with('message', $school->identifier . ' stored successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        if($school->team->id != Auth::user()->currentTeam->id)
        {
            abort(403, 'Forbidden');
        }

        return view('schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        if($school->team->id != Auth::user()->currentTeam->id)
        {
            abort(403, 'Forbidden');
        }

        $school->update($request->all());

        return view('schools.show', compact('school'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->searchTerm;

        if ($request->ajax())
        {
            if ($query != '')
            {
                $schools = School::with('team')->where(function ($q) use ($query)
                {
                    $columns = ['name', 'type', 'zip', 'city', 'street', 'phone', 'contact_person'];

                    foreach ($columns as $column)
                    {
                        $q->orWhere($column, 'LIKE', '%' . $query . '%');
                    }
                })
                ->where('team_id', $user->currentTeam->id)
                ->orderBy('name','asc')
                ->get();
            }
            else
            {
                $schools = School::with('team')->where('team_id', $user->currentTeam->id)->orderBy('name','asc')->get();
            }

            return view('schools.table', compact('schools'));
        }
    }
}