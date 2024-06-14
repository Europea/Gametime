<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ParentChildController extends Controller
{

    public function showAddChildForm()
    {
        return view('add-child');
    }
    

    public function addChild(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email,role,Kind'
        ]);
    
        $email = $request->input('email');


        $child = User::where('email', $email)->first();
    
        if($child) {
            if (!auth()->user()->children->contains($child)) {

                auth()->user()->children()->save($child);

                return redirect()->route('tasks.index')->with('message', 'Kind succesvol toegevoegd!');
            }else{
                return redirect()->route('tasks.index')->with('message', 'Kind is al aan de ouder gekoppeld!');
            }
        }else{
            return redirect()->route('tasks.index')->with('message', 'Email bestaat niet!');
        }
    }
}    