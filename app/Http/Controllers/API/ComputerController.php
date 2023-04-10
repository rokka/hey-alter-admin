<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;
use App\Http\Resources\ComputerResource;
use App\Models\Computer;
use App\Models\Team;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     * path="/api/computers",
     * summary="Get all computers",
     * operationId="indexComputer",
     * tags={"Computers"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/ComputerResource")),
     * @OA\Response(response=401, description="Unauthorized"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=500, description="Internal Server Error"),
     * )
     */
    public function index()
    {
        $user = auth()->user();

        if(!$user->tokenCan("computers.read"))
        {
            abort(403, 'Forbidden');
	}

	$computers = Computer::where('team_id', $user->current_team_id)->get();

	return response()->json(['computers' => $computers]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    **/
    /**
     * @OA\Get(
     * path="/api/computers/{id}",
     * summary="Get computer by id or number",
     * operationId="showComputer",
     * tags={"Computers"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", description="Id or number of the computer", required=true, @OA\Schema(type="integer", format="int64"), style="form"),
     * @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/ComputerResource")),
     * @OA\Response(response=401, description="Unauthorized"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=404, description="Not found"),
     * @OA\Response(response=500, description="Internal Server Error"),
     * )
     */
    public function show($id)
    {
	$user = auth()->user();

        if(!$user->tokenCan("computers.read"))
        {
            abort(403, 'Forbidden');
        }

	if(preg_match("/(.*)-([0-9]*)$/", $id, $matches))
	{
		$abb = $matches[1];
		$number = $matches[2];

		$team = Team::where('abbreviation', $abb)->firstOrFail();
		$computer = Computer::where('number', $number)->where('team_id', $team->id)->firstOrFail();
	}
	else
	{
		$computer = Computer::findOrFail($id);
	}

	if($computer == null)
	{
		abort(404, 'Not Found');
	}

        if($computer->team->id != $user->current_team_id)
        {
            abort(403, 'Forbidden');
	}

	unset($computer->team);

	return response()->json(['computer' => $computer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     * path="/api/computers",
     * summary="Create a new computer",
     * operationId="storeComputer",
     * tags={"Computers"},
     * security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Computer object that needs to be added to the database",
     *         @OA\JsonContent(ref="#/components/schemas/ComputerResource"),
     *     ),
     * @OA\Response(response=201, description="Created", @OA\JsonContent(ref="#/components/schemas/ComputerResource")),
     * @OA\Response(response=401, description="Unauthorized"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=422, description="Unprocessable Entity"),
     * @OA\Response(response=500, description="Internal Server Error"),
     * )
     */
    public function store(StoreComputerRequest $request)
    {
	$user = auth()->user();

        if(!$user->tokenCan("computers.create"))
        {
            abort(403, 'Forbidden');
	}

	if(isset($request->number))
	{
		if(Computer::where('team_id', $user->current_team_id)->where('number', $request->number)->exists())
		{
			abort(409, 'Computer number already exists');
		}
	}

        $computer = Computer::create($request->validated());

        return response()->json($computer, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Patch(
     * path="/api/computers",
     * summary="Update an existing computer",
     * operationId="updateComputer",
     * tags={"Computers"},
     * security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pet object that needs to be added to the store",
     *         @OA\JsonContent(ref="#/components/schemas/ComputerResource"),
     *     ),
     * @OA\Response(response=200, description="OK"),
     * @OA\Response(response=401, description="Unauthorized"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=404, description="Not found"),
     * )
     */
    public function update($id, UpdateComputerRequest $request)
    {
	$user = auth()->user();

        if(!$user->tokenCan("computers.update"))
        {
            abort(403, 'Forbidden');
	}

	if(preg_match("/(.*)-([0-9]*)$/", $id, $matches))
        {
                $abb = $matches[1];
                $number = $matches[2];

                $team = Team::where('abbreviation', $abb)->firstOrFail();
                $computer = Computer::where('number', $number)->where('team_id', $team->id)->firstOrFail();
        }
        else
        {
                $computer = Computer::findOrFail($id);
        }

        if($computer->team->id != $user->currentTeam->id)
        {
            abort(403, 'Forbidden');
        }

        if(isset($request->number))
        {
                if(Computer::where('team_id', $user->current_team_id)->where('number', $request->number)->exists())
                {
                        abort(409, 'Computer number already exists');
                }
        }

	$computer->update($request->all());

	unset($computer->team);
	
	return response()->json($computer, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     * path="/api/computers",
     * summary="Delete a computer",
     * operationId="destroyComputer",
     * tags={"Computers"},
     * security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pet object that needs to be added to the store",
     *         @OA\JsonContent(ref="#/components/schemas/ComputerResource"),
     *     ),
     * @OA\Response(response=201, description="Created", @OA\JsonContent(ref="#/components/schemas/ComputerResource")),
     * @OA\Response(response=401, description="Unauthorized"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=422, description="Unprocessable Entity"),
     * @OA\Response(response=500, description="Internal Server Error"),
     * )
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if(!$user->tokenCan("computers.delete"))
        {
            abort(403, 'Forbidden');
        }

	if(preg_match("/(.*)-([0-9]*)$/", $id, $matches))
	{
		$abb = $matches[1];
                $number = $matches[2];

                $team = Team::where('abbreviation', $abb)->firstOrFail();
                $computer = Computer::where('number', $number)->where('team_id', $team->id)->firstOrFail();
        }
        else
        {
                $computer = Computer::findOrFail($id);
        }

        if($computer->team->id != $user->currentTeam->id)
        {
            abort(403, 'Forbidden');
	}

	$computer->delete();

	return response()->noContent();
    }
}
