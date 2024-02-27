<?php

namespace App\Console\Commands;

use App\Imports\ReferenceImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportReference extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-reference';

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
        $import = new ReferenceImport();
        // $import->onlySheets('KANWIL DJPB');
        Excel::import($import, base_path('/REFERENSI DATA RAW KEWILAYAHAN.xlsx'));
    }
}
