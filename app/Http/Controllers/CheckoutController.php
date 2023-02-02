<?php

namespace App\Http\Controllers;

use App\helpers\Custom;
use App\Models\ModelOrder;
use App\Models\ModelOrderitems;
use App\Models\ModelOrderPaymentDetail;
use App\Models\ModelProducts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe;
use PDF;
use Illuminate\Mail\Mailables\Attachment;
use Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = Auth::id();
        $user = User::find($uid);
        $userinfo = $user->profile()->first();


        return view('checkout',['userinfo'=> $userinfo]);
    }

    public function thankyou()
    {

        return view('thankyou');

    }

    public function PlaceOrder(Request $request)
    {

        if($request['payment-method'] == "card") {
            $validator = $request->validate([
                'stripeToken' => 'required',
            ]);
        }

        $validator = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'payment-method' => 'required',
        ]);

        $uid = Auth::id();

        $profiledata = [
            'user_id'=> $uid,
            'first_name'=> $request['fname'],
            'last_name'=> $request['lname'],
            'email'=> $request['email'],
            'phone_number'=> $request['phone_number'],
            'billing_address'=> $request['address'],
            'country'=> $request['country'],
            'state'=> $request['state'],
            'city'=> $request['city'],
            'zip_code'=> $request['postcode'],
        ];
        Custom::SaveProfile( $profiledata , $uid);

        if(empty($uid)){
            $uid = 0;
        }
        $request->request->add(['user_id' => $uid ]);

        $input = $request->all();

        $data = [
            'userid'=> $uid,
            'fname'=> $request['fname'],
            'lname'=> $request['lname'],
            'email'=> $request['email'],
            'phone_number'=> $request['phone_number'],
            'address'=> $request['address'],
            'country'=> $request['country'],
            'comment'=> $request['comment'],
            'state'=> $request['state'],
            'city'=> $request['city'],
            'postcode'=> $request['postcode'],
            'message'=> $request['message'],
            'tracking_no'=> 'trackno'.rand(1111,9999),
            'status'=> '0',
        ];

        $order = ModelOrder::create($data);
        $orderId = $order->id;
        $name = $request['fname'].' '. $request['lname'];

        $date = date('m-d-y');

        if($request['payment-method'] == "card") {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $res = Stripe\Charge::create([
                "amount" => $request['total_payment'] * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
            ]);

            $chargeID = $res['id'];
            $paymentstatus = $res['status'];

            $paymentdetail = [
                'orderid' => $orderId,
                'payment_method' => $request['payment-method'],
                'card_number' => $request['card_number'],
                'total_amount' => $request['total_payment'],
                'transaction_id' => $chargeID,
                'payment_status' => $paymentstatus,
            ];
            ModelOrderPaymentDetail::create($paymentdetail);
        }elseif($request['payment-method'] == "COD"){
            $paymentdetail = [
                'orderid' => $orderId,
                'payment_method' => $request['payment-method'],
                'total_amount' => $request['total_payment'],
            ];
            ModelOrderPaymentDetail::create($paymentdetail);
        }

        if( session('cart') ){
            foreach(session('cart') as $id => $details){
                $productId = $details['product_id'];
                $quantity = $details['quantity'];
                $price = $details['price'];

                ModelOrderitems::create([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price
                ]);
                $product = ModelProducts::find($productId);
                $input = [
                    'qty' => $product->qty - $quantity,
                ];
                $product->update($input);

            }
            $data = [
                'orderId' =>  $orderId,
                'name' => $name,
                'date' => $date,
                'email' => $request['email'],
                'phone_number'=> $request['phone_number'],
                'address'=> $request['address'],
                'country'=> $request['country'],
                'comment'=> $request['comment'],
                'state'=> $request['state'],
                'city'=> $request['city'],
                'postcode'=> $request['postcode'],
            ];



            $pdf = PDF::loadView('invoice-pdf', $data);


           Mail::send('emails.ordercreation', $data, function($message)use($data, $pdf) {
               // $message->to($data["email"])
                $message->to('mubeeniqbal82@gmail.com')
                    ->subject( 'Order detail' )
                    ->attachData($pdf->output(),"order-invoice.pdf");
            });



            //Mail::to('mubeeniqbal82@gmail.com')->send(new OrderCreation($name));


            session()->forget('cart');

            return redirect(url('/thank-you') )->with('message', 'Order placed successfully!');
        }

    }

    public function OrderDetail($orderId)
    {
        $order = ModelOrder::find($orderId);
        if(!$order){
            abort(404);
        }
        $user = Auth::user();
        $userlevel = $user->is_admin;

        $uid = Auth::id();
        $userorder = ModelOrder::where('userid',$uid)->where('id',$orderId)->get();

        if($userlevel == 1){
            $orderitems = DB::table('order_items')
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->join('products', 'products.id', '=', 'order_items.product_id')
                ->join('order_payment_detail', 'order_payment_detail.orderid','=','orders.id')
                ->where('orders.id', $orderId)
                ->select('order_payment_detail.*','products.name','products.slug','products.image','order_items.*')
                ->get();

            $paymentdetail = $order->getorderpaymentinfo;

            return view('dashboards.orderdetail.detail',[ 'userlevel' => $userlevel , 'orderitems' => $orderitems,'order'=> $order, 'paymentdetail'=> $paymentdetail ] );

        }elseif( count($userorder) >= 1 ){
            if($order){
                // $orderitems = ModelOrder::find($orderId)->getallitems; // commit one to many relationship query
                $orderitems = DB::table('order_items')
                    ->join('orders', 'orders.id', '=', 'order_items.order_id')
                    ->join('products', 'products.id', '=', 'order_items.product_id')
                    ->join('order_payment_detail', 'order_payment_detail.orderid','=','orders.id')
                    ->where('orders.id', $orderId)
                    ->select('order_payment_detail.*','products.name','products.slug','products.image','order_items.*')
                    ->get();

                $paymentdetail = $order->getorderpaymentinfo;

                return view('dashboards.orderdetail.detail',[ 'userlevel' => $userlevel , 'orderitems' => $orderitems,'order'=> $order, 'paymentdetail'=> $paymentdetail ] );
            }else{
                abort(404);
            }
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
    public function UpdateOrder(Request $request)
    {
        $id = $request['orderid'];
        ModelOrder::where('id',$id)->update(['status'=>'1']);

        return redirect()->back()->with('success', 'Order Completed successfully!');
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
