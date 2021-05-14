<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;
use App\Http\Resources\ComputerResource;
use App\Models\Computer;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    **/    
    /**
     * @OA\Get(
     * path="/api/computers/{id}",
     * summary="Get computer by id",
     * operationId="showComputer",
     * tags={"Computers"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", description="Id of the computer", required=true, @OA\Schema(type="integer", format="int64"), style="form"),
     * @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/ComputerResource")),
     * @OA\Response(response=401, description="Unauthorized"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=404, description="Not found"),
     * @OA\Response(response=500, description="Internal Server Error"),
     * )
     */
    public function show($id)
    {
        if(!auth()->user()->tokenCan("computers.read"))
        {
            abort(403, 'Unauthorized');
        }

        return new ComputerResource(Computer::findOrFail($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     * path="/api/computers/",
     * summary="Create a new computer",
     * operationId="storeComputer",
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
    public function store(StoreComputerRequest $request)
    {
        if(!auth()->user()->tokenCan("computers.create"))
        {
            abort(403, 'Unauthorized');
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
     * path="/api/computers/",
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
    public function update(UpdateComputerRequest $request, Computer $computer)
    {
        if(!auth()->user()->tokenCan("computers.update"))
        {
            abort(403, 'Unauthorized');
        }

        $computer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        /**
     * @OA\Delete(
     * path="/api/computers/",
     * summary="Delete a computer",
     * operationId="deleteComputer",
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
        if(!auth()->user()->tokenCan("computers.delete"))
        {
            abort(403, 'Unauthorized');
        }
    }
}
