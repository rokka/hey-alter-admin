<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsignmentRequest;
use App\Models\Computer;

use Illuminate\Http\Request;

class ConsignmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consignments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreInquiryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConsignmentRequest $request)
    {
        $request->validated();

        $desktop_numbers = array();
        $laptop_numbers = array();

        for($i = 0; $i < $request->input("desktop_count"); $i++)
        {
            $computer = new Computer();
            $computer->donor = $request->input("donor");
            $computer->type = 1;
            $computer->is_deletion_required = $request->input('is_deletion_required');
            $computer->save();

            $desktop_numbers[] = $computer->identifier;
        }

        for($i = 0; $i < $request->input("laptop_count"); $i++)
        {
            $computer = new Computer();
            $computer->donor = $request->input("donor");
            $computer->type = 2;
            $computer->is_deletion_required = $request->input('is_deletion_required');
            $computer->save();

            $laptop_numbers[] = $computer->identifier;
        }

        return redirect()->route('consignments.created', ['desktop_numbers' => $desktop_numbers, 'laptop_numbers' => $laptop_numbers]);
    }

    public function created(Request $request)
    {
        return view('consignments.created')
            ->with('desktop_numbers', $request->input('desktop_numbers'))
            ->with('laptop_numbers', $request->input('laptop_numbers'));
    }
}