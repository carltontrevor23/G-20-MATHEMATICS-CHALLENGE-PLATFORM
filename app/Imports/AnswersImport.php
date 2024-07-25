<?php

namespace App\Imports;

use App\Models\Questions;
use Maatwebsite\Excel\Concerns\ToModel ;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class AnswersImport implements ToModel, WithHeadingRow
{
    
    public function model(array $row)
    {
        $question = Questions::where('question', $row['question'])
        ->where('challenge_id', $row['challenge_id'])
        ->first();

        if ($question) {
            $question->update([
                'answer' => $row['answer'],
                'marks' =>$row['marks'],
                'i'
            ]);
        }

        return null;
    }
}
