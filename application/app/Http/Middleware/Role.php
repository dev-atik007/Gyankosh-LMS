<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // if ($request->user()->role !== $role) {
        //     return redirect()->route('dashboard');
        // }

        $userRole = $request->user()->role;

        if ($userRole === 'user' && $role !== 'user') {
            return redirect()->route('dashboard');
        } elseif ($userRole === 'admin' && $role === 'user') {
            return redirect()->route('admin.dashboard');
        } elseif ($userRole === 'instructor' && $role === 'user') {
            return redirect()->route('instructor.dashboard');
        } elseif ($userRole === 'admin' && $role === 'instructor') {
            return redirect()->route('admin.dashboard');
        } elseif ($userRole === 'instructor' && $role === 'admin') {
            return redirect()->route('instructor.dashboard');
        }


        return $next($request);
    }
}
