<?php

namespace App\Http\Controllers;

use App\Models\ScreenTimePoints;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\GameTime;

class ScreenTimePointsController extends Controller
{
    public function index()
    {
        // Haal de schermtijdpunten op voor de ingelogde ouder op of van het kind zelf.
        $screenTimePoints = ScreenTimePoints::where('parent_id', Auth::id())->orWhere('child_id', Auth::id())->get();

        $gameTime = GameTime::where('kind_id', Auth::id())->get();

        $gameTimeAsParent = DB::table('gametime') // Join functie om de Schermtijd aan de ouder te kunnen laten zien.
        ->select('gametime.*') // Hier select hij alles van GameTime
        ->join('parent_child', 'gametime.kind_id', '=', 'parent_child.child_id') // Hier checkt hij of het parent_child.child_id gelijk staat aan de gametime.kind_id
        ->where('parent_child.parent_id', '=', Auth::id()) // Hier checkt hij of de parent_child.parent_id gelijk staat aan de ingelogde User. Zoja, dan laat hij de Schermtijden zien van zijn kind.
        ->get();

        $child = auth()->user();


        return view('screentime', compact('screenTimePoints', 'gameTime', 'gameTimeAsParent', 'child'));
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
            'child_id' => $this->getChildByParentId(Auth::id()),
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

    public function verzilveren(Request $request, $id) {
        $screenTimePoints = ScreenTimePoints::findOrFail($id);

        $points = $screenTimePoints->points;

        if(Auth()->user()->points >= $points) {

            $request->validate([
                'datum' => 'required|date',
                'time' => 'date_format:H:i',
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
