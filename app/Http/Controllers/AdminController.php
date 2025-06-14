<?php
namespace App\Http\Controllers;

class AdminController extends Controller
{

public function flushSession()
{
    session()->flush();
    session()->put('reset_popup', true);
    return redirect('/');
}


    public function adminDashboard()
    {
        return view('Admin.dashboard');
    }
}
