<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminOrCustomerAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->has('LoggedCustomer') && ! session()->has('LoggedAdmin')) {
            if (
                $request->path() != 'item-shop' &&
                $request->path() != 'item-cart' &&
                $request->path() != 'item-details' &&
                $request->path() != 'item-checkout' &&
                $request->path() != 'contact-us' &&
                $request->path() != 'user-login' &&
                $request->path() != 'user-register' &&
                ! $request->routeIs('product.item')
            ) {
                Session::put('url.intended', $request->url());
                return redirect('/user-login')->with('fail', 'You must be logged in');
            }
        }

        if (($request->path() == 'user-login' || $request->path() == 'user-register')) {

            if (session()->has('LoggedCustomer') && ! session()->has('LoggedAdmin')) {
                return redirect('/customer/dashboard');
            }

            if (session()->has('LoggedAdmin')) {
                return redirect('/shanana/dashboard');
            }
        }

        $response = $next($request);

        $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');

        return $response;
    }
}
