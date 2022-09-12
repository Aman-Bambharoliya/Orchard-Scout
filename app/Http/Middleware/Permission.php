<?php

namespace App\Http\Middleware;

use App\Models\ModuleAction;
use Closure;
use Auth;
use Illuminate\Routing\Route;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 1) {
            return $next($request);
        } else if (Auth::user()->role == 2) {
            $action_name = $request->route()->getName();
            $ma = ModuleAction::with('hasModule')->where('action_name', $action_name)->first();
            if ($ma != null) {
                $module_name = $ma->module_name;
                $rights = $ma->rights;
                $permission = json_decode(Auth::user()->permissions, true);
                if (isset($permission[$module_name]) && in_array($rights, $permission[$module_name])) {
                    return $next($request);
                } else {
                    abort('403', "You don't have a permission to access");
                }
            }
            abort('403', "You don't have a permission to access");
        }
        abort('403', "You don't have a permission to access");
    }
}
