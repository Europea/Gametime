<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        $medegebruiker = auth()->user();
        $medegebruikerId = $medegebruiker->id;
    
        $tasksAsMedegebruiker = DB::table('taak')
                     ->select('taak.*')
                     ->join('parent_child', 'taak.kind_id', '=', 'parent_child.child_id')
                     ->join('user_relations', 'parent_child.parent_id', '=', 'user_relations.user_id')
                     ->where('user_relations.related_user_id', $medegebruikerId)
                     ->get();
    
        $tasksAsController = Task::where('controller_idcontroller', $userId)->get();
        $tasksAsChild = Task::where('kind_id', $userId)->get();
        $tasks = Task::where('controller_idcontroller', $userId)
                     ->orWhere('kind_id', $userId)
                     ->get();
    
        $child = null;
        if (Auth::user()->role === 'Kind') {
            $child = User::find($userId);
        }
    
        return view('tasks', compact('tasks', 'child', 'tasksAsMedegebruiker'));
    }
    
    
    

    public function create()
    {
        $children =h::user()->children;
     Aut
        if (Auth::user()->role !== 'Ouder') {
            return redirect()->route('tasks.index')->with('error', 'Je hebt geen toestemming om taken toe te voegen of er zijn geen kinderen gekoppeld aan jouw account.');
        }
    
        $relatedUsers = Auth::user()->relatedUsers()->get();

        foreach ($relatedUsers as $relatedUser) {
            $children = $children->merge($relatedUser->children);
        }

        return view('create-task', compact('children'));
    }
    

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'Ouder') {
            return redirect()->route('tasks.index')->with('error', 'Je hebt geen toestemming om taken toe te voegen.');
        }
    
        $child = $this->getChildByParentId(Auth::id());
    
        if (!$child) {
            return redirect()->route('tasks.index')->with('error', 'Het kind van de ouder kon niet worden gevonden.');
        }


        $children = Auth::user()->children;
    
        $request->validate([
            'omschrijving' => 'required|max:255',
            'waardepunten' => 'required|integer',
            'datum' => 'required|date',
        ]);

        $task = Task::create([
            'omschrijving' => $request->omschrijving,
            'waardepunten' => $request->waardepunten,
            'datum' => $request->datum,
            'voltooid' => 0,
            'controller_idcontroller' => Auth::id(),
            'kind_id' => $child->id,
        ]);
    
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::where('idtaak', $id)
                    ->where('controller_idcontroller', Auth::id())
                    ->firstOrFail();
        return view('edit-task', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->controller_idcontroller !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Je hebt geen toestemming om deze taak bij te werken.');
        }
    
        if (!$task->voltooid && $request->has('voltooid') && $request->voltooid) {
            $child = User::find($task->kind_id);
            $child->points += $task->waardepunten;
            $child->save();

            $task->delete();

            return redirect()->route('tasks.index')->with('success', 'Taak voltooid en verwijderd.');

        }
    
        $task->update($request->all());
    
        return redirect()->route('tasks.index');
    }

    protected function getChildByParentId($parentId)
    {
        $parentChild = DB::table('parent_child')
                        ->where('parent_id', $parentId)
                        ->first();
    
        if ($parentChild) {
            $child = User::find($parentChild->child_id);
    
            return $child;
        } else {
            return null;
        }
    }
}
