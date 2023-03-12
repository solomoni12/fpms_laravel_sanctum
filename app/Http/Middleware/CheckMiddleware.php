<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Field;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class CheckMiddleware
{

    use HttpResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){

        // $field = User::all()->random()->id;
        if (Auth::user()->id !== User::all()->random()->id) {
            return $this->error('','You are not Authorized to make request',403);
        }
        return $next($request);
    }
}
