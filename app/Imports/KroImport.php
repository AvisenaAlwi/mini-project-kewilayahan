<?php

namespace App\Imports;

use App\Models\Kro;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KroImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $kro) {
            Kro::updateOrCreate([
                'id' => $kro['kode'],
            ], [
                'uraian' => $kro['uraian'],
            ]);
        }
    }
}
