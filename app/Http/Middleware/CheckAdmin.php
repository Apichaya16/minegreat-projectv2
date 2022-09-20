<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasAdmin()) {
            return $next($request);
        }

        return redirect()->route('admin.dashboard');
        // $status = new AlertMsg("danger", "ขออภัย", "สำหรับ admin เท่านั้น");
        // return redirect()->route('user.home')->with('status', $status);
    }
}
