<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = DB::table('products')->orderByDesc('id')
                                    ->simplePaginate(3);
        return view('Products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'code_product' => 'required|string|max:255',
        'product_name' => 'required|string|max:255',
        'quality'      => 'required|string|max:255',
    ]);

    try {
        DB::table('products')->insert([
            'code_product' => $request->code_product,
            'product_name' => $request->product_name,
            'quality'      => $request->quality,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        toastr()->success('Product berhasil disimpan');

        return back();

    } catch (\Exception $e) {

        toastr()->error('Product gagal disimpan');

        return back();
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
{
    $product = DB::table('products')->where('id', $id)->first();

    if (!$product) {
        toastr()->error('Product not found');
        return back();
    }
    return view('Products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'quality'      => 'required|string|max:255',
    ]);

    try {
        DB::table('products')
            ->where('id', $id)
            ->update([
                'product_name' => $request->product_name,
                'quality'      => $request->quality,
                'updated_at'   => now(),
            ]);

        toastr()->success('Product updated successfully');
        return redirect()->route('product.index');

    } catch (\Exception $e) {

        toastr()->error('Failed to update product');
        return back()->withInput();
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function destroy($id)
{
    try {
        $deleted = DB::table('products')
            ->where('id', $id)
            ->delete();

        if ($deleted) {
            toastr()->success('Product deleted successfully');
        } else {
            toastr()->warning('Product not found');
        }

    } catch (\Exception $e) {
        toastr()->error('Failed to delete product');
    }

    return back();
}
}
