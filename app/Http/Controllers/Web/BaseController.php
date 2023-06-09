<?php

namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
