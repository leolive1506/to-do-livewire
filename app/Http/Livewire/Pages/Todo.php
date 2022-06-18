<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Todo extends Component
{
    public $isOpen = false;

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.pages.todo');
    }
}
