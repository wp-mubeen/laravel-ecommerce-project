<?php

namespace App\Http\Controllers\admin;

use App\helpers\Custom;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\ModelCategories;
use App\Models\ModelComments;
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
        $products = ModelProducts::orderBy('id','desc')->paginate(10);

        $user = auth()->user();


        return view ('admin.products.index',['products' => $products, 'user' => $user  ]);
    }

    public function GetProductsByCategory(Request $request, $slug){
        $perpage = $request['per-page'];
        if(empty($perpage)){
            $perpage = 12;
        }
        $allproducts = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.cate_id')
            ->where('categories.slug','=', $slug )
            ->where('products.status', '=', '1')
            ->select('products.*')
            ->orderBy('products.id', 'desc')
            ->paginate($perpage);

        $Categories = DB::table('categories')->where('parent_catg','=', 0 )->get();

        return view ('products.category.products-category',['products' => $allproducts , 'Categories' => $Categories , 'productcategory' => $slug ]);

    }


    public function cart(){
        return view('cart');
    }
    public function AddToCart($id){
        $product = ModelProducts::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');
        $uid = Auth::id();


        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "name" => $product->name,
                    "product_id" => $product->id,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->photo
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);


            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "product_id" => $product->id,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->image
        ];

        session()->put('cart', $cart);

        // commit code and deleted migration file but can be used in future if need.
       /* $data = [
            "user_id" => $uid,
            "prod_id" => $product->id,
            "quantity" => $cart[$id]['quantity']++,
        ];
        CartModel::create($data);*/

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function UpdateCart(Request $request)
    {

        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function RemovedFromCart(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function updatestatus(Request $request){
        //dd($request);
        if(isset($request['submit_action'])){
            $status = $request['status'];
            $id = $request['product_id'];

            $product = ModelProducts::find($id);

            $data = [
                'status' => $status,
            ];

            $product->update($data);
            return redirect(url('/admin/products'))->with('message', 'Comment Updated!');
        }
    }

    public function ListComments(){
        $this->authorize('view',User::class);

        $comments = ModelComments::paginate(10);
        $user = auth()->user();

        return view('admin.comments.index',['comments'=> $comments, 'user' => $user ]);

    }

    public function updateComment(Request $request){
        $this->authorize('update',User::class);

        if(isset($request['action'])){
            $status = $request['action'];
            $id = $request['comment_id'];

            $comment = ModelComments::find($id);

            $data = [
                'status' => $status,
            ];

            $comment->update($data);
            return redirect(url('/admin/all-comments'))->with('message', 'Comment Updated!');
        }elseif( isset($request['delete']) ){
            $id = $request['comment_id'];
            ModelComments::destroy($id);
            return redirect(url('/admin/all-comments'))->with('message', 'Comment deleted!');
        }
    }

    public function PostComments(Request $request){
         $validator = $request->validate([
           'name' => 'required',
           'email' => 'required',
           'comment' => 'required',
        ]);

        $uid = Auth::id();
        if(empty($uid)){
            $uid = 0;
        }
        $request->request->add(['user_id' => $uid ]);

        $input = $request->all();

        $data = [
            'rating'=> $request['rating'],
            'name'=> $request['name'],
            'email'=> $request['email'],
            'product_id'=> $request['product_id'],
            'user_id'=> $uid,
            'comment'=> $request['comment'],
            'status'=> '0',
        ];
        ModelComments::create($data);


        return back()->with('success','Reviews Added Successfully!');
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
        if(isset($request['selling_price'])){
            $validator = $request->validate([
                'price' => ['required','numeric','gt:selling_price'],
            ]);
        }
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

            $urlfile = url($location.'/'.$filename);
            $request->request->add(['image' => $urlfile]);

        }

        $ptitle = str_replace(' ', '-', $request['name']);
        // convert the string to all lowercase
        $p_slug = strtolower($ptitle);


        $request->request->add(['slug' => $p_slug ]);

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
    public function show($slug)
    {

        $product = ModelProducts::where('slug',$slug)->first();
        if($product) {
            $related = ModelProducts::where('cate_id', $product->cate_id);

            $comments = ModelComments::where('product_id', $product->id)
                ->where('status', "1")->get();

            if ($comments) {
                $TotalComment = count($comments);
            } else {
                $TotalComment = 0;
            }


            $user = auth()->user();
            return view('products.show', compact('product', 'TotalComment', 'related'));
        }

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

        if($request->file('product_img')) {
            $file = $request->file('product_img');
            $filename = time().'_'.$file->getClientOriginalName();

            // File upload location
            $location = 'uploads/products';

            // Upload file
            $fileobject = $file->move($location,$filename);


            $fileUrl = $fileobject->getLinkTarget();

            $urlfile = url($location.'/'.$filename);
            $request->request->add(['image' => $urlfile]);

        }

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
