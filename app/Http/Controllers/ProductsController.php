<?php

namespace App\Http\Controllers;


use App\Models\ModelCategories;
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

        return view ('admin.products.index',compact('products' ));
    }

    public function shop()
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
        $uid = Auth::id();
        $categories = ModelCategories::all();

       return view ('admin.products.create',compact('uid', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->file('product_img')) {
            $file = $request->file('product_img');
            $filename = time().'_'.$file->getClientOriginalName();

            // File upload location
            $location = 'uploads/products';

            // Upload file
            $fileobject = $file->move($location,$filename);


            $fileUrl = $fileobject->getLinkTarget();

        }else{
            $fileUrl = '';
        }

        $request->request->add(['image' => $location.'/'.$filename]);

        $input = $request->all();


        ModelProducts::create($input);

        return back()->with('success','Product added successfully!');
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
    public function edit( $id )
    {
       // dd($ModelProducts);
        //$product = ModelProducts::find($id);
      //  return view('products.edit')->with('product', $product);
        $uid = Auth::id();
        $categories = ModelCategories::all();
        $productSingle = ModelProducts::find($id);

        return view('admin.products.edit',  compact( 'productSingle','uid', 'categories') );


        return view ('admin.products.edit',compact('uid', 'categories'));
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
        return redirect('products')->with('flash_message', 'Product Updated!');
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
        return redirect('products')->with('flash_message', 'Product deleted!');
    }
}
