<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function userLogin()
    {
        return view('Ecommerce.user-login');
    }

    public function userRegister()
    {
        return view('Ecommerce.user-register');
    }

    public function storeUserInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName'     => 'required|string|max:255',
            'lastName'      => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'companyName'   => 'required|string|max:255',
            'address'       => 'required|string|max:255',
            'city'          => 'required|string|max:255',
            'country'       => 'required|string|max:255',
            'postcode'      => 'required|string|max:20',
            'mobile'        => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $user = User::create([
            'first_name'                => $request->input('firstName'),
            'last_name'                 => $request->input('lastName'),
            'email'                     => $request->input('email'),
            'company_name'             => $request->input('companyName'),
            'address'                   => $request->input('address'),
            'city'                      => $request->input('city'),
            'country'                   => $request->input('country'),
            'postcode'                  => $request->input('postcode'),
            'mobile'                    => $request->input('mobile'),
            'default_shipping_address'  => $request->isDefaultAddress,
        ]);

        return response()->json(['message' => 'User Account created successfully']);
    }
}
