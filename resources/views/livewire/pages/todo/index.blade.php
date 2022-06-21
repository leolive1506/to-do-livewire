<div>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h1>Lista de tarefas</h1>
        </div>
    </x-slot>

    <x-container class="mt-4">
        <div class="flex gap-4">
            <x-input name="search" type="search" wire:model.debouce="search" />
            <x-button wire:click.prevent="$set('currentView', 'form')">Nova</x-button>
        </div>

        <div class="mt-4">
            @if (session('status'))
                <div class="text-green-500">{{ session('status') }}</div>
            @endif
            @forelse ($todos as $item)
                <div class="flex justify-between items-center">
                    <div class="flex flex-col gap-2">
                        <div class="block mt-4">
                            <label for="{{ $item['id'] }}.completed"
                                class="inline-flex items-center"
                            >
                                <input id="{{ $item['id'] }}.completed" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="{{ $item['id'] }}.completed"
                                    {{ !empty($item->completed) ? ' checked' : '' }}
                                    wire:click="checkboxRequest('{{ $item['id']}}.completed')"
                                >
                                <span class="ml-2 text-sm text-gray-600">{{ $item->name }}</span>
                            </label>
                        </div>
                        <div class="w-full flex items-center gap-5">
                            @if (!empty($item->file))
                                @if (isImage($item->file_extension))
                                    <img src="{{ asset($item->file) }}" alt=""
                                        class="h-12 w-12 rounded-full object-cover">
                                @else
                                    <x-icons.document class="h-12 w-12 text-gray-600" />
                                @endif
                                <p class="flex items-center gap-4">
                                    <strong>Tipo: </strong>{{ $item->file_extension }}
                                    <a href="{{ asset($item->file) }}" download="{{ $item->name }}">
                                        <x-icons.dowload />
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="show({{ $item }})">
                            <x-icons.eye />
                        </button>
                        <a href="{{ route('todo', $item->id) }}">
                            <x-icons.pencil />
                        </a>
                        <button wire:click="destroy({{ $item }})">
                            <x-icons.trash />
                        </button>
                    </div>
                </div>
            @empty
                <p>Nenhum item cadastrado</p>
            @endforelse
        </div>
    </x-container>
</div>
