<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 text-center">
                        @if(Auth::user()->role === 'Ouder')
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md mb-4 w-full mx-auto text-black" style="max-width: 400px;">
                                <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Nieuwe Taak Toevoegen</a>
                            </div>
                        @endif
                        @if(Auth::user()->role === 'Kind')
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md mb-4 w-full mx-auto text-black" style="max-width: 400px;">
                                <p>Aantal punten: {{ $child->points }}</p>
                            </div>
                        @endif

                    </div>

                    <h2 class="text-xl font-semibold mt-4">Taken</h2>
                    <div class="flex flex-col items-center gap-6 mt-4">
                    @foreach($tasksAsMedegebruiker as $task)
                    <div class="w-full max-w-md mx-auto">
                                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md mb-4 relative">
                                    <h3 class="text-lg font-bold">Taak #{{ $loop->iteration }} | {{ $task->omschrijving }}</h3>                                    <p>Waardepunten: {{ $task->waardepunten }}</p>
                                    <p>Datum: {{ $task->datum }}</p>
                                    <div class="task-status {{ $task->voltooid ? 'bg-green-500' : 'bg-red-500' }}">
                                        Status: 
                                        @if($task->voltooid)
                                            <span class="text-black">Voltooid</span>
                                        @else
                                            <span class="text-black">Niet Voltooid</span>
                                        @endif
                                    </div>
                                    @if(Auth::user()->role === 'Ouder' && Auth::id() === $task->controller_idcontroller)
                                        <a href="{{ route('tasks.edit', ['task' => $task->idtaak]) }}" class="absolute top-0 right-0 bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @foreach($tasks as $task)
                            <div class="w-full max-w-md mx-auto">
                                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md mb-4 relative">
                                    <h3 class="text-lg font-bold">Taak #{{ $loop->iteration }} | {{ $task->omschrijving }}</h3>                                    <p>Waardepunten: {{ $task->waardepunten }}</p>
                                    <p>Datum: {{ $task->datum }}</p>
                                    <p>Kind: {{ $task->child ? $task->child->name : 'Onbekend' }}</p>
                                    <div class="task-status {{ $task->voltooid ? 'bg-green-500' : 'bg-red-500' }}">
                                        Status: 
                                        @if($task->voltooid)
                                            <span class="text-black">Voltooid</span>
                                        @else
                                            <span class="text-black">Niet Voltooid</span>
                                        @endif
                                    </div>
                                    @if(Auth::user()->role === 'Ouder' && Auth::id() === $task->controller_idcontroller)
                                        <a href="{{ route('tasks.edit', ['task' => $task->idtaak]) }}" class="absolute top-0 right-0 bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
