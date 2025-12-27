<?php

namespace App\Providers;

use App\Repository\FileTaskRepository;
use App\Repository\MySqlTaskRepository;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            TaskRepositoryInterface::class,
            function ($app) {
                $repositoryType = config('repository.type', 'mysql');
                
                if ($repositoryType === 'file') {
                    $storagePath = config('repository.storage.file');
                    return new FileTaskRepository($storagePath);
                }
                
                return new MySqlTaskRepository();
            }
        );
    }

    public function boot(): void
    {
        //
    }
}

