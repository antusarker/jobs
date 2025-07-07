<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role->name;
        
        if (!in_array($userRole, $roles)) {
            // abort(403, 'Unauthorized action.');
            

            Session::flash('flash_message','You do not have permission to access this page.');
            return redirect()->back()->with('status_color','warning');
        }

        return $next($request);
    }
}
