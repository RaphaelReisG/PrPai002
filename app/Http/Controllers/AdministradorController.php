<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Administrador::all();

        //return Administrador::with('user')->paginate(1);
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
        //Administrador::create($request->all());
        $create = Administrador::create([ 'name' => $request->name])
                ->user()->create(['email'=> $request->email, 'password'=>Hash::make($request->password) ])
                ->givePermissionTo('admin');
        return $create;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Administrador::with('user')->findOrfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrador $administrador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obj = Administrador::with('user')->findOrfail($id);
        if(isset($request->name)){
            $alt = $obj->update($request->all());
            if($alt == 1){
                $resposta = ["msg" => "Sucesso"];
            }
            else{
                $resposta = ["error" => "Erro ao alterar Usuario."];
            }
        }
        elseif(isset($request->email) || isset($request->password)){
            if(isset($request->password)){
                $request->password = Hash::make($request->password);
            }
            $alt = $obj->user()->update($request->all());
            if($alt == 1){
                $resposta = ["msg" => "Sucesso"];
            }
            else{
                $resposta = ["error" => "Erro ao alterar Credenciais de usuario."];
            }
        }
        else{
            $resposta = ["error" => "Nenhum valor valido encontrado."];
        }

        //$request->only()

        return $resposta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $obj = Administrador::with('user')->findOrfail($id);
        $obj->user()->delete();
        $obj->delete();
    }
}
