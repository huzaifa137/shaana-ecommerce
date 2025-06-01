<?php
namespace App\Http\Controllers;

class CustomerController extends Controller
{

    public function customerDashboard()
    {
        return view('Customer.customer-dashboard');
    }

    public function customerLogout()
    {
        if (session()->has('LoggedCustomer')) {
            session()->flush();
            return redirect('/');
        } else {
            return redirect('/');
        }
        return back();
    }
}
