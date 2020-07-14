<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	//验证登录权限,验证成功的可以往下执行
	    //记得调用正确的守卫
    	if(!Auth::guard('admin')->check()){
    		return redirect('/admin/login');
	    }

	    return $next($request);


    }
}
