<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Closure;

class ExceptIpPdf
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
        $allowable_ips = [
            '14.161.22.110', //CBA
            '118.238.3.73', //CB
            '126.55.140.86', //Client
            '126.161.199.179', //Client
            '111.217.146.13', //Client
            '118.240.53.163', //Hirayama house
            '203.152.211.226', //Hiroshima office
            '126.93.156.208',//Client
            '14.132.76.32', //Client
            '126.55.195.65', //Client
            '111.217.146.58', //CLient
            '92.202.72.155', // Client
            '106.129.186.207', // Client
            '133.106.32.22', // Client
            '172.18.0.1', //CBA
        ];
        $ip = collect(explode(',', $request->server('HTTP_X_FORWARDED_FOR')))->first();
        if (
            in_array($ip, $allowable_ips) ||
            preg_match('/10\.1[01]\.[0-9]{1,3}\.[0-9]{1,3}/', $ip)
        ) {
            return $next($request);
        } else {
            return new Response(view('preview.teaser'));
        }
    }
}
