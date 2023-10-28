<?php

namespace App\Providers;

use App\Filters\LocationFilter;
use App\Filters\OrderFilter;
use Illuminate\Support\ServiceProvider;
use App\Http\Requests\CreateAirportRequest;
use App\Filters\FilterInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(CreateAirportRequest::class, function ($app) {
            return new CreateAirportRequest();
        });

        $this->app->bind(FilterInterface::class, LocationFilter::class);
        $this->app->bind(OrderFilter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
