<?php

namespace App\Providers;

use App\Utils\CpfUtil;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('cpf_valido', function ($attribute, $value, $parameters, $validator) {
            return CpfUtil::validarCPF($value);
        });
    }
}
