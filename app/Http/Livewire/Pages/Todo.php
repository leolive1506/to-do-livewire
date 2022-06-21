<?php

namespace App\Http\Livewire\Pages;

use App\Domains\Storage\Service\StorageService;
use App\Models\Todo as ModelsTodo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Todo extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $arrayDepenciesPage = [];
    public $todo;

    public $search;
    public $file;

    public $rules = [
        'todo.name' => 'required|max:140',
        'todo.description' => 'nullable',
        'todo.file' => 'nullable',
        'todo.remember_at' => 'nullable|date',
        'todo.cost' => 'nullable|string',
        'file' => 'nullable|image|max:1024',
    ];

    public $currentView;

    public function mount()
    {
        $this->currentView = empty(request()->id) ? 'index' : 'form';
        $this->handleCurrentView();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
        $this->arrayDepenciesPage['todos'] = $this->index();
        ray($this->arrayDepenciesPage);
    }

    public function updatedCurrentView()
    {
        $this->handleCurrentView();
    }

    public function updatedSearch()
    {
        $this->arrayDepenciesPage['todos'] = $this->index();
    }

    public function checkboxRequest($string)
    {
        ray('method: checkboxRequest');
        [$todoId, $field] = explode('.', $string);
        $todo = ModelsTodo::findOrFail($todoId);
        $todo->completed = empty($todo->completed);
        $todo->save();
        ray([$todo, $todo->completed]);

        flashMessage('Atualizado com sucesso');
        $this->arrayDepenciesPage['todos'] = $this->index();
        return;
    }

    public function handleCurrentView()
    {
        switch ($this->currentView) {
            case 'index':
                $this->arrayDepenciesPage['todos'] = $this->index();
                break;
            case 'form':
                $this->todo = empty(request()->id) ? new ModelsTodo() : $this->getTodo(request()->id);
                break;
            // case 'show':
            //     break;
        }
    }

    public function index()
    {
        return ModelsTodo::when($this->search, function ($query) {
            $query->where('name', 'like', "%{$this->search}%");
        })->orderBy('id', 'desc')->paginate(20);
    }

    public function getTodo($id)
    {
        return ModelsTodo::findOrFail($id);
    }

    public function store()
    {
        $this->validate($this->rules);

        if (!empty($this->file)) {
            $this->todo->file_extension = $this->file->extension();
            $this->todo->file = $this->file->store('todos');
        }

        if (!empty($this->todo->cost)) {
            $this->todo->cost = getOnlyNumbersDecimal($this->todo->cost);
        }

        $this->todo->save();
        flashMessage('Salvo com sucesso');
    }

    public function show(ModelsTodo $todo)
    {
        $this->todo = $todo;
        $this->currentView = 'show';
    }

    public function update()
    {
        $this->validate($this->rules);

        if (!empty($this->file) && !empty($this->todo->file)) {
            StorageService::deleteFileStorage($this->todo->file);
            $this->todo->file_extension = $this->file->extension();
            $this->todo->file = $this->file->store('todos');
        }

        if (!empty($this->todo->cost)) {
            $this->todo->cost = getOnlyNumbersDecimal($this->todo->cost);
        }

        $this->todo->save();
        flashMessage('Atualizado com sucesso');
    }

    public function save()
    {
        empty($this->todo->id) ? $this->store() : $this->update();
        $this->currentView = 'index';
        $this->handleCurrentView();
    }

    public function destroy(ModelsTodo $todo)
    {
        if (!empty($todo->file)) {
            StorageService::deleteFileStorage($todo->file);
        }

        ModelsTodo::destroy($todo->id);
        flashMessage('Deletado com sucesso');
        $this->handleCurrentView();
    }


    public function render()
    {
        return view('livewire.pages.todo.' . $this->currentView, $this->arrayDepenciesPage);
    }
}
