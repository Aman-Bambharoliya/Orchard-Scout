<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('permission', function ($module=null,$right=null) {
            if(Auth::user()->role == 1){
                return 1;
            }
            if(Auth::check() && Auth::user()->role == 2) {
                $permission = json_decode(Auth::user()->permissions, true);
                if(isset($permission[$module]) && $right==null)
                {
                    return 1;
                }
                else if(isset($permission[$module]) && $right!=null && in_array($right,$permission[$module]))
                {
                    return 1;
                }
            }
        });
        Blade::if('superadmin', function () {
            if(Auth::user()->role == 1){
                return 1;
            }
        });
    }
}
