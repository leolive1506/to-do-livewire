<div>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h1>{{ empty($todo->id) ? 'Nova tarefas' : 'Editar tarefa' }}</h1>
        </div>
    </x-slot>

    <x-container class="mt-4">
        <div class="flex justify-end">
            <x-button-link href="{{ route('todo') }}">Voltar</x-button-link>
        </div>
        <form wire:submit.prevent='save'>
            <div class="mt-4">
                <x-label for="name" :value="__('Nome')" />
                <x-input name="name" wire:model.debouce="todo.name" />
                @error('todo.name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="cost" :value="__('Custo (opcional)')" />
                <input class='money-mask' type="text" name='cost' wire:ignore wire:model.defer='todo.cost' placeholder="your cost">
                @error('todo.cost')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="remember_at" :value="__('Lembrar-me em (opcional)')" />
                <x-input type="date" name="remember_at" wire:model.debouce="todo.remember_at" />
                @error('todo.remember_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="description" :value="__('Descrição')" />
                <x-textarea name="description" wire:model.debouce="todo.description" />
                @error('todo.description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="my-4">
                <x-input-file name="file" wire:model.debounce="file" />
                @error('file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <x-button>Salvar</x-button>
            </div>
        </form>
    </x-container>

</div>
