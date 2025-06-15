<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {

        $cart = session()->get('cart', []); // or Cart::where('user_id', auth()->id())->get();

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Create Order
            $order = Order::create([
                'user_id'        => Session('LoggedCustomer'), // or null for guest
                'total_amount'   => $total,
                'status'         => 'pending',
                'payment_method' => 'Flutterwave',
                'shipping_info'  => json_encode([
                    'name'     => $request->name,
                    'phone'    => $request->phone,
                    'address'  => $request->address,
                    'region'   => $request->region,
                    'email'    => $request->email,
                    'country'  => $request->country,
                    'postcode' => $request->postcode,
                    'note'     => $request->note ?? '',
                ]),
            ]);

            // Add Items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }

            DB::commit();

                                       // Clear cart
            session()->forget('cart'); // or delete Cart::where(...)

            $user = User::where('id', session('LoggedCustomer'))->first();
            $user->notify(new NewOrderNotification($order));

            $admins = User::where('user_role', '!=', '1')->get(); // Adjust based on your role system
            foreach ($admins as $admin) {
                $admin->notify(new NewOrderNotification($order));
            }

            return redirect()->back()->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', session('LoggedCustomer'))->latest()->get();

        return view('customer.orders', compact('orders'));
    }

    public function showOrders($id)
    {
        $order = Order::with('items.product')->where('user_id', session('LoggedCustomer'))->findOrFail($id);

        return view('customer.all-orders', compact('order'));
    }

    public function adminOrders()
    {
        $orders = Order::with('user')->latest()->get();

        return view('Admin.admin-orders', compact('orders'));
    }

    public function adminOrdersNotifications()
    {

        $notifications = DB::table('notifications')->latest()->get();
        return view('Admin.admin-orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated!');
    }

    public function showOrderinformation($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);

        return view('Admin.order-information', compact('order'));
    }
}
