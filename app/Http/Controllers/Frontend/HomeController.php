<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function RestaurantDetails($id){
        $restaurant = Client::find($id);
        $menus = Menu::where('client_id', $restaurant->id)->get()->filter(function ($menu) {
            return $menu->products->isNotEmpty();
        });
        $galleries = Gallery::where('client_id', $id)->get();
        return view('frontend.restaurant_details', compact('restaurant', 'menus', 'galleries'));
    }
}
