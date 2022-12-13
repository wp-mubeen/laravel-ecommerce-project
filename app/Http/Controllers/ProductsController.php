<?php

namespace App\Http\Controllers;

use File;
use App\Models\ModelProducts;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ModelProducts::all();
        return view ('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();

        return view ('products.create')->with('uid', $userId);
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
            'name' => 'required',
            'price' => 'required',
        ]);

        $userId = Auth::id();
        $input = $request->all();

        //dd($input);
        ModelProducts::create($input);
        return redirect('products')->with('flash_message', 'Product Addedd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = ModelProducts::find($id);
      // dd($product);
       return view('products.show')->with('product', $product);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( ModelProducts $ModelProducts)
    {
       // dd($ModelProducts);
        //$product = ModelProducts::find($id);
      //  return view('products.edit')->with('product', $product);
        return view('products.edit', ['product' => $ModelProducts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = ModelProducts::find($id);
        $input = $request->all();
        $product->update($input);
        return redirect('products')->with('flash_message', 'student Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ModelProducts::destroy($id);
        return redirect('products')->with('flash_message', 'Student deleted!');
    }
}
