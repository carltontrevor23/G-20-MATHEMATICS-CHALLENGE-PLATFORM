<?php

namespace App\Imports;

use App\Models\Questions;
use Maatwebsite\Excel\Concerns\ToModel ;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;

class QuestionsImport implements ToModel, WithHeadingRow
{
        public function model(array $row)
    {
        Log::info('Processing row in QuestionsImport: ', $row);
        
        return new Questions([
            'question'=>$row['question'],
            'challenge_id'=>$row['challenge_id'],
        ]);
    }
}

