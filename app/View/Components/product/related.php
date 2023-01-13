<?php

namespace App\View\Components\product;

use App\Models\ModelProducts;
use Illuminate\View\Component;

class related extends Component
{
    public $related;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($related)
    {
       $RelatedProducts = ModelProducts::where('cate_id',$related)->get()->toArray();
       $this->related = $RelatedProducts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product.related');
    }
}
