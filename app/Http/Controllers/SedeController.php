<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sedes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sedes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sede = Sede::create($request->all());
        $sede->save;
        Session::flash('message','Sede creada correctamente!');
        return Redirect::to('/sedes');
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
        $sede = Sede::find($id);
        return view('admin.sedes.edit', ['sede' => $sede]);
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
        $sede = Sede::find($id);
        $sede->fill($request->all());
        $sede->save();
        Session::flash('message','Sede actualizada correctamente!');
        return Redirect::to('/sedes');
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
    $sede=Sede::find($id);
    $sede->fill($estado->estado='V');
    $sede->save();
    return Redirect::to('/sedes');
  }

    public function activar($id)
  {
    $catedras=Catedra::find($id);
    $catedras->fill($estado->estado='A');
    $catedras->save();
    Session::flash('message','Catedra activada correctamente!');
    return view('admin.catedras.activar', ['catedras' => $catedras,'estado' => $estado]);
  }
  
  public function getSede($id)
  {
    return Sede::where('id', '=', $id)->first()->sedes;
  }
}
