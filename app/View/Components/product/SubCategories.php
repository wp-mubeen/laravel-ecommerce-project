<?php

namespace App\View\Components\product;

use http\Env\Request;
use Illuminate\View\Component;

class SubCategories2 extends Component
{
    public $CategoryId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($CategoryId)
    {
        $this->CategoryId = $CategoryId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.product.sub-categories'  );
    }
}
