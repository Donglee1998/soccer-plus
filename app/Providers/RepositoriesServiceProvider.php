<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\TacticRepositoryInteface;
use App\Repositories\TacticRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $providers = [
            [
                'contracts'  => BaseRepositoryInterface::class,
                'repository' => BaseRepository::class,
            ],
            [
                'contracts'  => TacticRepositoryInteface::class,
                'repository' => TacticRepository::class,
            ]
        ];
        foreach ($providers as $repository) {
            $this->app->bind(
                $repository['contracts'], $repository['repository']
            );
        }
    }
}
