<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportQuestions extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'import:questions {file}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Import questions and answers from an Excel file';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error('File not found!');
            return 1;
        }

        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $cells = [];
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }

            // Assuming the first cell is the question and the second cell is the answer
            if (count($cells) >= 2) {
                $this->info('Question: ' . $cells[0]);
                $this->info('Answer: ' . $cells[1]);
                $this->info(''); // Print a blank line for spacing
            }
        }

        return 0;
    }
}
