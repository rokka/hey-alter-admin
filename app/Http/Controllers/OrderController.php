<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\Order;
use App\Models\School;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $orders = Order::with('team')->where('team_id', $user->currentTeam->id)->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $schools = School::where('team_id', $user->currentTeam->id)->get();
        $users = User::where('current_team_id', $user->currentTeam->id)->get();

        return view('orders.create', compact('schools', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUpdateOrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateOrderRequest $request)
    {
        $order = Order::create($request->validated());
        
        return redirect()->route('orders.show', ['order' => $order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $user = Auth::user();

        $schools = School::where('team_id', $user->currentTeam->id)->get();
        $users = User::where('current_team_id', $user->currentTeam->id)->get();

        return view('orders.edit', compact('order', 'schools', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return view('orders.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
