<?php

namespace App\Http\Controllers;

use App\Models\ScreenTimePoints;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\GameTime;
use Carbon\Carbon; // Haalt carbon op

class ScreenTimePointsController extends Controller
{
    public function index()
    {
        $currentDateTime = Carbon::now()->format('Y-m-d'); // Pakt de tijd van nu en zet het in het formaat (2024-06-20)
        $nextDateTime = Carbon::now()->addWeek()->format('Y-m-d'); // Pakt de tijd van nu en voegt er een extra week bij. 
    
        $screenTimePoints = ScreenTimePoints::where('parent_id', Auth::id())->orWhere('child_id', Auth::id())->get(); // Checkt de child_id en de parent_id en checkt welke jij bennt.
    
        $gameTime = GameTime::where('kind_id', Auth::id())->get(); 
    
        $gameTimeAsParent = DB::table('gametime') // Pakt alles uit de schermtijd app en checkt of jij de ouder bent van een kind.
            ->select('gametime.*')
            ->whereBetween('gametime.datum', [$currentDateTime, $nextDateTime])
            ->join('parent_child', 'gametime.kind_id', '=', 'parent_child.child_id')
            ->where('parent_child.parent_id', '=', Auth::id())
            ->get();
    
        $ontwikkeling = DB::table('gametime') // Checkt alle schermtijden en checkt of hij geactiveerd is.
            ->select('gametime.*')
            ->whereBetween('gametime.datum', [$currentDateTime, $nextDateTime])
            ->where('geactiveerd', '=', '1')
            ->get();
    
        $totalMinutesPerChild = []; // Maakt een soort array aan.
    
        foreach ($ontwikkeling as $entry) { // Checkt door elke Tabel heen
            $tijd = Carbon::parse($entry->tijd); // Pakt de tijd uit de DB
            $tijdafgelopen = Carbon::parse($entry->tijdafgelopen); // Pakt de tijdafgelopen uit de DB
    
            $duration = $tijd->diffInMinutes($tijdafgelopen); // Haalt de tijd van de tijdafgelopen af en checkt hoeveel het verschil is.
    
            if (!isset($totalMinutesPerChild[$entry->kind_id])) { // Als het kind_id nog niet in de $totalMinutesPerChild[] zit doet ie het volgende.
                $totalMinutesPerChild[$entry->kind_id] = 0; // Zet de tijd naar 0
            }
    
            $totalMinutesPerChild[$entry->kind_id] += $duration; // Hier voegt hij de echte tijd erbij 
        }
    
        return view('screentime', compact('screenTimePoints', 'gameTime', 'gameTimeAsParent', 'totalMinutesPerChild'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'minutes' => 'required|integer',
            'points' => 'required|integer',
        ]);

        $child = $this->getChildByParentId(Auth::id());


        if (!$child) {
            return redirect()->route('tasks.index')->with('message', 'Het kind van de ouder kon niet worden gevonden.');
        }

        $gtas = ScreenTimePoints::create([
            'minutes' => $request->minutes,
            'points' => $request->points,
            'parent_id' => Auth::id(),
            'child_id' => $child,
        ]);

        return redirect()->route('screen-time-points.index')->with('message', 'Schermtijdpunten succesvol toegevoegd.');
    }

    public function destroy($id)
    {
        $screenTimePoints = ScreenTimePoints::findOrFail($id);

        if ($screenTimePoints->parent_id !== Auth::id()) {
            return redirect()->route('screentime')->with('message', 'Je hebt geen toestemming om deze schermtijdpunten te verwijderen.');
        }

        $screenTimePoints->delete();

        return redirect()->route('screen-time-points.index')->with('message', 'Schermtijdpunten succesvol verwijderd.');
    }

    public function verzilveren(Request $request, $id) {
        $screenTimePoints = ScreenTimePoints::findOrFail($id);

        $points = $screenTimePoints->points;

        if(Auth()->user()->points >= $points) {

            $request->validate([
                'datum' => 'required|date',
                'time' => 'date_format:H:i',
                'toepassing' => 'required|max:255',
            ]);



            $selectedTime = $request->time;

            $minutes_to_add = $screenTimePoints->minutes;
        

            $endTime = strtotime("+$minutes_to_add minutes", strtotime($selectedTime)); // Dit rekent de minuten bij de tijd zodat je ziet wanneer de schermtijd is afgelopen. 

            GameTime::create([ // Maakt de gametime aan zodat het in de database staat.
                'kind_id' => Auth::id(),
                'datum' => $request->datum,
                'tijd' => $request->time,
                'geactiveerd' => 0,
                'tijdafgelopen' => date('h:i:s', $endTime),
                'toepassing' => $request->toepassing,
            ]);

            Auth()->user()->points -= $points; // Verwijdert de punten bij het kind omdat hij zijn schermtijd heeft verzilverd.

            Auth()->user()->save();
        }

        return redirect()->route('screen-time-points.index')->with('success', 'Schermtijd succesvol verzilverd.');
    }

    protected function getChildByParentId($parentId) // Hiermee checkt hij het kind van de Ouder.
    {

        
        $parentChild = DB::table('parent_child')
                        ->where('parent_id', $parentId)
                        ->first();
    
        if ($parentChild) {
            $child = User::find($parentChild->child_id);
    
            return $child->id;

    
        } else {
            return null;
        }
    }

    public function AcceptGameTime($id) {
        $updateDetails = GameTime::where('id', "=", $id)->first(); // Hiermee pakt hij de taak met het id wat opgegeven word.
        $updateDetails->geactiveerd = '1'; // Hiermee zet hij de taak op geaccepteerd
        $updateDetails->save(); // Hiermee slaat hij de gametime op.
    }
    
}
