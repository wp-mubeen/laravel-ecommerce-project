<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ModelProducts;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class APIProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ModelProducts::all();

        $response = [
            'success' => true,
            'data'    => $products,
            'message' => 'Products retrieved successfully.',
        ];


        return response()->json($response, 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return response()->json($request, 404);
        

        if ( empty($request['name']) || empty($request['price']) || empty($request['qty']) || empty($request['description']) ) {
            return response()->json('Fields required', 400);
        }

        $ptitle = str_replace(' ', '-', $request['name']);
        // convert the string to all lowercase
        $p_slug = strtolower($ptitle);

        $request->request->add(['image' => '/']);
        $request->request->add(['slug' => $p_slug ]);
        $request->request->add(['status' => 1 ]);

       $input = $request->all();

        //return response()->json($input, 200);
        $product = ModelProducts::create($input);

        $response = [
            'success' => true,
            'data'    => $product,
            'message' => 'Product created successfully.',
        ];

        return response()->json($response, 200);

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

        if (is_null($product)) {
            $response = [
                'success' => false,
                'message' => "Product not found.",
            ];

            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'data'    => $product,
            'message' => 'Product retrieved successfully.',
        ];


        return response()->json($response, 200);

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

        $validator = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $product = ModelProducts::find($id);


        if($product){
            $ptitle = str_replace(' ', '-', $request['name']);
            // convert the string to all lowercase
            $p_slug = strtolower($ptitle);

            $request->request->add(['slug' => $p_slug ]);
            $input = $request->all();
            $product->update($input);

            $response = [
                'success' => true,
                'data'    => $product,
                'message' => 'Product updated successfully.',
            ];


            return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'data'    => $product,
                'message' => 'Product not found',
            ];


            return response()->json($response, 404);
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

        $product = ModelProducts::find($id);
        if($product){
            $product->delete();

            $response = [
                'success' => true,
                'message' => 'Product deleted successfully.',
            ];

            return response()->json($response, 200);

        }else{
            $response = [
                'success' => false,
                'data'    => $product,
                'message' => 'Product not found!',
            ];

            return response()->json($response, 404);
        }
    }
}
