<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{
    

    public function index(){

      
        return view('Auth.login');
    }

    public function users(){
        $users= DB::table('users')->simplePaginate(3);
        return view('Auth.user',compact('users'));
    }


    public function edit($id)
    {

        $user = DB::table('users')->where('id',$id)->first();
        return view('Auth.edit',compact('user'));
    }


 public function store(Request $request)
{
    // Validasi input
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'roles' => 'required|in:administrator,manager,staff',
        'possition' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'gender' => 'nullable|in:male,female',
    ]);



    try {
        // Insert ke database
        $indata = DB::table('users')->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'roles' => $data['roles'],
            'possition' => $data['possition'] ?? null,
            'status' => true,
            'roleid' => 1,
            'phone' => $data['phone'] ?? null,
            'gender' => $data['gender'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        $agent = new Agent();
        $browser = $agent->browser();    
        $version = $agent->version($browser); 
        $os = $agent->platform();        
        $device = $agent->device();
        $hostname = gethostname();

        DB::table('user_logs')->insert([
        "hostname" => $hostname,
        "ip" => $request->ip(),
        "browser" => $browser,
        "version" => $version,
        "os" => $os,
        "device" => $device,
        "method" => request()->method(),
        "description" => "Register User ..",
        "user_id" => 16
        ]);



        // Success toastr
        toastr()->success('User created successfully!', 'Success');
        return back();

    } catch (\Exception $e) {
        
        toastr()->error('Failed to create user: ' . $e->getMessage(), 'Error');
        return back()->withInput(); // Mengembalikan input sebelumnya
    }
}


 public function update(Request $request, $id)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required',
        'password' => 'required|string|min:6',
        'roles' => 'required|in:administrator,manager,staff',
        'possition' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'gender' => 'nullable|in:male,female',
    ]);


     try {
       
        $indata = DB::table('users');
            $indata->where('id',$id)
            ->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'roles' => $data['roles'],
            'possition' => $data['possition'] ?? null,
            'status' => true,
            'roleid' => 1,
            'phone' => $data['phone'] ?? null,
            'gender' => $data['gender'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $agent = new Agent();
        $browser = $agent->browser();    
        $version = $agent->version($browser); 
        $os = $agent->platform();        
        $device = $agent->device();
        $hostname = gethostname();

        DB::table('user_logs')->insert([
        "hostname" => $hostname,
        "ip" => $request->ip(),
        "browser" => $browser,
        "version" => $version,
        "os" => $os,
        "device" => $device,
        "method" => request()->method(),
        "description" => " Update Users ..",
        "user_id" => 16
        ]);


        toastr()->success('User Update successfully!', 'Success');
        return redirect()->route('users.list');

    } catch (\Exception $e) {
        
        toastr()->error('Failed to Update user: ', 'Error');
        return back()->withInput(); 
    }



        

    }

  
    public function destroy($id)
    {
        $del= DB::table('users')->where('id',$id);
        $del->delete();
        if($del){


            $agent = new Agent();
        $browser = $agent->browser();    
        $version = $agent->version($browser); 
        $os = $agent->platform();        
        $device = $agent->device();
        $hostname = gethostname();

        DB::table('user_logs')->insert([
        "hostname" => $hostname,
        "ip" => request()->ip(),
        "browser" => $browser,
        "version" => $version,
        "os" => $os,
        "device" => $device,
        "method" => request()->method(),
        "description" => "Delete User ..",
        "user_id" => 16
        ]);


              toastr()->success('Message','Successfuly Delete User');
        }else{
            toastr()->error('Message','Error');
        }

        return back();
      
       
    }
    
    

}
