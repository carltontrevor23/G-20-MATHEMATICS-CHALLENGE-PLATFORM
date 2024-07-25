<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenges;
use App\Models\School;
use App\Models\Participants;

class GuestViewController extends Controller
{
    
    //method to display total registered schools, participants and challenges
    public function index()
    {
        $schoolsCount = School::count();
        $participantsCount = Participants::count();
        $challengesCount = Challenges::count();

        $upcoming_challenges = Challenges::where('start_date', '>', now())->get();
        return view('pages.guest-view', compact('upcoming_challenges', 'schoolsCount', 'participantsCount', 'challengesCount'));
    }
    
}
