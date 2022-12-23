<?php

namespace App\View\Components;

use App\Models\ModelCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class SubCategories extends Component
{
    public $category;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category)
    {
        $Catid = $category->id;
      $subctegories = DB::table('categories')->where('parent_catg','=', $Catid )->get();

        $this->category = $subctegories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.sub-categories');
    }
}
