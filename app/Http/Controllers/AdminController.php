<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use DB;

class AdminController extends Controller
{

    public function flushSession()
    {
        session()->flush();
        session()->put('reset_popup', true);
        return redirect('/');
    }

    public function adminLogout()
    {
        if (session()->has('LoggedAdmin')) {
            session()->flush();
            return redirect('/');
        } else {
            return redirect('/');
        }
        return back();
    }

    public function adminDashboard()
    {

        $today = now()->startOfDay();

        $recentCustomers = \App\Models\User::where('user_role', 1)
            ->latest()
            ->take(12)
            ->get();

        $countryBasedCustomers = User::where('user_role', 1)->get();

        $todayRevenue = \App\Models\Order::whereDate('created_at', $today)->sum('total_amount');

        $totalCustomers = \App\Models\User::where('user_role', 1)->count();

        $productsSoldToday = \App\Models\OrderItem::whereHas('order', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->sum('quantity');

        $products = \App\Models\Product::latest()->take(20)->get();

        $recentTransactions = \App\Models\Order::with('user')
            ->latest()
            ->take(10)
            ->get();

        $countryStats = User::select('country', DB::raw('COUNT(*) as customer_count'))
            ->where('user_role', 1)
            ->groupBy('country')
            ->get()
            ->map(function ($row) {
                $totalRevenue = DB::table('orders')
                    ->join('users', 'orders.user_id', '=', 'users.id')
                    ->where('users.country', $row->country)
                    ->sum('orders.total_amount');

                return [
                    'country'        => $row->country,
                    'customer_count' => $row->customer_count,
                    'total_revenue'  => $totalRevenue,
                ];
            });

        return view('admin.dashboard', [
            'allOrders'          => Order::count(),
            'pendingOrders'      => Order::where('status', 'pending')->count(),
            'shippedOrders'      => Order::where('status', 'shipped')->count(),
            'deliveredOrders'    => Order::where('status', 'delivered')->count(),
            'recentCustomers'    => $recentCustomers,
            'todayRevenue'       => $todayRevenue,
            'totalCustomers'     => $totalCustomers,
            'productsSoldToday'  => $productsSoldToday,
            'countryStats'       => $countryStats->toArray(),
            'products'           => $products,
            'recentTransactions' => $recentTransactions,
        ]);
    }

}
