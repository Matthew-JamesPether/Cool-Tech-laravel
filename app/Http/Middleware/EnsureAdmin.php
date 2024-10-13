<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

//A class that handles the http request
class EnsureAdmin
{

    //A method that makes user only admins can access the selected link
    public function handle(Request $request, Closure $next)
    {
        //if not a admin redirect to home view
        if(!session('isAdmin')){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
