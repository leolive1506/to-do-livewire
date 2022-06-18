<x-app-layout>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h1>Lista de tarefas</h1>
            <x-button-link href="{{ route('tarefas.create') }}">Nova</x-button-link>
        </div>
    </x-slot>

    <x-container class="mt-4">
        <form action="{{ route('tarefas.index') }}" class="flex items-center gap-4" id="form-search-todo">
            <x-input
                name="search" placeholder="Digite para buscar..."
                value="{{ request()->search ?? null }}"
                onblur="event.preventDefault(); document.querySelector('#form-search-todo').submit()"
            />
            <x-button
                class="h-10"
                onclick="event.preventDefault(); document.querySelector('#search').value = null; document.querySelector('#form-search-todo').submit()"
            >Limpar</x-button>
        </form>

        <div class="mt-4">
            @if (session('status'))
                <div class="text-green-500">{{ session('status') }}</div>
            @endif
            @forelse ($todos as $item)
                <div class="flex justify-between items-center">
                    <div class="flex flex-col gap-2">
                        <form action="{{ route('tarefas.checkbox', $item->id) }}" id="form_completed_{{ $item->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="block mt-4">
                                <label for="completed_{{ $item->id }}" class="inline-flex items-center" onclick="document.querySelector('#form_completed_{{ $item->id }}').submit()">
                                    <input id="completed_{{ $item->id }}" type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="completed"
                                        {{  ($item->completed === 1 ? ' checked' : '') }}
                                    >
                                    <span class="ml-2 text-sm text-gray-600">{{ $item->name }}</span>
                                </label>
                            </div>
                        </form>
                        <div class="w-full flex items-center gap-5">
                            @if (!empty($item->file))
                                @if (isImage($item->file_extension))
                                    <img src="{{ asset($item->file) }}" alt="" class="h-12 w-12 rounded-full object-cover">
                                @else
                                    <x-icons.document class="h-12 w-12 text-gray-600" />
                                    @endif
                                    <p class="flex items-center gap-4">
                                        <strong>Tipo: </strong>{{ $item->file_extension }}
                                        <a href="{{ asset($item->file) }}" download="{{ $item->name }}"><x-icons.dowload /></a>
                                    </p>
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('tarefas.show', $item->id) }}"><x-icons.eye /></a>
                        <a href="{{ route('tarefas.edit', $item->id) }}"><x-icons.pencil /></a>
                        <form method="POST" action="{{ route('tarefas.destroy', $item->id) }}" id="tarefa-delete-{{ $item->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button
                            onclick="event.preventDefault(); document.querySelector('#tarefa-delete-{{ $item->id }}').submit()"
                        >
                            <x-icons.trash />
                        </button>
                    </div>
                </div>
            @empty
                <p>Nenhum item cadastrado</p>
            @endforelse
        </div>
    </x-container>
</x-app-layout>
