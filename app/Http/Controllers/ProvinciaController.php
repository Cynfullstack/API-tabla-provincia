<?php

namespace App\Http\Controllers;

use App\Models\provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $response = Http::get('https://apis.datos.gob.ar/georef/api/provincias');

        $provincias=json_decode($response->getBody(),true);

        foreach ($provincias['provincias'] as $value) {
                 Provincia::updateOrCreate(
                ['indec_id'=>$value['id']],
                ['indec_id'=>$value['id'], 'nombre'=>$value['nombre']]
                
            );

        }
        return response()->json(['mensaje'=> 'se inserto las provincias']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function show(provincia $provincia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function edit(provincia $provincia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, provincia $provincia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function destroy(provincia $provincia)
    {
        //
    }
}
