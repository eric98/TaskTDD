<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewUsersTasks extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function an_user_can_see_is_own_tasks()
    {
        //1 Prepare
        $user = factory(User::class)->create();
        $tasks = factory(Task::class,5)->create();
        $user->tasks()->saveMany($tasks);

        //2 Executar codi a prova

        $this->withoutExceptionHandling();

        $response = $this->get('user/'.$user->id.'/tasks');
//        $response->dump();
        $response->assertSuccessful();
        $response->assertViewIs('user_tasks');
        $response->assertViewHas('tasks', $user->tasks);
//        $response->assertViewHas('user', $user);
        
        $response->assertSeeText($user->name, ' Tasks: ');

        foreach ($tasks as $task) {
            $response->assertSeeText($task->name);
        }

//        $this->assertSeeText($tasks[0]->name);
//        $this->assertSeeText($tasks[1]->name);
//        $this->assertSeeText($tasks[2]->name);
//        $this->assertSeeText($tasks[3]->name);
//        $this->assertSeeText($tasks[4]->name);

        // return view('user_tasks',['tasks' => $tasks])

        // Assertions/Comprovacions
    }
}
