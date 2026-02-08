<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PDF; 
use Jenssegers\Agent\Agent;


class TransactionController extends Controller
{





public function printPdf($id)
{
    // Ambil transaksi berdasarkan ID
    $transaction = DB::table('transaction as t')
        ->leftJoin('users as u', 'u.id', '=', 't.id_user')
        ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
        ->leftJoin('products as p', 'p.id', '=', 't.id_product')
        ->leftJoin('drivers as d', 'd.id', '=', 't.id_driver')
        ->select(
            't.*',
            'u.name as user_name',
            'c.client_name',
            'p.product_name',
            'p.quality as q',
            'p.code_product as cp',
            'd.driver_name',
            'c.phone',
            'c.address',
            'c.email',
            't.id as tdi'
        )
        ->where('t.id', $id)
        ->first();

    if (!$transaction) {
        abort(404, "Transaction not found.");
    }

    // Load view PDF
    $pdf = FacadePdf::loadView('Transaction.pdf', compact('transaction'));
    return $pdf->stream('transaction_'.$transaction->tdi.'.pdf'); 
}


    Public function approve(Request $request){
        $search = $request->search;

            $transactions = DB::table('transaction as t')
                ->leftJoin('users as u', 'u.id', '=', 't.id_user')
                ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
                ->leftJoin('products as p', 'p.id', '=', 't.id_product')
                ->leftJoin('drivers as d', 'd.id', '=', 't.id_driver')
                ->select(
                    't.*',
                    'u.name as user_name',
                    'c.client_name',
                    'p.product_name',
                    'd.driver_name',
                    't.id as tdi'
                )
                ->where('t.status', false)
                ->orWhere('statusedit',true)
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('t.do_number', 'like', "%$search%")
                        ->orWhere('t.so_number', 'like', "%$search%")
                        ->orWhere('c.client_name', 'like', "%$search%")
                        ->orWhere('d.driver_name', 'like', "%$search%")
                        ->orWhere('p.product_name', 'like', "%$search%");
                    });
                })
                ->orderByDesc('t.created_at')
                ->simplePaginate (10);
        return view('Transaction.approve',compact('transactions'));
    }

    public function statusedit($id)
    {

        $data = DB::table('transaction')->where('id',$id);
        $data->update([
            "statusedit" => 1
        ]);
       $user =  Auth::user();





        // Greeting
      $hour = now()->hour;
    $greeting = $hour < 12 ? '🌅 Good Morning' : ($hour < 18 ? '🌞 Good Afternoon' : '🌙 Good Evening');

        // Today date
        $date = now()->format('l, d-F-Y : h:i:s A');

        // Fetch first approved user
        $phoneData = DB::table('users')
            ->where('approved', 1)
            ->select('phone', 'name','gender')
            ->first();

        if (!$phoneData) {
            return 'No approved users found!';
        }
          $gender = $phoneData->gender === 'female' ? 'Mis.' : 'Mr.';
          $to = $phoneData->phone;

  

        $getdata = $data->first();
        $message  = "Hello, {$greeting}\n";
        $message .= "Please to: {$gender} {$phoneData->name}\n";
        $message .= "User: {$user->name}\n";
        $message .= "Request Edit Delivery Order \n";
        $message .= "Do Number : {$getdata->do_number}\n";
        $message .= "SO Number : {$getdata->so_number}\n";
        $message .= "Waiting Approval, Thanks .....!";




       


       
        // Kirim WhatsApp via WasenderAPI
        $waResponse = Http::withHeaders([
            'Authorization' => 'Bearer e43a62324de6a22dbea1badc06f6c10cccb75ef5391981761256f562b477ba41',
            'Content-Type'  => 'application/json',
        ])->post('https://wasenderapi.com/api/send-message', [
            'to'   => $to,
            'text' => $message,
        ]);


        



        toastr()->success('Message','Request Successfully');
        return back();


    }

    public function approveupdate(Request $request,$id){

         // Ambil data transaksi
        $data = DB::table('transaction')->where('id', $id)->first();
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Transaction not found'
            ]);
        }

        $id_user = $data->id_user;

        // Update transaksi
        DB::table('transaction')->where('id', $id)->update([
            'statusedit' => false,
            'button'     => true,
        ]);

        // Update user terkait
        DB::table('users')->where('id', $id_user)->update([
            'roleid' => 1
        ]);

        // Log user activity
        $agent = new Agent();
        DB::table('user_logs')->insert([
            'hostname'    => gethostname(),
            'ip'          => $request->ip(),
            'browser'     => $agent->browser(),
            'version'     => $agent->version($agent->browser()),
            'os'          => $agent->platform(),
            'device'      => $agent->device(),
            'method'      => $request->method(),
            'description' => "User Approved Edit for DO: " . $data->do_number,
            'user_id'     => Auth::id(),
            'created_at'  => now(),
        ]);

        // Format nomor telepon client
        $phone = $data->client_phone;
        if (substr($phone, 0, 1) != '+') {
            $phone = '+670' . ltrim($phone, '0');
        }

        // Greeting sesuai jam
        $hour = Carbon::now()->hour;
        $greeting = $hour < 12 ? "🌅 Great Morning" : ($hour < 18 ? "🌞 Great Afternoon" : "🌙 Great Evening");

        // Buat pesan WA
        $message = $greeting . " " . $data->client_name . "!\n";
        $message .= "Your edit for DO: " . $data->do_number . " has been approved.\n";
        $message .= "Product: " . $data->product_type . "\n";
        $message .= "Quantity: " . $data->quantity . "\n";

        // Kirim WA
        $waResponse = Http::withHeaders([
            'Authorization' => 'Bearer e43a62324de6a22dbea1badc06f6c10cccb75ef5391981761256f562b477ba41',
            'Content-Type'  => 'application/json',
        ])->post('https://api.wasenderapi.com/send-message', [
            'to'   => $phone,
            'text' => $message,
        ]);

    

        toastr()->success('message','Transaction approved successfully');
                
        return back();
    }
    




    public function approvededit($id)
{
     $transaction = DB::table('transaction')->where('id', $id)->first();

    if (!$transaction) {
        return redirect()->back()->with('error', 'Transaction not found.');
    }

    DB::table('transaction')->where('id', $id)->update([
        'approve_number' => rand(1000, 9999), // generate a 4-digit number
        'authorized_by' => auth()->user()->possition,
        "approved" => Auth::user()->name,
        'status' => true, // mark as approved
        'updated_at' => now(),
    ]);

        $agent = new Agent();
        $browser = $agent->browser();    
        $version = $agent->version($browser); 
        $os = $agent->platform();        
        $device = $agent->device();
        $hostname = gethostname();

      DB::table('user_logs')->insert([
                "hostname"   => $hostname,
                "ip"         => request()->ip(),
                "browser"    => $browser,
                "version"    => $version,
                "os"         => $os,
                "device"     => $device,
                "method"     => request()->method(),
                "description"=> "User Request to Edit DO",
                "user_id"    => Auth::id(),
                "created_at" => now(),
            ]);

    toastr()->success('success', 'Transaction Approved successfully.');
    return redirect()->back();
   
}


     
  
    // =======================
    // INDEX (LIST + SEARCH)
    // =======================
    public function index(Request $request)
    {
        $search = $request->search;

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
           ->when($search, function ($query) use ($search) {
            return $query->where('t.do_number', 'like', "%$search%")
                 ->orWhere('t.so_number', 'like', "%$search%")
                 ->orWhere('c.client_name', 'like', "%$search%")
                 ->orWhere('d.driver_name', 'like', "%$search%")
                 ->orWhere('t.lo_number','like',"$search%")
                 ->orWhere('p.product_name', 'like', "%$search%");
            })

            ->orderByDesc('t.id')
            ->simplePaginate(10);

        // Ambil data untuk form select
        $products = DB::table('products')->get();
        $clients  = DB::table('clients')->get();
        $drivers  = DB::table('drivers')->get();
        $do = DB::table('transaction')->max('do_number');
        $ndo = $do +1;

        return view('Transaction.index', compact('transactions','search','products','clients','drivers','ndo'));
    }


    

    // =======================
    // STORE TRANSACTION
    // =======================
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

        // 2️⃣ GENERATE DO NUMBER
        $maxDO = DB::table('transaction')->max('do_number');
        $ndo = $maxDO ? $maxDO + 1 : 100;

        // 3️⃣ AMBIL DATA DRIVER, CLIENT, PRODUCT
        $driver  = DB::table('drivers')->find($request->id_driver);
        $client  = DB::table('clients')->find($request->id_client);
        $product = DB::table('products')->find($request->id_product);

        // 4️⃣ HANDLE ATTACHMENT
        $attachedPath = $request->hasFile('attached') ? $request->file('attached')->store('transaction_files', 'public') : null;

        // 5️⃣ INSERT DELIVERY ORDER
        DB::table('transaction')->insert([
            'do_number'      => $ndo,
            'so_number'      => $request->so_number,
            'lo_number'      => $request->lo_number,
            'id_product'     => $request->id_product,
            'id_user'        => auth()->id(),
            'id_client'      => $request->id_client,
            'status'         => false,
            'product_type'   => $product->code_product.'-'.$product->quality,
            'client_name'    => $client->client_name,
            'driver_name'    => $driver->driver_name,
            'id_driver'      => $request->id_driver,
            'plat_number'    => $request->plat_number,
            'quantity'       => $request->quantity,
            'payment_references' => $request->input('payment_references'),
            'description'    => $request->input('description'),
            'attached'       => $attachedPath,
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
        ]);

        // 6️⃣ LOG USER ACTIVITY
        $agent = new Agent();
        DB::table('user_logs')->insert([
            'hostname'    => gethostname(),
            'ip'          => $request->ip(),
            'browser'     => $agent->browser(),
            'version'     => $agent->version($agent->browser()),
            'os'          => $agent->platform(),
            'device'      => $agent->device(),
            'method'      => $request->method(),
            'description' => "User added DO for SO: ".$request->so_number,
            'user_id'     => Auth::id(),
        ]);


        ###########################

        // Greeting
      $hour = now()->hour;
    $greeting = $hour < 12 ? '🌅 Good Morning' : ($hour < 18 ? '🌞 Good Afternoon' : '🌙 Good Evening');

        // Today date
        $date = now()->format('l, d-F-Y : h:i:s A');

        // Fetch first approved user
        $phoneData = DB::table('users')
            ->where('approved', 1)
            ->select('phone', 'name','gender')
            ->first();

        if (!$phoneData) {
            return 'No approved users found!';
        }
          $gender = $phoneData->gender === 'female' ? 'Mis.' : 'Mr.';
          $to = $phoneData->phone;

  

        $message  = "Hello, {$greeting}\n";
        $message .= "Please to: {$gender} {$phoneData->name}\n";
        $message .= "Ship to: {$client->client_name}\n";
        $message .= "SO Number: {$request->so_number}\n";
        $message .= "Product: {$product->code_product}-{$product->quality}\n";
        $message .= "Quantity: " . format_liter($request->quantity) . "\n";
        $message .= "Driver: {$driver->driver_name}\n";
        $message .= "Plat Number: {$request->plat_number}\n";
        $message .= "Waiting Approval\n";


       
        // Kirim WhatsApp via WasenderAPI
        $waResponse = Http::withHeaders([
            'Authorization' => 'Bearer e43a62324de6a22dbea1badc06f6c10cccb75ef5391981761256f562b477ba41',
            'Content-Type'  => 'application/json',
        ])->post('https://wasenderapi.com/api/send-message', [
            'to'   => $to,
            'text' => $message,
        ]);



        // 8️⃣ TOASTR NOTIFIKASI
        // if ($waResponse->successful()) {
            toastr()->success('Success', 'Delivery Order Created ');
        // } else {
        //     toastr()->error('Warning', 'Delivery Order Failed');
        // }

        return back();
    }
    

    // =======================
    // EDIT TRANSACTION
    // =======================
    public function edit($id)
    {
        $transaction = DB::table('transaction')->where('id', $id)->first();
        $products = DB::table('products')->get();
        $clients  = DB::table('clients')->get();
        $drivers  = DB::table('drivers')->get();

        return view('Transaction.edit', compact('transaction','products','clients','drivers'));
    }

    // =======================
    // UPDATE TRANSACTION
    // =======================
    public function update(Request $request, $id)
    {
          // Validasi input
    $request->validate([
        'id_product' => 'required|integer',
        'id_client'  => 'required|integer',
        'id_driver'  => 'required|integer',
        'quantity'   => 'required|numeric|min:0',
        'lo_number'  => 'nullable|numeric',
        'so_number'  => 'nullable|string|max:255',
        'plat_number'=> 'nullable|string|max:50',
        'product_type'=> 'nullable|string|max:255',
        'status'     => 'nullable|boolean',
    ]);

    // Ambil transaksi
    $transaction = DB::table('transaction')->where('id', $id)->first();
    if (!$transaction) {
        return back()->withErrors('Transaction not found');
    }

    // Ambil driver & client
    $driver = DB::table('drivers')->find($request->id_driver);
    $client = DB::table('clients')->find($request->id_client);
      $prod = DB::table('products')->where('id',$request->id_product)->first();

    if (!$driver || !$client) {
        return back()->withErrors('Driver or Client not found');
    }
 $attachedPath = null;
        if ($request->hasFile('attached')) {
            $attachedPath = $request->file('attached')
                ->store('transaction_files', 'public');
        }
    // Update transaksi
    DB::table('transaction')->where('id', $id)->update([
        'lo_number'      => $request->lo_number,
        'so_number'      => $request->so_number,
        'product_type'   => $request->product_type ?? null,
        'id_product'     => $request->id_product,
        'id_user'        => auth()->id(),
        'status'         => false,
        'button'         => false,
        'attached' => $attachedPath,
        'product_type' => $prod->code_product."-".$prod->quality,
        'quantity'       => $request->quantity,
        'id_client'      => $request->id_client,
        'client_name'    => $client->client_name,
        'id_driver'      => $request->id_driver,
        'driver_name'    => $driver->driver_name,
        'payment_references' =>  $request->input('payment_references'),
        'description' => $request->input('description'),
        'plat_number'    => $request->plat_number,
        'created_at' => Carbon::parse($request->created_at)->setTimeFrom(Carbon::now()),
        'updated_at' => Carbon::parse($request->created_at)->setTimeFrom(Carbon::now()),
    
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
        "description" => "User Update New ".$request->so_number,
        "user_id" => Auth::user()->id
        ]);

        toastr()->success('success', 'Transaction updated successfully.');
        return redirect()->route('transaction.index');
    }

    // =======================
    // DELETE TRANSACTION
    // =======================
    public function destroy($id)
    {
            $transaction = DB::table('transaction')->where('id', $id)->first();

            if (!$transaction) {
                toastr()->error('Error', 'Transaction not found!');
                return back();
            }

            // Hapus data
            DB::table('transaction')->where('id', $id)->delete();

            // Agent info
            $agent   = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $os      = $agent->platform();
            $device  = $agent->device();
            $hostname = gethostname();

            // Insert log
            DB::table('user_logs')->insert([
                "hostname"   => $hostname,
                "ip"         => request()->ip(),
                "browser"    => $browser,
                "version"    => $version,
                "os"         => $os,
                "device"     => $device,
                "method"     => request()->method(),
                "description"=> "User deleted DO " . $transaction->do_number,
                "user_id"    => Auth::id(),
                "created_at" => now(),
            ]);

            toastr()->success('Success', 'Transaction deleted successfully.');
            return back();
        }
}
