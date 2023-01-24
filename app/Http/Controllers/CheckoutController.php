<?php

namespace App\Http\Controllers;

use App\Models\ModelOrder;
use App\Models\ModelOrderitems;
use App\Models\ModelOrderPaymentDetail;
use App\Models\ModelProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;
use Stripe;
use PDF;
use App\Mail\OrderCreation;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
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

        if(empty($uid)){
            $uid = 0;
        }
        $request->request->add(['user_id' => $uid ]);

        $input = $request->all();

        $data = [
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
                "amount" => $request['total_payment'],
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
            ]);
            $chargeID = $res['id'];

            $paymentdetail = [
                'orderid' => $orderId,
                'payment_method' => $request['payment-method'],
                'card_number' => $request['card_number'],
                'total_amount' => $request['total_payment'],
                'transaction_id' => $chargeID,
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

            Mail::to('mubeeniqbal82@gmail.com')->send(new OrderCreation($name));

            Mail::send('emails.ordercreation', $data, function($message)use($data, $pdf){
                $message->to('mubeeniqbal82@gmail.com')
                ->subject( 'Order detail' )
                    ->attachData($pdf->output(), "invoice.pdf");
            });



            /*Mail::send('mail', $data, function($message)use($data, $pdf) {
                $message->to('mubeeniqbal82@gmail.com', 'mubeeniqbal82@gmail.com')
                    ->subject( 'Order detail' )
                    ->attachData($pdf->output(), "invoice.pdf");
            });*/



            session()->forget('cart');



            return redirect(url('/thank-you') )->with('message', 'Order placed successfully!');
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
