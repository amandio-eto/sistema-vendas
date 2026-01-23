<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
  
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
                'p.product_type',
                'd.driver_name'
            )
            ->when($search, function ($query) use ($search) {
                $query->where('t.do_number', 'like', "%$search%")
                      ->orWhere('t.so_number', 'like', "%$search%")
                      ->orWhere('c.client_name', 'like', "%$search%")
                      ->orWhere('d.driver_name', 'like', "%$search%")
                      ->orWhere('p.product_type', 'like', "%$search%");
            })
            ->orderByDesc('t.created_at')
            ->paginate(10);

        // Ambil data untuk form select
        $products = DB::table('products')->get();
        $clients  = DB::table('clients')->get();
        $drivers  = DB::table('drivers')->get();

        return view('Transaction.index', compact('transactions','search','products','clients','drivers'));
    }

    // =======================
    // STORE TRANSACTION
    // =======================
    public function store(Request $request)
    {
        $request->validate([
            'do_number' => 'required|unique:transaction,do_number',
            'id_product' => 'required|integer',
            'id_client' => 'required|integer',
            'id_driver' => 'required|integer',
            'quantity' => 'required|numeric|min:0',
        ]);

        DB::table('transaction')->insert([
            'do_number'      => $request->do_number,
            'lo_number'      => $request->lo_number,
            'so_number'      => $request->so_number,
            'product_type'   => $request->product_type ?? null,
            'id_product'     => $request->id_product,
            'authorized_by'  => $request->authorized_by,
            'id_user'        => auth()->id(),
            'status'         => $request->status ?? 0,
            'quantity'       => $request->quantity,
            'id_client'      => $request->id_client,
            'client_name'    => $request->client_name ?? null,
            'id_driver'      => $request->id_driver,
            'driver_name'    => $request->driver_name ?? null,
            'plat_number'    => $request->plat_number,
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Transaction created successfully.');
    }

    // =======================
    // EDIT TRANSACTION
    // =======================
    public function edit($id)
    {
        $tx = DB::table('transaction')->where('id', $id)->first();
        $products = DB::table('products')->get();
        $clients  = DB::table('clients')->get();
        $drivers  = DB::table('drivers')->get();

        return view('transactions.edit', compact('tx','products','clients','drivers'));
    }

    // =======================
    // UPDATE TRANSACTION
    // =======================
    public function update(Request $request, $id)
    {
        $request->validate([
            'do_number' => 'required|unique:transaction,do_number,'.$id,
            'id_product' => 'required|integer',
            'id_client' => 'required|integer',
            'id_driver' => 'required|integer',
            'quantity' => 'required|numeric|min:0',
        ]);

        DB::table('transaction')->where('id', $id)->update([
            'do_number'      => $request->do_number,
            'lo_number'      => $request->lo_number,
            'so_number'      => $request->so_number,
            'product_type'   => $request->product_type ?? null,
            'id_product'     => $request->id_product,
            'authorized_by'  => $request->authorized_by,
            'id_user'        => auth()->id(),
            'status'         => $request->status ?? 0,
            'quantity'       => $request->quantity,
            'id_client'      => $request->id_client,
            'client_name'    => $request->client_name ?? null,
            'id_driver'      => $request->id_driver,
            'driver_name'    => $request->driver_name ?? null,
            'plat_number'    => $request->plat_number,
            'updated_at'     => Carbon::now(),
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaction updated successfully.');
    }

    // =======================
    // DELETE TRANSACTION
    // =======================
    public function destroy($id)
    {
        DB::table('transaction')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Transaction deleted successfully.');
    }
}
