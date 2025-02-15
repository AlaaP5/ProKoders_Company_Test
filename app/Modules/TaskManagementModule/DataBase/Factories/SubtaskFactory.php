<?php


namespace App\Modules\TaskManagementModule\DataBase\Factories;

use App\Modules\TaskManagementModule\SubtaskManagement\Models\Subtask;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubtaskFactory extends Factory
{
    protected $model = Subtask::class;

    public function definition(): array
    {
        return [
            'details' => $this->faker->sentence,
            'status' => 'pending',
            'task_id' => \App\Modules\TaskManagementModule\DataBase\Factories\TaskFactory::new()->create()->id,
        ];
    }
}
