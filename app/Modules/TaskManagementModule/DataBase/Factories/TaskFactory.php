<?php


namespace App\Modules\TaskManagementModule\DataBase\Factories;

use App\Modules\TaskManagementModule\TaskManagement\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;


class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => 'pending',
            'user_id' => \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()->create()->id
        ];
    }
}
