<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\UpdateclientRequest;
use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function edit(client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateclientRequest  $request
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateclientRequest $request, client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(client $client)
    {
        //
    }
}
