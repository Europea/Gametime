<?php

namespace App\Http\Controllers;

use App\Models\UserRelation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


            UserRelation::create([
                'user_id' => Auth::id(),
                'related_user_id' => $medegebruiker->id,
            ]);

            return redirect()->route('tasks.index')->with('message', 'Medegebruiker succesvol toegevoegd!');
        } else {
            return redirect()->route('tasks.index')->with('message', 'Error: Gebruiker niet gevonden met dit E-mailadress!');
        }
    }
}
