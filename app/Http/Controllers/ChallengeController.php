<?php

namespace App\Http\Controllers;

use App\Models\Challenges;
use App\Models\Questions;
use App\Models\Participants;
use App\Models\Attempts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\QuestionsImport;
use App\Imports\AnswersImport;
use Illuminate\Support\Facades\DB;

class ChallengeController extends Controller
{
    
    public function index()
    {
        $allChallenges = Challenges::all();
        $navName = 'Challenges';

        
        return view ('challenges/upload-challenge', compact('allChallenges'));
    }

    public function store(Request $request)
    {
        $challenges = new Challenges();
        $challenges->challenge_name = $request->input('challenge_name');
        $challenges->start_date = $request->input('start_date');
        $challenges->end_date = $request->input('end_date');
        $challenges->duration = $request->input('duration');
        $challenges->number_of_questions = $request->input('number_of_questions');

        $challenges->save();

        return back()->with('success', 'Challenge Parameters uploaded successfully.');
    }

    public function displayChallengeDetails()
    {
        $challenges = Challenges::all();

        if($challenges->isEmpty()) {
            dd('No challenges found');
        }

        $challengeBestParticipants = [];

        foreach ($challenges as $challenge) {
        $bestParticipants = Participants::join('attempts', 'participants.id', '=', 'attempts.participant_id')
        ->where('attempts.challenge_id', $challenge->id)
        ->select('participants.username', 'attempts.score')
        ->orderBy('attempts.score', 'desc')
        ->take(2)
        ->get()
        ->map(function ($participant, $index) {
            $participant->position = $index + 1;
            return $participant;
        });

        $challengeBestParticipants[$challenge->id]=[
            'challenge'=> $challenge,
            'participants'=> $bestParticipants,
        ];

    }

        return view ('pages.challenges', compact('challenges', 'challengeBestParticipants'));
    }
}

