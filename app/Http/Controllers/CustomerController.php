<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Newsletter;
use Illuminate\Http\Request;

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

    public function subscribe(Request $request)
    {

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create($validated);

        return back()->with('success', 'Thanks for subscribing!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($request->all());

        return redirect()->back()->with('success', 'Your message has been submitted!');
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect()->route('contact.index')->with('success', 'Message updated successfully!');
    }
}
