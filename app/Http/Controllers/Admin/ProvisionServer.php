<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\MaxSizeImageCk5Request;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ProvisionServer extends Controller
{
    public function __construct()
    {
        ini_set('memory_limit', '1G');
        $authenticationMiddleware = config('ckfinder.authentication');

        if(!is_callable($authenticationMiddleware)) {
            if(isset($authenticationMiddleware) && is_string($authenticationMiddleware)) {
                $this->middleware($authenticationMiddleware);
            } else {
                $this->middleware(\CKSource\CKFinderBridge\CKFinderMiddleware::class);
            }
        }
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function requestAction(ContainerInterface $container, MaxSizeImageCk5Request $request)
    {
        /** @var CKFinder $connector */
        $connector = $container->get('ckfinder.connector');

        // If debug mode is enabled then do not catch exceptions and pass them directly to Laravel.
        $enableDebugMode = config('ckfinder.debug');

        return $connector->handle($request, HttpKernelInterface::MASTER_REQUEST, !$enableDebugMode);
    }

    /**
     * Action that displays CKFinder browser.
     *
     * @return string
     */
    public function browserAction(ContainerInterface $container, Request $request)
    {
        return view('ckfinder::browser');
    }
}
