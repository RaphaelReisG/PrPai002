<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use App\Http\Requests\AdministradorRequest;

use App\Http\Resources\TesteResource;

use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{

    public function index(Request $request)
    {
        $administrador = Administrador::with(['user'])
            ->join('users', 'administradors.id', '=', 'users.userable_id' )
            ->select('administradors.*')
            ->groupBy('administradors.id', 'administradors.name', 'administradors.created_at', 'administradors.updated_at');

        if ($request->has('buscarObjeto')) {
            $administrador->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('users.email', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('ordenacaoBusca')) {
            $administrador->orderBy($request->ordenacaoBusca);
        }

        if ($request->has('paginacao')) {
            return $administrador->get();
            error_log('passou aki');
        }

        return $administrador->paginate(4);
/*
        if(isset($request->buscarObjeto)){
            if(isset($request->ordenacaoBusca)){
                error_log("com busca com ordenacao  ".$request->buscarObjeto);
                return Administrador::with(['user'])
                    //->orderBy($request->ordenacaoBusca)
                    ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                    ->join('users', 'administradors.id', '=', 'users.userable_id' )
                    ->select('administradors.*')
                    ->groupBy('administradors.id', 'administradors.name', 'administradors.created_at', 'administradors.updated_at')
                    ->orderBy($request->ordenacaoBusca)
                    ->paginate(4);
            }
            else{
                error_log("com busca sem ordenacao".$request->buscarObjeto);
                return Administrador::with(['user'])
                    ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                    ->paginate(4);
            }
        }
        else{
            if(isset($request->ordenacaoBusca)){
                error_log("sem busca com ordenacao");
                return Administrador::with(['user'])
                    ->join('users', 'administradors.id', '=', 'users.userable_id' )
                    ->select('administradors.*')
                    ->groupBy('administradors.id', 'administradors.name', 'administradors.created_at', 'administradors.updated_at')
                    ->orderBy($request->ordenacaoBusca)
                    ->paginate(4);
            }
            else{
                error_log("sem busca sem ordenacao");
                return Administrador::with(['user'])->paginate(4);
                //return Cliente::with('user')->paginate(10);
            }
        }*/
    }


    public function create()
    {
        //
    }


    public function store(AdministradorRequest $request)
    {

        $administrador = Administrador::create($request->only('name'));
        $administrador->user()->create(['email'=> $request->email, 'password'=>Hash::make($request->password)])->givePermissionTo('admin');

        return $administrador;
    }


    public function show(Administrador $administrador)
    {
        return new TesteResource($administrador, $administrador->user);
    }

    public function edit(Administrador $administrador)
    {
        //
    }

    public function update(AdministradorRequest $request, Administrador $administrador)
    {
        $administrador->update($request->only('name'));
        if(isset($request->password)){
            $request->password = Hash::make($request->password);
        }

        $administrador->user()->update($request->only('email', 'password'));

        return new TesteResource($administrador, $administrador->user);
    }

    public function destroy(Administrador $administrador)
    {
        //$obj = Administrador::with('user')->findOrfail($id);
        $administrador->user()->delete();
        $administrador->delete();

        return new TesteResource($administrador);
    }
}
