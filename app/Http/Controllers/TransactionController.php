<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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


    ################### Ida neee mak usa ba iha Approva DO 
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
                ->paginate(10);
        return view('Transaction.approve',compact('transactions'));
    }

    public function statusedit($id)
    {

        $data = DB::table('transaction')->where('id',$id);
        $data->update([
            "statusedit" => 1
        ]);
        toastr()->success('Message','Request Successfully');
        return back();


    }

    public function approveupdate($id){

        $data = DB::table('transaction')->where('id',$id)->first();
        $id_user = $data->id_user;
         $data = DB::table('transaction')->where('id',$id)->update([
            "statusedit" => false,
            "button" => true,

        ]);
        $user = DB::table('users')->where('id',$id_user)
        ->update([
            "roleid" => 1
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
                "description"=> "User Approved Edit",
                "user_id"    => Auth::id(),
                "created_at" => now(),
            ]);

        toastr()->success('Successfuly','Message');
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
            'id_product' => 'required|integer',
            'id_client' => 'required|integer',
            'id_driver' => 'required|integer',
            'quantity' => 'required|numeric|min:0',
            'plat_number'=> 'nullable|string|max:50',
            'lo_number'  => 'nullable|numeric',
            'so_number'  => 'nullable|string|max:255',
        ]);


        $do = DB::table('transaction')->max('do_number');
        if($do==null){
            $ndo = 100;
        }else{
           $ndo =  $do+1;
        }
       

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
        DB::table('transaction')->insert([
            'do_number'      => $ndo,
            'lo_number'      => $request->lo_number,
            'so_number'      => $request->so_number,
            'product_type'   => $request->product_type ?? null,
            'id_product'     => $request->id_product,
            'id_user'        => auth()->id(),
            'status'         => false,
            "attached"         => $attachedPath,
            'product_type' => $prod->code_product."-".$prod->quality,
            'button' => false,
            'quantity'       => $request->quantity,
            'id_client'      => $request->id_client,
            'client_name'    => $client->client_name,
            'id_driver'      => $request->id_driver,
            'driver_name'    => $driver->driver_name,
            'plat_number'    => $request->plat_number,
            'created_at' => Carbon::parse($request->created_at),
            'updated_at'     => Carbon::now(),
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
        "description" => "User Add New ".$request->so_number,
        "user_id" => Auth::user()->id
        ]);
        toastr()->success('success', 'Transaction created successfully.');
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
        'plat_number'    => $request->plat_number,
        'created_at' => Carbon::parse($request->created_at),
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
