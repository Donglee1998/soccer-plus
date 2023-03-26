<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface RegistrationRepositoryInterface
{
    /**
     * Query resource by condition
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Pagination\LengthAwarePaginator;
     */
    public function queryList(Request $request);
}
