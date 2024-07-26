<?php

namespace App\Http\Controllers;

use App\Models\Schools;
use App\Models\Attempts;
use App\Models\Participants;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
        // method to show analytics for the specified challenge or overall if no challenge ID is provided
        public function showAnalytics($challengeId){
            $challengeId=1;
            $rankedSchools = Participants::join('attempts', 'participants.id', '=','attempts.participant_id')
            ->join('schools','participants.school_id','=','schools.id')
            ->select('schools.name as school_name', 'schools.district', \DB::raw('SUM(attempts.score)as total_score'))
            ->groupBy('schools.name', 'schools.district')
            ->orderBy('total_score','desc')
            ->get();

        $mostCorrectlyAnsweredQuestions = DB::table('questions')
        ->join('answers','questions.id','=','answers.question_id')
        ->select('questions.question', DB::raw('COUNT(answers.is_correct) as correct_count'))//selects the question text and the count of correct answers.
        ->where('answers.is_correct', true)//filters only the correct answers
        ->groupBy('questions.id', 'questions.question')//groups by both the question ID and the question
        ->orderBy('correct_count','desc')//orders the results by the count of correct answers in descending order.
        ->get();

        $schoolPerformanceOverTime = DB::table('scores')
        ->join('participants','scores.participant_id','=','participants.id')
        ->join('schools','participants.school_id','=','schools.id')
        ->select('schools.name', DB::raw('YEAR(scores.created_at) as year'), DB::raw('SUM(scores.score) as total_score')) 
        ->groupBy('schools.name','year')
        ->orderBy('year','asc') 
        -> get();

        //fetch performance data for graphs
        $participantPerformanceOverTime = DB::table('scores')
        ->join('participants','scores.participant_id','=','participants.id')
        ->select('participants.username', DB::raw('YEAR(scores.created_at) as year'), DB::raw('SUM(scores.score) as total_score'))
        ->groupBy('participants.username','year') 
        ->orderBy('year','asc') 
        ->get();

        // calculate question repetition percentage for each participant
        $participants = DB::table('participants')->get();
        $participantRepetitions = [];

        foreach ($participants as $participant) {
            $attempts= DB::table('attempts')
            ->where('participant_id',  $participant -> id)
            ->pluck('questions_attempted');


            $allQuestions = [];
            foreach ($attempts as $attempt){
                $questions=json_decode($attempt);
                if($questions){
                    $allQuestions= array_merge($allQuestions, $questions);
                }
            }

            $questionCounts= array_count_values($allQuestions);
            $totalQuestions= count($allQuestions);
            $repeatedQuestions= 0;


            foreach($questionCounts as $count){
                if($count > 1){
                    $repeatedQuestions += ($count - 1);
            }
        }

        $repetitionPercentage = 0;
        if($totalQuestions > 0){
            $repetitionPercentage = ($repeatedQuestions / $totalQuestions) *100;
        }


        $participantRepetitions[] = [
            'participant_id'=> $participant->id,
            'username'=> $participant->username,
            'repetition_percentage'=> $repetitionPercentage,
        ];
    }

    //retrieve the worst performing schools for the specified challenge

    //query to get the total scores for each school for the given challenge
    $challengeScore = DB::table('attempts')
    ->join('participants','attempts.participant_id','=','participants.id')
    ->join('schools','participants.school_id','=','schools.id')
    ->select('schools.name', 'schools.district', DB::raw('SUM(attempts.score) as total_score'))
    ->where('attempts.challenge_id', $challengeId)
    ->groupBy('schools.id', 'schools.name', 'schools.district')
    ->orderBy('total_score','asc')
    ->get();

    $challengeName = null;

    $challenge = DB::table('challenges')
        ->where('id', $challengeId)
        ->first();

        $challengeName = $challenge ? $challenge->challenge_name :'null';


    $bestSchoolsForAllCha= DB::table('challenges')
    ->leftJoin('attempts','challenges.id','=','attempts.challenge_id')
    ->leftJoin('participants','attempts.participant_id','=','participants.id')
    ->leftJoin('schools','participants.school_id','=','schools.id')
    ->select('challenges.challenge_name as challenge_name', 'challenges.id as challenge_id', 'schools.name as school_name', DB::raw('SUM(attempts.score) as total_score'))
    ->groupBy('challenges.id', 'schools.name', 'challenges.challenge_name')
    ->orderBy('total_score','desc')
    ->get()
    ->groupBy('challenge_id')
    ->map(function ($challenges){
        return $challenges->sortByDesc('total_score')->first();
    });


     $incompleteParticipants= DB::table('participants')
     ->join('attempts','participants.id','=','attempts.participant_id')
     ->join('challenges','attempts.challenge_id','=','challenges.id')
     ->select('participants.id', 'participants.username', 'challenges.challenge_name', 'attempts.questions_attempted', 'challenges.number_of_questions')
     ->whereColumn('attempts.questions_attempted', '<','challenges.number_of_questions')
     ->get();

    //  process the questions_attempted to count the strings in the array
    foreach($incompleteParticipants as $participant){
        $questionsArray=json_decode($participant->questions_attempted, true);
        $participant->questions_attempted_count = is_array($questionsArray) ? count($questionsArray) :0;
    }

        // Pass all data to the view
            return view('pages.analytics', compact('mostCorrectlyAnsweredQuestions', 'rankedSchools', 'schoolPerformanceOverTime', 'participantPerformanceOverTime', 'participantRepetitions', 'challengeScore', 'challengeName', 'bestSchoolsForAllCha', 'incompleteParticipants')); //pass the data to the view
        }
}

