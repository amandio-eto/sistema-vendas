<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TankController extends Controller
{

    public function toggleActive($id)
{
    $tank = DB::table('tanks')->where('id', $id)->first();

    if (!$tank) {
        return back()->withErrors('Tank not found');
    }

    DB::table('tanks')
        ->where('id', $id)
        ->update([
            'active' => !$tank->active
        ]);

    toastr()->success('success', 'Tank status updated');
    return back();
}




public function index()
{
$tanks = DB::table('tanks as t')
->join('products as p', 'p.id', '=', 't.product_id')
->select('t.*', 'p.product_name')
->orderBy('t.id', 'DESC')
->get();


return view('tank.index', compact('tanks'));
}


public function create()
{
$products = DB::table('products')->get();
return view('tank.create', compact('products'));
}


public function store(Request $request)
{
$request->validate([
'tank_name' => 'required',
'capacity_tank' => 'required|numeric',
'product_id' => 'required'
]);


DB::table('tanks')->insert([
'tank_name' => $request->tank_name,
'capacity_tank' => $request->capacity_tank,
'current_stock' => 0,
'product_id' => $request->product_id,
'status' => 'active'
]);


toastr()->success('success','Tank created successfully');
return redirect()->route('tank.index');
}


public function edit($id)
{
$tank = DB::table('tanks')->where('id',$id)->first();
$products = DB::table('products')->get();


return view('tank.edit', compact('tank','products'));
}


public function update(Request $request, $id)
{
$request->validate([
'tank_name' => 'required',
'capacity_tank' => 'required|numeric',
'product_id' => 'required'
]);


DB::table('tanks')->where('id',$id)->update([
'tank_name' => $request->tank_name,
'capacity_tank' => $request->capacity_tank,
'product_id' => $request->product_id,
'status' => $request->status
]);

toastr()->success('Success','Tank updated successfully');
return redirect()->route('tanks.index');
}


public function destroy($id)
{
DB::table('tanks')->where('id',$id)->delete();
toastr()->success('success','Tank deleted successfully');
return redirect()->route('tank.index');
}



   public function stockcreate($id)
    {
        $tank = DB::table('tanks')->where('id',$id)->first();
        return view('tank.stock-update', compact('tank'));
    }

   public function stockForm($id)
    {
        // Ambil tank + nama product
        $tank = DB::table('tanks as t')
            ->join('products as p', 't.product_id', '=', 'p.id')
            ->select('t.*','p.product_name')
            ->where('t.id',$id)
            ->first();

        if(!$tank){
            return redirect()->route('tank.index')->withErrors('Tank not found');
        }

        // Ambil history stock
        $records = DB::table('tank_stock_records')
            ->where('tank_id', $id)
            ->orderBy('created_at','desc')
            ->get();

        // Kirim kedua variabel ke view
        return view('tank.stock-update', compact('tank','records'));
    }

    // Proses update stock
    public function stockstore(Request $request, $id)
    {
      $request->validate([
        'quantity' => 'required|numeric|min:0.01',
        'note' => 'nullable|string',
    ]);

    DB::transaction(function () use ($request, $id) {

        // Ambil tank
        $tank = DB::table('tanks')->where('id', $id)->first();

        if (!$tank) {
            throw new \Exception('Tank not found.');
        }

        $before = $tank->current_stock;
        $after = $before + $request->quantity; // type IN → tambah stock

        // Update stock tank
        DB::table('tanks')->where('id', $id)->update([
            'current_stock' => $after
        ]);

        // Simpan history
        DB::table('tank_stock_records')->insert([
            'tank_id' => $id,
            'type' => 'IN',
            'quantity' => $request->quantity,
            'stock_before' => $before,
            'stock_after' => $after,
            'note' => $request->note,
            'created_at' => now()
        ]);
    });

    toastr()->success('success', 'Tank status updated');
    return back();
    }

    public function history()
    {
        $records = DB::table('tank_stock_records as r')
            ->join('tanks as t','r.tank_id','=','t.id')
            ->join('products as p','t.product_id','=','p.id')
            ->select('r.*','t.tank_name','p.product_name')
            ->orderBy('r.created_at','desc')
            ->simplePaginate(13);

        return view('tank.stock-history', compact('records'));
    }

}