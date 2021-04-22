<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        if($buscar==''){
            $medicamento =Medicamento::join('laboratorio','medicamento.id_laboratorio' , '=', 'laboratorio.id')
            ->select('medicamento.id','medicamento.nombre','medicamento.descripcion','medicamento.precio','medicamento.id_laboratorio','laboratorio.nombre as nom_laboratorio')
            ->get();
        }else{

            $medicamento =Medicamento::join('laboratorio','medicamento.id_laboratorio' , '=', 'laboratorio.id')
            ->select('medicamento.id','medicamento.nombre','medicamento.descripcion','medicamento.precio','medicamento.id_laboratorio','laboratorio.nombre as nom_laboratorio')
            ->where('medicamento.nombre','like','%'.$buscar.'%')
            ->get();

        }
   
        return $medicamento;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medicamento = new Medicamento;
        $medicamento->nombre=$request->nombre;
        $medicamento->descripcion=$request->descripcion;
        $medicamento->precio=$request->precio;
        $medicamento->id_laboratorio=$request->id_laboratorio;
        $medicamento->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $medicamento=Medicamento::findOrFail($request->id);
        $medicamento->nombre=$request->nombre;
        $medicamento->descripcion=$request->descripcion;
        $medicamento->precio=$request->precio;
        $medicamento->id_laboratorio=$request->id_laboratorio;
        $medicamento->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $medicamento = Medicamento::findOrFail($request->id);
        $medicamento->delete();
    }

}
