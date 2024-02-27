<?php

namespace App\Imports;

use App\Models\Program;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProgramImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $program) {
            Program::updateOrCreate([
                'id' => $program['kode'],
            ], [
                'uraian' => $program['uraian'],
            ]);
        }
    }
}
