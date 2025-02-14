<?php

namespace App\Providers;

use App\Modules\SharedModule\Auth\Repository\AuthRepository;
use App\Modules\SharedModule\Auth\Repository\AuthRepositoryInterface;
use App\Modules\SharedModule\Auth\Services\AuthService;
use App\Modules\SharedModule\Auth\Services\AuthServiceInterface;
use App\Modules\TaskManagementModule\Repository\TaskRepository;
use App\Modules\TaskManagementModule\Repository\TaskRepositoryInterface;
use App\Modules\TaskManagementModule\Services\TaskService;
use App\Modules\TaskManagementModule\Services\TaskServiceInterface;
use App\Modules\UserManagementModule\Repository\UserRepository;
use App\Modules\UserManagementModule\Repository\UserRepositoryInterface;
use App\Modules\UserManagementModule\Services\UserService;
use App\Modules\UserManagementModule\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**Auth*/
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);

        /**UserManagement*/
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        /**TaskManagement*/
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);

        /**SubTaskManagement*/
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
