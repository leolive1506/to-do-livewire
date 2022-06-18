<x-app-layout>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h1>{{ empty($todo->id) ? 'Nova tarefas' : 'Editar tarefa' }}</h1>
            <x-button-link href="{{ route('tarefas.index') }}">Voltar</x-button-link>
        </div>
    </x-slot>

    <x-container class="mt-4">
        <form action="{{ empty($todo->id) ? route('tarefas.store') : route('tarefas.update', $todo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (!empty($todo->id))
                @method('PUT')
            @endif

            <div class="mt-4">
                <x-label for="name" :value="__('Nome')" />
                <x-input name="name" value="{{ old('name', $todo->name ?? null) }}" />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="cost" :value="__('Custo (opcional)')" />
                <x-input-prepend name="cost" value="{{ old('cost', $todo->cost ?? null) }}" />
                @error('cost')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="remember_at" :value="__('Lembrar-me em (opcional)')" />
                <x-input type="date" name="remember_at" value="{{ old('remember_at', $todo->remember_at ?? null) }}" />
                @error('remember_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="description" :value="__('Descrição')" />
                <x-textarea name="description" value="{{ old('description', $todo->description ?? null) }}" />
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="my-4">
                <x-input-file name="file" />
                @error('file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <x-button>Salvar</x-button>
            </div>
        </form>
    </x-container>
    <script>

    </script>
</x-app-layout>
