<?php

namespace App\View\Components\product;

use App\Models\ModelProducts;
use Illuminate\View\Component;

class PopularProducts extends Component
{
    public $popular;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($popular)
    {
        $RelatedProducts = ModelProducts::where('cate_id',$popular)->orderby('id','DESC')->take(5)->get()->toArray();
        $this->popular = $RelatedProducts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product.popular-products');
    }
}
