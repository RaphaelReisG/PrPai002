<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

use App\Http\Resources\TesteResource;

use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{

    public function index(Request $request)
    {
       /* if(isset($request->buscarObjeto)){
            error_log("com busca ".$request->buscarObjeto);
            return Administrador::with(['user'])
                ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                ->paginate(1);
        }
        else{

            return Administrador::with('user')->paginate(10);

            /*$administrador = Administrador::all();
            return TesteResource::collection($administrador);
        }*/

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
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //Administrador::create($request->all());
        /*$create = Administrador::create([ 'name' => $request->name])
                ->user()->create(['email'=> $request->email, 'password'=>Hash::make($request->password) ])
                ->givePermissionTo('admin');*/
/*
        $request->password = Hash::make($request->password);

        $administrador = Administrador::create($request->only('name'));
        $user = $administrador->user()->create($request->only('email', 'password'))
                ->givePermissionTo('admin');
        return new TesteResource($administrador, $administrador->user);
*/

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

    public function update(Request $request, Administrador $administrador)
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

    public function buscando(Request $request)
    {
        error_log("passou aki na busca");
        if(isset($request->buscarObjeto)){
            error_log("com busca ".$request->buscarObjeto);
            return Administrador::with(['user'])
                ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                ->paginate(1);
        }
        else{
            error_log("deu ruim");
        }
    }
}
