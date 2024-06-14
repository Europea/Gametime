<?php

namespace App\Http\Controllers;

use App\Models\ScreenTimePoints;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\GameTime;
use Carbon\Carbon;

class ScreenTimePointsController extends Controller
{
    public function index()
    {
        $currentDateTime = Carbon::now()->format('Y-m-d');
        $nextDateTime = Carbon::now()->addWeek()->format('Y-m-d');
    
        $screenTimePoints = ScreenTimePoints::where('parent_id', Auth::id())->orWhere('child_id', Auth::id())->get();
    
        $gameTime = GameTime::where('kind_id', Auth::id())->get();
    
        $gameTimeAsParent = DB::table('gametime')
            ->select('gametime.*')
            ->whereBetween('gametime.datum', [$currentDateTime, $nextDateTime])
            ->join('parent_child', 'gametime.kind_id', '=', 'parent_child.child_id')
            ->where('parent_child.parent_id', '=', Auth::id())
            ->get();
    
        $ontwikkeling = DB::table('gametime')
            ->select('gametime.*')
            ->whereBetween('gametime.datum', [$currentDateTime, $nextDateTime])
            ->where('geactiveerd', '=', '1')
            ->get();
    
        $totalMinutesPerChild = [];
    
        foreach ($ontwikkeling as $entry) {
            $tijd = Carbon::parse($entry->tijd);
            $tijdafgelopen = Carbon::parse($entry->tijdafgelopen);
    
            $duration = $tijd->diffInMinutes($tijdafgelopen);
    
            if (!isset($totalMinutesPerChild[$entry->kind_id])) {
                $totalMinutesPerChild[$entry->kind_id] = 0;
            }
    
            $totalMinutesPerChild[$entry->kind_id] += $duration;
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
