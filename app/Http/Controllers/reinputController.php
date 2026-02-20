<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class reinputController extends Controller
{
    



    public function index()
    {


          $transactions = DB::table('transaction as t')
            ->leftJoin('users as u', 'u.id', '=', 't.id_user')
            ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
            ->leftJoin('products as p', 'p.id', '=', 't.id_product')
            ->leftJoin('drivers as d', 'd.id', '=', 't.id_driver')
            ->select(
                't.*',
                't.id',
                'u.name as user_name',
                'c.client_name',
                't.lo_number',
                'p.product_name',
                'p.code_product',
                'p.quality',
                't.lo_number',
                'd.driver_name'
            )
            ->whereNull('t.do_number')
            ->orderByDesc('t.id')
            ->simplePaginate(10);

        // Ambil data untuk form select
        $products = DB::table('products')->get();
        $clients  = DB::table('clients')->get();
        $drivers  = DB::table('drivers')->get();
       
        return view('reinput.index', compact('transactions','products','clients','drivers'));

    }

     public function store(Request $request)
    {

         $request->validate([
            'so_number'   => 'required',
            'id_product'  => 'required|integer|exists:products,id',
            'id_client'   => 'required|integer|exists:clients,id',
            'id_driver'   => 'required|integer|exists:drivers,id',
            'quantity'    => 'required|numeric|min:0.01',
            'plat_number' => 'nullable|string|max:50',
            'lo_number'   => 'nullable|numeric',
            'attached'    => 'nullable|file|max:2048',
            'payment_references' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

    

        // 3️⃣ AMBIL DATA DRIVER, CLIENT, PRODUCT
        $driver  = DB::table('drivers')->find($request->id_driver);
        $client  = DB::table('clients')->find($request->id_client);
        $product = DB::table('products')->find($request->id_product);
        $attachedPath = $request->hasFile('attached') ? $request->file('attached')->store('transaction_files', 'public') : null;
        DB::table('transaction')->insert([
            'do_number'      => null,
            'so_number'      => $request->so_number,
            'lo_number'      => $request->lo_number,
            'id_product'     => $request->id_product,
            'id_user'        => auth()->id(),
            'id_client'      => $request->id_client,
            'status'         => true,
            'product_type'   => $product->code_product.'-'.$product->quality,
            'client_name'    => $client->client_name,
            'driver_name'    => $driver->driver_name,
            'id_driver'      => $request->id_driver,
            'plat_number'    => $request->plat_number,
            'quantity'       => $request->quantity,
            'payment_references' => $request->input('payment_references'),
            'description'    => $request->input('description'),
            'attached'       => $attachedPath,
            'created_at'     => $request->input('created_at'),
            'updated_at'     => $request->input('created_at'),
        ]);

        // 6️⃣ LOG USER ACTIVITY
        $agent = New Agent();
        DB::table('user_logs')->insert([
            'hostname'    => gethostname(),
            'ip'          => $request->ip(),
            'browser'     => $agent->browser(),
            'version'     => $agent->version($agent->browser()),
            'os'          => $agent->platform(),
            'device'      => $agent->device(),
            'method'      => $request->method(),
            'description' => "User Reinput data DO for SO: ".$request->so_number,
            'user_id'     => Auth::id(),
        ]);





         
        

       

       

       
       

        // 8️⃣ TOASTR NOTIFIKASI
        // if ($waResponse->successful()) {
            toastr()->success('Success', 'Delivery Order Created ');
        // } else {
        //     toastr()->error('Warning', 'Delivery Order Failed');
        // }

        return back();
    }


   
}
