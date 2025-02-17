<?php

namespace App\Providers;

use App\Modules\CommonModule\Auth\Repository\AuthRepository;
use App\Modules\CommonModule\Auth\Repository\AuthRepositoryInterface;
use App\Modules\CommonModule\Auth\Services\AuthService;
use App\Modules\CommonModule\Auth\Services\AuthServiceInterface;
use App\Modules\CommonModule\UserManagement\Repository\UserRepository;
use App\Modules\CommonModule\UserManagement\Repository\UserRepositoryInterface;
use App\Modules\CommonModule\UserManagement\Services\UserService;
use App\Modules\CommonModule\UserManagement\Services\UserServiceInterface;
use App\Modules\TaskManagementModule\SubtaskManagement\Repository\SubtaskRepository;
use App\Modules\TaskManagementModule\SubtaskManagement\Repository\SubtaskRepositoryInterface;
use App\Modules\TaskManagementModule\SubtaskManagement\Services\SubtaskService;
use App\Modules\TaskManagementModule\SubtaskManagement\Services\SubtaskServiceInterface;
use App\Modules\TaskManagementModule\TaskManagement\Repository\TaskRepository;
use App\Modules\TaskManagementModule\TaskManagement\Repository\TaskRepositoryInterface;
use App\Modules\TaskManagementModule\TaskManagement\Services\TaskService;
use App\Modules\TaskManagementModule\TaskManagement\Services\TaskServiceInterface;
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
        $this->app->bind(SubtaskServiceInterface::class, SubtaskService::class);
        $this->app->bind(SubtaskRepositoryInterface::class, SubtaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
