<?php
namespace App\Http\Controllers;

class MasterController extends Controller
{
    public function home()
    {
        return view('Ecommerce.home');
    }

    public function itemShop()
    {
        return view('Ecommerce.item-shop');
    }

    public function itemCart()
    {
        return view('Ecommerce.item-cart');
    }

    public function itemCheckout()
    {
        return view('Ecommerce.item-checkout');
    }

    public function itemDetails()
    {
        return view('Ecommerce.item-detail');
    }

    public function contactUs()
    {
        return view('Ecommerce.contact');
    }
}
