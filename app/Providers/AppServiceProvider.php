<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
//use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!Collection::hasMacro('paginate')) {
        Collection::macro('paginate',
            function ($perPage = 4, $page = null, $options = []) {
            $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
            return (new LengthAwarePaginator(
                $this->forPage($page, $perPage)->values()->all(), $this->count(), $perPage, $page, $options))
                ->withPath('');
        });
      }

    }
}
