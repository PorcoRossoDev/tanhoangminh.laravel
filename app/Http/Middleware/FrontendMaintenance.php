<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ConfigMaintenance;
use Illuminate\Support\Facades\Auth;

class FrontendMaintenance
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
        // Bỏ qua nếu thuộc admin
        if( request()->is(ENV('APP_ADMIN').'/*') ){
            return $next($request);
        }

        $config = ConfigMaintenance::find(1); // Bật/Tắt bảo trì
        $configAdmin = ConfigMaintenance::find(2); // Check nếu tích chọn cho Admin
        $auth = Auth::guard('web')->user();

        if( $configAdmin && $configAdmin->data == 1 && $auth ){
            return $next($request);
        } elseif( $config && $config->data == 0 ){
            return $next($request);
        } else {
            return response()->view('homepage.layout.maintenance'); // Trang thông báo bảo trì
        }

        return $next($request);
    }
}
