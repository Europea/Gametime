<?php

namespace App\Http\Controllers;

use App\Models\ScreenTimePoints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScreenTimePointsController extends Controller
{
    public function index()
    {
        // Haal de schermtijdpunten op voor de ingelogde ouder
        $screenTimePoints = ScreenTimePoints::where('parent_id', Auth::id())->get();

        $points = $screenTimePoints[0]->points;
        $child = auth()->user();

        dd($points);

        return view('screentime', compact('screenTimePoints', 'child'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'minutes' => 'required|integer',
            'points' => 'required|integer',
        ]);

        ScreenTimePoints::create([
            'minutes' => $request->minutes,
            'points' => $request->points,
            'parent_id' => Auth::id(),
        ]);

        return redirect()->route('screen-time-points.index')->with('success', 'Schermtijdpunten succesvol toegevoegd.');
    }

    public function destroy($id)
    {
        $screenTimePoints = ScreenTimePoints::findOrFail($id);

        if ($screenTimePoints->parent_id !== Auth::id()) {
            return redirect()->route('screentime')->with('error', 'Je hebt geen toestemming om deze schermtijdpunten te verwijderen.');
        }

        $screenTimePoints->delete();

        return redirect()->route('screen-time-points.index')->with('success', 'Schermtijdpunten succesvol verwijderd.');
    }

    public function verzilveren($id) {
        $screenTimePoints = ScreenTimePoints::findOrFail($id);

        $points = $screenTimePoints->points;

        dd($points);


    }

    
}
