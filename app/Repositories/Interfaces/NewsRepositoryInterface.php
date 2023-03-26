<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface NewsRepositoryInterface
{
    /**
     * Query resource by condition
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Pagination\LengthAwarePaginator;
     */
    public function queryList(Request $request);

    /**
     * Update status of the list resource
     *
     * @param array $list
     * @param int $state
     * @return bool
     */
    public function toggleStatusList(array $list, int $state);

    /**
     * Find news detail
     * @param array $condition
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function adminGetDetail(array $condition);

    /**
     * Find news
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function getListNews();

    /**
     * Find news detail
     * @param array $condition
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function getDetailNews(array $condition);

    /**
     * Find news category manual
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function getListManual();
}
