<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.carreras.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.carreras.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carrera = Carrera::create($request->all());
        $carrera->save;
        Session::flash('message','Carrera creada correctamente!');
        return Redirect::to('/carreras');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carrera = Carrera::find($id);
        return view('admin.carreras.edit', ['carrera' => $carrera]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carrera = Carrera::find($id);
        $carrera->fill($request->all());
        $carrera->save();
        Session::flash('message','Carrera actualizado correctamente!');
        return Redirect::to('/carreras');
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

    public function desactivar($id)
    {
      $carrera=Carrera::find($id);
      $carrera->fill($estado->estado='V');
      $carrera->save();
      return Redirect::to('/carreras');
    }
  
    public function activar($id)
    {
      $catedras=Catedra::find($id);
      $catedras->fill($estado->estado='A');
      $catedras->save();
      Session::flash('message','Catedra activada correctamente!');
      return view('admin.catedras.activar', compact('catedras','estado'));
    }
    public function getCarreras($id)
    {
      return Sede::where('id', '=', $id)->first()->carreras;
    }
}
