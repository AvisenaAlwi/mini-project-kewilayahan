<?php

namespace App\Console\Commands;

use App\Imports\DataImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->title('Starting import');
        // Excel::import(new DataImport(), base_path('/Raw Data Kewilayahan.xlsx'));
        (new DataImport)->withOutput($this->output)->import(base_path('/Raw Data Kewilayahan.csv'));
        $this->output->success('Import successful');
    }
}
