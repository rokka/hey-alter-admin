<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;

class InquiryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inquiries.create');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  StoreInquiryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInquiryRequest $request)
    {
        dd($request);
        dd($request->validated());
dd("x");
        //return redirect()->route('computers.index')->with('message', $computer->identifier . ' stored successfully');
    }
}