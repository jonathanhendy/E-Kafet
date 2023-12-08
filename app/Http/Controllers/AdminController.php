<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Saldo;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home(){
        $user = User::where('isPenjual', true)->get();
        return view("contents.admin.home", compact('user'));
    }
    //

        public function createPenjual(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isPenjual'=>true,
            'isPembeli'=>false,
            'isAdmin'=>false
        ]);

        $saldo = Saldo::create([
            'user_id'=> $user->id,
            'saldo' => 0
        ]);
        return redirect()->back();
    }
}
