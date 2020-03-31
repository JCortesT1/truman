<?php

namespace App\Http\Controllers;

use App\Cellar;
use Illuminate\Http\Request;

class CellarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cellar::where('descripcion', "BODEGA_FIRME_ANF")->first()->products->with(['author']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cellar  $cellar
     * @return \Illuminate\Http\Response
     */
    public function show(Cellar $cellar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cellar  $cellar
     * @return \Illuminate\Http\Response
     */
    public function edit(Cellar $cellar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cellar  $cellar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cellar $cellar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cellar  $cellar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cellar $cellar)
    {
        //
    }
}
