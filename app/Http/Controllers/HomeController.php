<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenges;
use App\Models\School;
use App\Models\Participants;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //method to display total registered schools, participants and challenges
    public function index()
    {

        $schoolsCount = School::count();
        $participantsCount = Participants::count();
        $challengesCount = Challenges::count();

        $upcoming_challenges = Challenges::where('start_date', '>', now())->get();
        return view('dashboard', compact('upcoming_challenges', 'schoolsCount', 'participantsCount', 'challengesCount'));
    }

}
