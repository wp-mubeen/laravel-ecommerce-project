<?php

namespace App\View\Components\product;

use App\Models\ModelComments;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class comments extends Component
{
    public $product;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $product)
    {
      // $reviews = ModelComments::where('product_id',$productid)->get()->toArray();
        $reviews = DB::table('comments')
             ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('comments.product_id', '=', $product)
            ->where('comments.status', '=', '1')
            ->select('comments.*','users.picture')
            ->get();
        //dd($reviews);
       $this->product = $reviews;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product.comments');
    }
}
