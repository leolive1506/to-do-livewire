<x-app-layout>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h1>Viualização de uma tarefa</h1>
            <x-button-link href="{{ route('tarefas.index') }}">Voltar</x-button-link>
        </div>
        </x-slot>

        <x-container class="mt-4">
            <div class="mt-4">
                <div class="flex justify-center">
                    <div class="rounded-lg shadow-lg bg-white max-w-sm">
                        <a href="#!" data-mdb-ripple="true" data-mdb-ripple-color="light">
                            <img
                                class="rounded-t-lg h-full max-h-44 w-full object-cover"
                                src="{{
                                    empty($todo->file)
                                    ? ('https://source.unsplash.com/1600x900/?beach') : asset($todo->file) }}"
                                alt=""
                            />
                        </a>
                        <div class="p-6">
                            <h5 class="text-gray-900 text-xl font-medium mb-2">{{ $todo->name }}</h5>
                            @if (!empty($todo->file))
                                <p>
                                    <strong class="text-gray-900">Extensão do arquivo: </strong>
                                    {{ $todo->file_extension }}
                                </p>
                            @endif
                            @if (!empty($todo->remember_at))
                                <p>
                                    <strong class="text-gray-900">Lembrar em: </strong>
                                    {{ $todo->remember_at_formated }}
                                </p>
                            @endif
                            @if (!empty($todo->cost))
                                <p>
                                    <strong class="text-gray-900">Custo: </strong>
                                    {{  $todo->cost_formated }}
                                </p>
                            @endif
                            <p class="text-gray-700 text-base mb-4 max-w-[20rem] min-w-[20rem]">
                                {{ $todo->description }}
                            </p>
                            <form action="{{ route('tarefas.checkbox', $todo->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="completed" value="{{ $todo->completed ? null : 'on' }}">
                                <x-button
                                    class=" bg-blue-600 text-white hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  active:bg-blue-800">
                                    {{ $todo->completed ? 'Desmarcar como feita' : 'Marcar como feita' }}
                                </x-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
</x-app-layout>
