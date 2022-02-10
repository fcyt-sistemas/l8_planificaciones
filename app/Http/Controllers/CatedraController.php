<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Catedra;
use DB;
use Session;
use Redirect;

class CatedraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $url = route('admin.catedras.activar');
        $estado = Catedra::estado($request->get('estado'));
        if($estado != 'V'){
            $catedras = $estado;
            return view('admin.catedras.index', ['catedras' => $catedras, 'url' => $url]);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catedras.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catedras = Catedra::create($request->all());
        $catedras->save;
        Session::flash('message','Catedra creada correctamente!');
        return Redirect::to('/catedras');
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
        $catedras = Catedra::find($id);
        return view('admin.catedras.edit', ['catedras'=> $catedras]);
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
        $catedras = Catedra::find($id);
        $catedras->fill($request->all());
        $catedras->save();
        Session::flash('message','Catedra actualizado correctamente!');
        return Redirect::to('/catedras');
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
    $catedras=Catedra::find($id);
    $catedras->fill($estado->estado='V');
    $catedras->save();
    Session::flash('message','Catedra desactivada correctamente!');
    return view('admin.catedras.desactivar', ['catedras' => $catedras]);
  }


  public function activar($id)
  {
    $catedras=Catedra::find($id);
    $catedras->fill($estado->estado='A');
    $catedras->save();
    Session::flash('message','Catedra activada correctamente!');
    return view('admin.catedras.activar', ['catedras' => $catedras]);
  }

  public function getCatedras($id)
  {
    return Plan::where('id', '=', $id)->first()->catedras;
  }
}
