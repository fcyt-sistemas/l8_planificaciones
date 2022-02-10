<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.planes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.planes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan = Plan::create($request->all());
        $plan->save;
        Session::flash('message','Plan creado correctamente!');
        return Redirect::to('/planes');
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
        $plan = Plan::find($id);
        return view('admin.planes.edit', compact('plan'));
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
        $plan = Plan::find($id);
        $plan->fill($request->all());
        $plan->save();
        Session::flash('message','Plan actualizado correctamente!');
        return Redirect::to('/planes');
    }

    public function desactivar($id)
  {
    $plan=Plan::find($id);
    $plan->fill($estado->estado='V');
    $plan->save();
    return Redirect::to('/planes');
  }


  public function activar($id)
  {
    $catedras=Catedra::find($id);
    $catedras->fill($estado->estado='A');
    $catedras->save();
    Session::flash('message','Catedra activada correctamente!');
    return view('admin.catedras.activar', compact('catedras','estado'));
  }
  public function getPlanes($id)
  {
    return Carrera::where('id', '=', $id)->first()->planes;
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
}
