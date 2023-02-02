<?php

namespace App\Http\Controllers;

use App\Models\ModelProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class
HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $saleproducts = DB::table('products')->where('sale','=', 'yes' )->get();
        $latest = DB::table('products')->orderByDesc('id')->limit(5)->get();

        return view('home', compact('saleproducts','latest') );
    }
}
