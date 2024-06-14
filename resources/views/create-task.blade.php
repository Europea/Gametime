<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe Taak Toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Formulier voor het toevoegen van een nieuwe taak -->
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="omschrijving" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Omschrijving van de taak</label>
                            <input type="text" name="omschrijving" id="omschrijving" placeholder="Omschrijving van de taak" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div class="mb-4">
                            <label for="waardepunten" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Waardepunten</label>
                            <input type="number" name="waardepunten" id="waardepunten" placeholder="Waardepunten" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div class="mb-4">
                            <label for="datum" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Datum</label>
                            <input type="date" name="datum" id="datum" placeholder="Datum" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div class="mb-4">
                            <label for="kind_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Selecteer een kind</label>
                            <select name="kind_id" id="kind_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200"  required>
                                <option value="">Selecteer een kind</option>
                                @foreach($children as $child)
                                    <option value="{{ $child->id }}">{{ $child->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 rounded focus:outline-none focus:shadow-outline">Toevoegen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
