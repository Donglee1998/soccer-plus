<?php

namespace App\Validation;

use Illuminate\Validation\ValidationServiceProvider as BaseValidationServiceProvider;
class ValidationServiceProvider extends BaseValidationServiceProvider
{
    public function boot()
    {
        $validator = $this->app['validator'];

        (new Validator())->extend($validator);
    }
}
