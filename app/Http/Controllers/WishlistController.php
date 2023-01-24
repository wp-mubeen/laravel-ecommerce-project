<?php

namespace App\Http\Controllers;

use App\Models\ModelProducts;
use App\Models\WishlistModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user = auth()->user();
        $wishlist = WishlistModel::where('user_id',Auth::user()->id )->get();
        return view('products.wishlist.wishlist', compact('wishlist'));

    }

    public function RemovedFromWishlist(Request $request)
    {

        if($request->id) {

            $res = WishlistModel::where('product_id',$request->id)->delete();

            return back()->with('success','Product removed successfully!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {

        if(Auth::check()){
            $productId = $request->input('pid');
            if(ModelProducts::find($productId)){
                $productExist = WishlistModel::where('product_id', $productId)->get()->toArray();

                if($productExist){
                    return response()->json(['msg' => 'Product already exist in Wishlist']);

                }else{
                    $wish = New WishlistModel();
                    $wish->product_id = $productId;
                    $wish->user_id = Auth::id();
                    $wish->save();

                    return response()->json(['msg' => 'Product Added to Wishlist']);
                }

            }else{
                return response()->json(['msg' => 'Product does not exist']);
            }
        }
        else{
            return response()->json(['msg' => 'Login to Continue']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
