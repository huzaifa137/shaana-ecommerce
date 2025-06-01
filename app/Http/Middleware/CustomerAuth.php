<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (! session()->has('LoggedCustomer') &&

            ($request->path() != 'item-shop' &&
                $request->path() != 'item-cart' &&
                $request->path() != 'item-details' &&
                $request->path() != 'item-checkout' &&
                $request->path() != 'contact-us' &&
                $request->path() != 'user-login' &&
                $request->path() != 'user-register' &&
                ! $request->routeIs('product.item'))) {

            Session::put('url.intended', $request->url());

            return redirect('/')->with('fail', 'You must be logged in');
        }

        // if (session()->has('LoggedStudent') &&
        //     ($request->path() == 'users/login' || $request->path() == 'users/register' || $request->path() == 'users/home-page' || $request->routeIs('auth-user-check'))) {
        //     return redirect('/student/dashboard');
        // }

        if (session()->has('LoggedCustomer') &&
            ($request->path() == 'user-login' || $request->path() == 'user-register' || $request->routeIs('home'))) {
            return redirect('/customer/dashboard');
        }

        $response = $next($request);

        $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');

        return $response;
    }
}
