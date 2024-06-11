<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-semibold mb-4">Medegebruiker Toevoegen</h2>
                    <form action="{{ route('medegebruiker.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">E-mailadres van de medegebruiker</label>
                            <input id="email" name="email" type="email" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 rounded">Toevoegen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
