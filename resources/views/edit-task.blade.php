<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Taak Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(session('success'))
                        <div class="bg-green-500 text-black p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="omschrijving" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Omschrijving van de taak</label>
                            <input type="text" name="omschrijving" id="omschrijving" value="{{ $task->omschrijving }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div class="mb-4">
                            <label for="waardepunten" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Waardepunten</label>
                            <input type="number" name="waardepunten" id="waardepunten" value="{{ $task->waardepunten }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div class="mb-4">
                            <label for="datum" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Datum</label>
                            <input type="date" name="datum" id="datum" value="{{ $task->datum }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div class="mb-4">
                            <label for="voltooid" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Voltooid</label>
                            <input type="checkbox" name="voltooid" id="voltooid" value="1" {{ $task->voltooid ? 'checked' : '' }} class="shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Opslaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
