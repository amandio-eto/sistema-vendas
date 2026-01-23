<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\UpdateclientRequest;
use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clients= DB::table('clients')
                    ->orderByDesc('id')
                    ->simplePaginate(3);
        return view('Clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

public function create(Request $request)
{
    $validated = $request->validate([
        'client_name' => 'required|string|max:255',
        'client_id'   => 'required|string|unique:clients,client_id',
        'email'       => 'required|email|unique:clients,email',
        'phone'       => 'required|string|max:20',
        'address'     => 'nullable|string|max:255',
    ]);

    try {
        DB::table('clients')->insert($validated);

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
        "description" => "User Register Client",
        "user_id" => Auth::user()->id
        ]);
        toastr()->success('Message','Successfully');


        


        return back();

    } catch (\Exception $e) {
        toastr()->error('Message',$e->getMessage());
        return back();
           
    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreclientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreclientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = DB::table('clients')->where('id',$id)->first();
    if (!$client) {
        toastr()->error('Client not found');
        return back();
    }

    return view('Clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateclientRequest  $request
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'client_name' => 'required|string|max:255',
        'email'       => 'required|email|max:255',
        'phone'       => 'nullable|string|max:20',
        'address'     => 'nullable|string|max:255',
    ]);

    try {
        DB::table('clients')
            ->where('id', $id)
            ->update([
                'client_name' => $request->client_name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'address'     => $request->address,
                'updated_at'  => now(),
            ]);


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
        "description" => "User Update Client",
        "user_id" => Auth::user()->id
        ]);


            


    
        toastr()->success('Client updated successfully');
        return redirect()->route('client.index');

    } catch (\Exception $e) {

        toastr()->error('Failed to update client');
        return back()->withInput();
    }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       try {
        $deleted = DB::table('clients')
            ->where('id', $id)
            ->delete();

        if ($deleted) {


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
        "description" => "User Delete Client",
        "user_id" => Auth::user()->id
        ]);



            toastr()->success('Client deleted successfully');
        } else {
            toastr()->warning('Client not found');
        }

    } catch (\Exception $e) {
        toastr()->error('Failed to delete client');
    }
    return back();
    }



}
