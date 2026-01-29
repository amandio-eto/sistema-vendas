<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
      public function index()
    {
        $drivers = DB::table('drivers')
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->simplePaginate(10);
        return view('Drivers.index', compact('drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_name' => 'required|string|max:255',
            'phone'       => 'required|string|max:255',
        ]);

        DB::table('drivers')->insert([
            'driver_name' => $request->driver_name,
            'phone'       => $request->phone,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        toastr()->success('success', 'Driver created successfully');

        return back();
    }

    public function edit($id)
    {
        $driver = DB::table('drivers')
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();

        if (!$driver) {
            abort(404);
        }

        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'driver_name' => 'required|string|max:255',
            'phone'       => 'required|string|max:255',
        ]);

        DB::table('drivers')
            ->where('id', $id)
            ->update([
                'driver_name' => $request->driver_name,
                'phone'       => $request->phone,
                'updated_at'  => now(),
            ]);

            toastr()->success('Success', 'Driver updated successfully');
        return back(); 
    }

    public function destroy($id)
    {
        DB::table('drivers')
            ->where('id', $id)
            ->update([
                'deleted_at' => now(),
            ]);

             toastr()->success('Success', ' Successfully Deleted');
       return back();
    }
}
