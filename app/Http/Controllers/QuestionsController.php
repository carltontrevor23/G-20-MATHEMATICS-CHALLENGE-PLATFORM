<?php

namespace App\Http\Controllers;

use App\Imports\QuestionsImport;
use App\Imports\AnswersImport;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;


class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function upload (Request $request)
    {
        $request->validate([
            'question_file' => 'required|file|mimes:xlsx,xls',
            'answer_file' => 'required|file|mimes:xlsx,xls',
        ]);

        $questions = $request->file('question_file');
        $answers = $request->file('answer_file');

        DB::beginTransaction();

        try{
            Excel::import(new QuestionsImport, $questions);

            Excel::import(new AnswersImport, $answers);  
            
            /*Excel::import(new QuestionsImport, $questions, null, \Maatwebsite\Excel\Excel::xlsx, [
                'chunk'=>1000
            ]);*/

            DB::commit();

            $questionCount = Questions::count();
            //$answerCount = Answers::count();
            

            Log::info("After import: {$questionCount} questions in database");

            return back()->with('success', 'Questions and Answers uploaded successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Import failed: '.$e->getMessage());
            return back()->withErrors(['msg'=>'Upload failed.']);
            
        }
    }
    
}
