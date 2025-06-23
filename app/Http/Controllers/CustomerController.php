<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{

    public function customerDashboard()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', session('LoggedCustomer'))
            ->latest()
            ->get();

        $BestSellingProducts = Product::where('labels->bestSelling', true)->get();

        return view('Customer.customer-dashboard', compact('orders', 'BestSellingProducts'));
    }

    public function customerLogout()
    {
        if (session()->has('LoggedCustomer')) {
            session()->flush();
            return redirect('/');
        } elseif (session()->has('LoggedAdmin')) {
            session()->flush();
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

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'message' => $request->message,
            'title'   => 'New Contact Message Received',
        ];

        try {
            Mail::send('emails.contact-submitted', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Message submitted, but failed to send confirmation email.');
        }

        return redirect()->back()->with('success', 'Your message has been submitted successfully!');
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

    public function customerContactUsMessage()
    {
        $messages = Contact::latest()->paginate(10);

        return view('Admin.customer-contact-us-messages', compact('messages'));
    }

    public function myMessages($id)
    {
        $orders = Order::where('user_id', session('LoggedCustomer'))->latest()->get();

        return view('customer.orders', compact('orders'));
    }

    public function showMessageDetails($id)
    {
        $message = Contact::findOrFail($id);
        return view('Customer.contact-us-message-details', compact('message'));
    }

    public function updateStatus(Request $request, $id)
    {

        $message         = Contact::findOrFail($id);
        $message->status = $request->input('status');
        $message->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function allCustomers()
    {
        $customers = User::where('user_role', 1)
            ->latest()
            ->paginate(15);

        return view('Admin.all-customers', compact('customers'));
    }

    public function showCustomer($id)
    {
        $customer = User::findOrFail($id);

        return view('Admin.customer-information', compact('customer'));
    }

    public function updateCustomerStatus(Request $request, $id)
    {

        try {
            $customer = User::findOrFail($id);

            $validated = $request->validate([
                'is_active' => 'required|in:-1,0,1',
            ]);

            $customer->is_active = $validated['is_active'];
            $customer->save();

            return back()->with('success', 'User account status updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update user status.');
        }
    }

}
