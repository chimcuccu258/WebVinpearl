<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillDetailsRequest;
use App\Http\Requests\UpdateBillDetailsRequest;
use App\Models\BillDetails;

class BillDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BillDetails $billDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillDetails $billDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillDetailsRequest $request, BillDetails $billDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillDetails $billDetails)
    {
        //
    }
}