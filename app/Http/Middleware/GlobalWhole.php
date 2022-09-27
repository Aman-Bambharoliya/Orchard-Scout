<?php

namespace App\Http\Middleware;
use App\Models\ModuleAction;
use Closure;
use Auth;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class GlobalWhole
{
   
    public function handle($request, Closure $next)
    {
        if($request->route()->getName()=='laravel-backup-panel.index')
        {
            if (!Auth::check()) {
                return redirect()->route('login');
            }
            else
            {
                if (Auth::user()->role == 1) {
                    return $next($request);
                } else {
                    abort('403',"You don't have a permission to access" );
                    return back(); 
                }
            }
        }
        else
        {
            return $next($request);
        }
      
    }
}
