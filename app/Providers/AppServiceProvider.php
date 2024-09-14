<?php

namespace App\Providers;

use App\Services\Reports\LibraryBasedServices\ExportReportService;
use App\Services\Reports\LibraryBasedServices\ExportStatisticsService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Concerns\FromCollection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FromCollection::class, ExportReportService::class);
        $this->app->bind(FromCollection::class, ExportStatisticsService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
