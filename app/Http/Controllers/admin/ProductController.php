<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\ModelCategories;
use App\Models\ModelProducts;
use App\Models\User;
use App\Policies\ListPolicy;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
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


        $this->authorize('view',User::class);
        $products = ModelProducts::paginate(10);

        $user = auth()->user();



        return view ('admin.products.index',['products' => $products, 'user' => $user  ]);
    }

    public function shop()
    {
       // $products = DB::table('products')->where('cate_id', '2')->paginate();

        /* $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.cate_id')
            ->where('categories.slug', '=', 'store')
            ->select('products.*')
           ->paginate('12');*/
        //dd($products);
        $products = ModelProducts::paginate(12);

        $Categories = DB::table('categories')->where('parent_catg','=', 0 )->get();

        return view ('products.index',compact('products', 'Categories') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',User::class);
        $uid = Auth::id();
        $categories = ModelCategories::all();
        $user = auth()->user();

       return view ('admin.products.create',compact('uid', 'categories' , 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
       /* $validator = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);*/

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
        $user = auth()->user();
       return view('products.show')->with('product', $product, );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $uid = Auth::id();
        $this->authorize('edit',User::class);

        $user = auth()->user();

        $categories = ModelCategories::all();
        $productSingle = ModelProducts::find($id);

        return view('admin.products.edit',  compact( 'user','productSingle','uid', 'categories') );


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
        $this->authorize('update',User::class);

        $product = ModelProducts::find($id);
        $input = $request->all();
        $product->update($input);
        return redirect(url('/admin/products') )->with('message', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',User::class);
        ModelProducts::destroy($id);
        return redirect(url('/admin/products'))->with('message', 'Product deleted!');
    }
}
