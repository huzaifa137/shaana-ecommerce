<?php
namespace App\Http\Controllers;

class AdminController extends Controller
{

    public function flushSession()
    {
        session()->flush();
        return redirect('/');
    }

    public function adminDashboard()
    {
        return view('Admin.dashboard');
    }
}
