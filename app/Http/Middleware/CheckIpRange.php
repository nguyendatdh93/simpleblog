<?php

namespace App\Http\Middleware;

use App\Models\Error;
use Closure;
use Config;

class CheckIpRange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->checkIpRange(Config::get('config.ipRange'), $request->ip())) {
            return redirect()->route(Error::ERROR_403);
        }

        return $next($request);
    }

    public function checkIpRange($ipRange, $ip)
    {
        foreach ($ipRange as $range) {
            if (strpos($range, '/') == false) {
                $range .= '/32';
            }

            list($range, $netmask) = explode('/', $range, 2);
            $ipDecimal = ip2long($ip);
            $rangeDecimal = ip2long($range);
            $wildcardDecimal = pow(2, (32 - $netmask)) - 1;
            $netmaskDecimal = ~$wildcardDecimal;
            if (($ipDecimal & $netmaskDecimal) == ($rangeDecimal & $netmaskDecimal)) {
                return true;
            }
        }

        return false;
    }
}
