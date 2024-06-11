<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Voeg de import toe voor de User-klasse

class UserRelationController extends Controller
{
    public function index()
    {
        return view('relations-add');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'email' => 'required|email',
        ]);


        $email = $request->input('email');


        $medegebruiker = User::where('email', $email)->first();


        if ($medegebruiker) {

            auth()->user()->relatedUsers()->attach($medegebruiker->id);
            return redirect()->route('tasks.index')->with('success', 'Medegebruiker succesvol toegevoegd!');
        } else {

            return redirect()->back()->with('error', 'Geen gebruiker gevonden met dit e-mailadres.');
        }
    }
}
