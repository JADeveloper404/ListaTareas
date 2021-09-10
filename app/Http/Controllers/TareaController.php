<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tarea::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Tarea::create($request['data']->all());
        DB::table('tareas')->insert([
            'nombre' => $request['data']['nombre'],
            'descripcion' => $request['data']['descripcion'],
            'check' => $request['data']['check'],
            'fecha' => $request['data']['fecha'],
        ]);

        return response()->json(['mensaje'=>"Agregado Correctamente", 200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        $tarea->nombre = $request['data']['nombre'];
        $tarea->nombre = $request['data']['nombre'];
        $tarea->descripcion = $request['data']['descripcion'];
        $tarea->save();

        return response()->json(['mensaje'=>"Modificado Correctamente", 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return response()->json(['mensaje'=>"Eliminado Correctamente", 200]);
    }

    public function check(Request $request, $id) {
        $tarea = Tarea::findOrFail($id);
        $tarea->check = $request['data'];
        $tarea->save();

        $mensaje = $tarea->check == true ? 'Marcada Correctamente' : 'Desmarcada Correctamente';

        return response()->json(['mensaje' => $mensaje], 200);
    }
}
