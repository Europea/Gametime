<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Formulier voor het toevoegen van een nieuw kind -->
                    <form action="{{ route('parent.addChild') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">E-mailadres van het kind:</label>
                            <input type="email" id="email" name="email" required placeholder="E-mailadres van het kind" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 rounded focus:outline-none focus:shadow-outline">Toevoegen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
