<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    

    public function index(){

        return view('Auth.login');
    }

    public function users(){

        return view('Auth.user');
    }



     public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'roles' => 'required|in:administrator,manager,staff',
            'possition' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20'
        ]);

        $indata = DB::table('users')->insert([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'roles' => $data['roles'],
                    'possition' => $data['possition'] ?? null,
                    'status' => true,
                    'phone' => $data['phone'] ?? null,
                    'gender' => $data['gender'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                toastr()->success('Message','Successfully');
                return back();
    }

    
    

}
