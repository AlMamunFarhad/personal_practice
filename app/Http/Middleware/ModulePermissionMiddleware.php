<?php

namespace App\Http\Middleware;

use App\Utils\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;

class ModulePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next, $module)
    {
        if (Helpers::module_permission_check($module)) {
            return $next($request);
        }

        Toastr::error(translate('access_Denied').'!');

        return back();
    }
}
