<?php

namespace App\Providers;

use App\View\Components\Tasks\CreateTaskModal;
use App\View\Components\Tasks\UpdateTaskModal;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('update-task-modal', UpdateTaskModal::class);
        Blade::component('create-task-modal', CreateTaskModal::class);
    }
}
