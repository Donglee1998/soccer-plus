<?php

namespace App\Http\Middleware;
use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/',
        '/privacy',
        '/tos',
        '/company',
        '/api/*',
        '/inquiry*',
    ];

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
        ];
        $internal_ip = collect(explode(',', $request->server('HTTP_X_FORWARDED_FOR')))->first();
        // $internal_ip = $request->ip();
        if ($this->app->isDownForMaintenance() && !in_array($internal_ip, $allowable_ips)) {
            $data = json_decode(file_get_contents($this->app->storagePath().'/framework/down'), true);

            if (isset($data['secret']) && $request->path() === $data['secret']) {
                return $this->bypassResponse($data['secret']);
            }

            if ($this->hasValidBypassCookie($request, $data) ||
                $this->inExceptArray($request)) {
                return $next($request);
            }
            throw new HttpException(503);
        }

        return $next($request);
    }

}
