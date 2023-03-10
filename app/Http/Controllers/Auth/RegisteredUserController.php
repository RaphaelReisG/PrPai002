<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
/*
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->givePermissionTo('cliente');
*/
        $cliente = Vendedor::findOrfail(1)->clientes()->create(['name' => $request->name , 'company_name' => $request->company_name,'cnpj' => $request->cnpj]);
        $cliente->user()->create(['email'=> $request->email, 'password'=>Hash::make($request->password)])->givePermissionTo('cliente');
        error_log("id user é: ");
        error_log($cliente->user->id);
        $user = User::find($cliente->user->id);
/*
        $user = User::create([
            'email' => 'raphaelhoje@clienteraphael.com',
            'password' => Hash::make('qwerasdf'),
            'userable_type' => ''
        ])->userable()->givePermissionTo('cliente');
*/
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
