<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillsRequest;
use App\Http\Requests\UpdateBillsRequest;
use App\Models\Bills;

class BillsController extends Controller
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
    public function store(StoreBillsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bills $bills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bills $bills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillsRequest $request, Bills $bills)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bills $bills)
    {
        //
    }
}
