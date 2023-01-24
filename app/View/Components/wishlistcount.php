<?php

namespace App\View\Components;

use App\Models\WishlistModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class wishlistcount extends Component
{
    public $countwishlist;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($countwishlist)
    {

        $userid = Auth::id();
        $wishlist = WishlistModel::where('user_id', $userid)->get()->toArray();
        $total = count($wishlist);
        $this->countwishlist = $total;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wishlistcount');
    }
}
