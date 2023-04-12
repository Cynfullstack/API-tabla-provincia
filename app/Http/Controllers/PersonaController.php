<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PersonaController extends Controller
    {

     public function index ()
     {

        $personas = Persona::with('provincia')->get();
        
        $data = $personas->map(function($persona){
        return[
                'id'=>$persona->id,
                'nombre'=>$persona->nombre,
                'apellido'=>$persona->apellido,
                'provincia_persona'=>[
                 'id'=> $persona->provincia->id,
                 'nombre'=>$persona->provincia->nombre,
                    
                 
     ]

        ];
    });

        
    

return response()->json ([
'mensaje'=>'listado de pesona con su provincia',
'data'=>$data

]);
    }

    
public function store (Request $request)
    {
        $persona= Persona::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'provincia_id'=> $request->provincia_id
            
        ]); 
//enviar mails
        $details = [
            'nombre' =>  $request->nombre,
            'apellido' => $request->apellido,
            ];
        \Mail::to('cintiachatard@gmail.com')->send(new \App\Mail\RegistroMail($details));
        return response()->json([
            'mensaje'=> 'se inserto correctamente la persona',
            'data'=> [
                'nombre'=> $persona->nombre,
                'apellido'=>$persona->apellido,
            ]
        ]);
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)

    {
        $persona = Persona::with('provincia')->findOrFail($id);
        return response ()->json ([
            'mensaje'=>'datos de la  persona solicitada',
            'data'=> [
            'persona_id'=>$persona->id,
            'persona_nombre'=>$persona->nombre,
            'persona_apellido'=>$persona->apellido,
            'persona_provincia'=>[
            'id'=> $persona-> provincia->id,

            'nombre'=>$persona->provincia->nombre,
            ]
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $persona = Persona::findOrFail($id);

        $persona ->nombre = $request->nombre;
        $persona ->apellido = $request->apellido;
        $persona->provincia_id = $request->provincia_id;
        
        $persona->save();

       
        return response()->json([

            'mensaje'=> 'se actualizo correctamente',
            'data'=> [

                'persona_id'=>$persona->id,
            'persona_nombre'=>$persona->nombre,
            'persona_apellido'=>$persona->apellido,
            ]

            
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        
        $persona = Persona::findOrFail($id);
        $persona->delete();
        return response ()->json ([
            'mensaje'=>'se elimino una persona',
            'data'=>$persona
        ]);
    }
}
