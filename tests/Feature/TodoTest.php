<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_displays_todo_list(): void
    {
        Todo::factory()->create(['title' => 'CI pipeline kur']);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('DevOps101');
        $response->assertSee('PR Korumasi');
        $response->assertSee('CI pipeline kur');
    }

    public function test_user_can_create_a_todo(): void
    {
        $response = $this->post(route('todos.store'), [
            'title' => 'GitHub Actions test et',
        ]);

        $response->assertRedirect(route('todos.index'));
        $this->assertDatabaseHas('todos', [
            'title' => 'GitHub Actions test et',
            'completed' => false,
        ]);
    }

    public function test_todo_title_is_required(): void
    {
        $response = $this->post(route('todos.store'), [
            'title' => '',
        ]);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount('todos', 0);
    }

    public function test_user_can_toggle_a_todo(): void
    {
        $todo = Todo::factory()->create(['completed' => false]);

        $response = $this->patch(route('todos.toggle', $todo));

        $response->assertRedirect(route('todos.index'));
        $this->assertTrue($todo->fresh()->completed);
    }

    public function test_user_can_delete_a_todo(): void
    {
        $todo = Todo::factory()->create();

        $response = $this->delete(route('todos.destroy', $todo));

        $response->assertRedirect(route('todos.index'));
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}