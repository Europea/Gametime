<x-app-layout>
    <div class="container mx-auto py-12">
        @if(auth()->user()->role === 'Kind')
            @if(isset($child))
                <div class="w-full flex justify-center">
                    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6 text-center mb-6">
                        <h2 class="text-xl font-semibold mb-4">Jouw Schermtijdpunten</h2>
                        <p class="text-3xl font-bold">{{ $child->points }}</p>
                    </div>
                </div>
            @endif
        @endif

        @if(auth()->user()->role === 'Ouder')
            <h1 class="text-2xl font-semibold text-center mb-6">Schermtijdpunten Beheren</h1>

            <form action="{{ route('screen-time-points.store') }}" method="POST" class="bg-white p-6 rounded shadow-md mb-6 max-w-lg mx-auto">
                @csrf
                <div class="mb-4">
                    <label for="minutes" class="block text-gray-700 font-medium mb-2">Minuten</label>
                    <input type="number" name="minutes" class="form-control w-full border border-gray-300 p-2 rounded" id="minutes" required>
                </div>
                <div class="mb-4">
                    <label for="points" class="block text-gray-700 font-medium mb-2">Punten</label>
                    <input type="number" name="points" class="form-control w-full border border-gray-300 p-2 rounded" id="points" required>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Toevoegen</button>
            </form>
        @endif

        <h2 class="text-xl font-semibold mt-8 mb-4 text-center">Huidige Schermtijdpunten</h2>
        <div class="w-full flex justify-center">
            <div class="w-full max-w-3xl bg-white p-6 rounded shadow-md mx-auto">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Minuten</th>
                                <th class="py-2 px-4 border-b">Punten</th>
                                @if(auth()->user()->role === 'Kind')
                                    <th class="py-2 px-4 border-b">Datum</th>
                                    <th class="py-2 px-4 border-b">Tijd</th>
                                    <th class="py-2 px-4 border-b">Toepassing</th>
                                @endif
                                <th class="py-2 px-4 border-b">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($screenTimePoints as $stp)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $stp->minutes }}</td>
                                    <td class="py-2 px-4 border-b">{{ $stp->points }}</td>
                                    <form action="{{ route('screen-time-points.verzilveren', $stp->id) }}" method="POST">
                                    @csrf
                                    @if(auth()->user()->role === 'Kind')
                                        <td class="py-2 px-4 border-b 3">
                                            <input type="date" name="datum" id="datum" required min="{{date('Y-m-d')}}" placeholder="Datum" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                                        </td>
                                        <td class="py-2 px-4 border-b 2">
                                            <input type="time" name="time" id="time" placeholder="Time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">

                                        </td>
                                        <td class="py-2 px-4 border-b 4">
                                            <input type="text" name="toepassing" id="toepassing" placeholder="Toepassing" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-200">
                                        </td>
                                    @endif
                                        @if(auth()->user()->role === 'Kind')
                                        <td class="py-2 px-4 border-b 2">
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">Verzilveren</button>
                                        </td>
                                        @endif
                                    </form>
                                    <td class="py-2 px-4 border-b">
                                        @if(auth()->user()->role === 'Ouder')
                                            <form action="{{ route('screen-time-points.destroy', $stp->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze schermtijdpunten wilt verwijderen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 rounded">Verwijderen</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h1 class="py-4">Verzilverde tijd</h>
                    @foreach($gameTimeAsParent as $gtas)
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">ID</th>
                                <th class="py-2 px-4 border-b">Datum</th>
                                <th class="py-2 px-4 border-b">Tijd</th>
                                <th class="py-2 px-4 border-b">Aantal Minuten</th>
                                <th class="py-2 px-4 border-b">Toepassing</th>
                                <th class="py-2 px-4 border-b">Geaccepteerd?</th>
                                @if(auth()->user()->role === 'Ouder')
                                    @if(!$gtas->geactiveerd)
                                        <th class="py-2 px-4 border-b">Acties</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b">
                                 {{ $gtas->id }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                 {{ $gtas->datum }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                 {{ $gtas->tijd }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                 {{ $gtas->tijdafgelopen }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                 {{ $gtas->toepassing }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                    @if($gtas->geactiveerd)
                                        <span class="text-black">Geaccepteerd</span>
                                    @else
                                        <span class="text-black">Niet Geaccepteerd</span>
                                    @endif
                                </td>
                                @if(auth()->user()->role === 'Ouder')
                                <td class="py-2 px-4 border-b">
                                    <form action="{{ route('screen-time-points.accept', $gtas->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze schermtijdpunten wilt verwijderen?');">
                                            @csrf
                                            @if(!$gtas->geactiveerd)
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 rounded">Accepteren</button>
                                            @endif
                                    </form>
                                </td>
                                @endif
                            </tr>
                        </tbody>
                    @endforeach
                    </table>
                    @foreach($gameTime as $gt)
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">ID</th>
                                <th class="py-2 px-4 border-b">Datum</th>
                                <th class="py-2 px-4 border-b">Tijd</th>
                                <th class="py-2 px-4 border-b">Aantal Minuten</th>
                                <th class="py-2 px-4 border-b">Toepassing</th>
                                <th class="py-2 px-4 border-b">Geaccepteerd?</th>
                                @if(auth()->user()->role === 'Ouder')
                                <th class="py-2 px-4 border-b">Acties</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b">
                                 {{ $gt->id }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                 {{ $gt->datum }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                 {{ $gt->tijd }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                 {{ $gt->tijdafgelopen }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                 {{ $gt->toepassing }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                    @if($gt->geactiveerd)
                                        <span class="text-black">Geaccepteerd</span>
                                    @else
                                        <span class="text-black">Niet Geaccepteerd</span>
                                    @endif
                                </td>
                                @if(auth()->user()->role === 'Ouder')
                                <td class="py-2 px-4 border-b">
                                    <form action="{{ route('screen-time-points.destroy', $stp->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze schermtijdpunten wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 rounded">Accepteren</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        </tbody>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
