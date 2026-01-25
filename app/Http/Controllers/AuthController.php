<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{

    #Ida nee mak Photo
    public function image(){
        return view('Auth.photo');
    }
    public function updatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $user = Auth::user();

    if($request->hasFile('photo')) {
    $path = $request->file('photo')->store('profile_photos', 'public');

    $user = Auth::user();
    $user->photo = $path;
    $user->save();
}
    toastr()->success('success', 'Profile photo updated successfully!');
    return back();
}
    #Ida nee mak Rohan Husi Photo

    #Ida nee ProfileController
     public function profileedit()
    {
        return view('Auth.auth'); // pastikan nama file blade sama
    }


      public function profileupdate(Request $request)
    {
        $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        toastr()->error('error', 'Current password is incorrect.');
        return back();
    }

    // Update password via model
    $user->password = Hash::make($request->password);
    $user->save();

    toastr()->success('Password updated successfully!');
    return back();
    }

    #End ProfileController


    public function dologin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            toastr()->success('Successfully','Message');
            return redirect()->intended('/dashboard');
        }


        toastr()->error('Error','Login Failed');
        return back();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toastr()->success('Sucessfully Logout','Message');
        return redirect('/login');
    }
    

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
        "user_id" => Auth::user()->id
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
        "user_id" => Auth::user()->id
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
        "user_id" => Auth::user()->id
        ]);


              toastr()->success('Message','Successfuly Delete User');
        }else{
            toastr()->error('Message','Error');
        }

        return back();
      
       
    }
    
    

}
