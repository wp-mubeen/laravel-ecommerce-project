<?php

namespace App\View\Components\product;

use App\Models\ModelCategories;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class SubCategories extends Component
{
    public $subcategory;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($subcategory)
    {
        $Catid = $subcategory->id;

       // $subctegories = DB::table('categories')->where('parent_catg','=', $Catid )->get();

        $subctegories = ModelCategories::where('parent_catg', $Catid)->get()->toArray();

        $this->subcategory = $subctegories;
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
