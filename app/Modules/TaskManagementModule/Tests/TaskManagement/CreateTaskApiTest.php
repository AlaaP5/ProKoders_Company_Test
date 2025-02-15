<?php

namespace App\Modules\TaskManagementModule\Tests\TaskManagement;

use App\Modules\TaskManagementModule\SubtaskManagement\Models\AddSubtaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Models\Task;
use App\Modules\TaskManagementModule\TaskManagement\Repository\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTaskApiTest extends TestCase
{
    use RefreshDatabase;


    protected TaskRepository $taskRepo;



    protected function setUp(): void
    {
        parent::setUp();

        $task = new Task();
        $this->taskRepo = new TaskRepository($task);

        $this->seed(\App\Modules\SharedModule\Auth\DataBaseSeeders\RolesPermissionsSeeder::class);
    }



    public function test_create_task_requires_authentication()
    {
        $response = $this->postJson('/api/tasks/create', []);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }



    public function test_create_task_requires_admin_permission()
    {
        $user = \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()->create()->assignRole('employee');
        $this->actingAs($user);

        $user2 = \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()->create()->assignRole('employee');
        $response = $this->postJson('/api/tasks/create', [
            'title' => 'New Task',
            'description' => 'Task description',
            'status' => 'pending',
            'user_id' => $user2->id
        ]);

        $response->assertStatus(200);
    }



    public function test_create_task_successfully()
    {

        $admin = \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()->create()->assignRole('admin');
        $this->actingAs($admin);


        $user = \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()->create()->assignRole('employee');


        $taskData = [
            'title' => 'New Task',
            'description' => 'Task description',
            'status' => 'pending',
            'user_id' => $user->id,
        ];


        $dto = new AddUpdateTaskDto($taskData);


        $response = $this->postJson('/api/tasks/create', $dto->toArray());


        $response->assertStatus(200)->assertJson([
            'status' => true,
            'message' => __('shared.success'),
        ]);


        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'description' => 'Task description',
            'status' => 'pending',
            'user_id' => $user->id,
        ]);


        $task = \App\Modules\TaskManagementModule\TaskManagement\Models\Task::first();


        $subtaskData = [
            'details' => 'Subtask 1 details',
            'task_id' => $task->id,
        ];


        $subtaskDto = new AddSubtaskDto($subtaskData['details'], $subtaskData['task_id']);


        $subtaskResponse = $this->postJson('/api/subtasks/create', $subtaskDto->toArray());


        $subtaskResponse->assertStatus(200)->assertJson([
            'status' => true,
            'message' => __('shared.success'),
        ]);


        $this->assertDatabaseHas('subtasks', [
            'details' => 'Subtask 1 details',
            'task_id' => $task->id,
        ]);
    }


    public function test_task_status_updates_when_all_subtasks_completed()
    {

        $task = \App\Modules\TaskManagementModule\DataBase\Factories\TaskFactory::new()->create();


        \App\Modules\TaskManagementModule\DataBase\Factories\SubtaskFactory::new()->count(3)->create([
            'task_id' => $task->id,
            'status' => 'completed'
        ]);


        $this->taskRepo->updateTaskStatus($task->subtasks->first());


        $this->assertEquals('completed', $task->fresh()->status);
    }

    public function test_task_status_updates_when_at_least_one_subtask_in_progress()
    {
        $task = \App\Modules\TaskManagementModule\DataBase\Factories\TaskFactory::new()->create();

        \App\Modules\TaskManagementModule\DataBase\Factories\SubtaskFactory::new()->count(2)->create([
            'task_id' => $task->id,
            'status' => 'pending'
        ]);

        \App\Modules\TaskManagementModule\DataBase\Factories\SubtaskFactory::new()->create([
            'task_id' => $task->id,
            'status' => 'in_progress'
        ]);

        $this->taskRepo->updateTaskStatus($task->subtasks->first());

        $this->assertEquals('in_progress', $task->fresh()->status);
    }

    public function test_task_status_updates_when_all_subtasks_pending()
    {
        $task = \App\Modules\TaskManagementModule\DataBase\Factories\TaskFactory::new()->create();

        \App\Modules\TaskManagementModule\DataBase\Factories\SubtaskFactory::new()->count(3)->create([
            'task_id' => $task->id,
            'status' => 'pending'
        ]);

        $this->taskRepo->updateTaskStatus($task->subtasks->first());

        $this->assertEquals('pending', $task->fresh()->status);
    }


}
