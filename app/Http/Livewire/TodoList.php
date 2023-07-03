<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TodoItem;

class TodoList extends Component
{
    public $todos;
    public string $textField = '';

    public function mount(): void
    {
        $this->fetchTodos();
    }

    public function addTodo()
    {
        $todo = new TodoItem();
        $todo->content = $this->textField;
        $todo->completed = false;
        $todo->save();

        $this->textField = '';
        $this->fetchTodos();
    }

    public function toggleTodo($id): void
    {
        $todo = TodoItem::where('id', $id)->first();
        if (!$todo) {
            return;
        }

        $todo->completed = !$todo->completed;
        $todo->save();

        $this->fetchTodos();
    }

    public function deleteTodo($id): void
    {
        $todo = TodoItem::where('id', $id)->first();
        if (!$todo) {
            return;
        }
        $todo->delete();

        $this->fetchTodos();
    }

    public function fetchTodos(): void
    {
        $this->todos = TodoItem::orderBy('created_at', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
