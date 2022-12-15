<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if(auth()->guest() || auth()->user()->username !== 'andhikaprasetya'){
        //     // tampilkan forbidden
        //     abort(403);
        // }

        // ketika field isAdmin ditambahkan di table user
        if(auth()->guest() || !auth()->user()->is_admin){
            // tampilkan forbidden
            abort(403);
        }

        // daftar kan logika IsAdmin.php di kernel.php

        return $next($request);
    }
}
