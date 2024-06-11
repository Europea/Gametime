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
    
        $child = User::where('email', $request->email)->first();
    
        
        if (!auth()->user()->children->contains($child)) {

            auth()->user()->children()->save($child);
            
            return redirect()->back()->with('success', 'Kind succesvol toegevoegd!');
        } else {
            return redirect()->back()->with('error', 'Kind is al aan de ouder gekoppeld!');
        }
    }
}    