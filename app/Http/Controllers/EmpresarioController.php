<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresario;
use Illuminate\Support\Facades\Validator;

class EmpresarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresarios = Empresario::where("activo",1)->get();
        return view('index', [
            'empresarios' => $empresarios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ch = curl_init("http://fx.currencysystem.com/webservices/CurrencyServer4.asmx?WSDL");
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $response=curl_exec($ch);
        dd(1,$ch);
        curl_close($ch);
        fclose($fp);
        


        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'correo' => 'required|max:255',
            'tipo_moneda' => 'required|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back();
        }
        $empresario= new Empresario();
        $empresario->codigo=$request->codigo;
        $empresario->razonsocial=$request->razonsocial;
        $empresario->nombre=$request->nombre;
        $empresario->pais=$request->pais;
        $empresario->tipo_moneda=$request->tipo_moneda;
        $empresario->estado=$request->estado;
        $empresario->ciudad=$request->ciudad;
        $empresario->telefono=$request->telefono;
        $empresario->correo=$request->correo;
        $empresario->activo=true;
        $empresario->save();
        return redirect('empresario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresario= Empresario::find($id);
        return view('create',[
            'empresario'=>$empresario,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(321);
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
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'correo' => 'required|max:255',
            'tipo_moneda' => 'required|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back();
        }
        $empresario= Empresario::find($id);
        $empresario->codigo=$request->codigo;
        $empresario->razonsocial=$request->razonsocial;
        $empresario->nombre=$request->nombre;
        $empresario->pais=$request->pais;
        $empresario->tipo_moneda=$request->tipo_moneda;
        $empresario->estado=$request->estado;
        $empresario->ciudad=$request->ciudad;
        $empresario->telefono=$request->telefono;
        $empresario->correo=$request->correo;
        $empresario->activo=true;
        $empresario->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresario= Empresario::find($id);
        $empresario->delete();
    }

    public function deactivate($id)
    {
        $empresario= Empresario::find($id);
        $empresario->activo=0;
        $empresario->save();
    }
}
