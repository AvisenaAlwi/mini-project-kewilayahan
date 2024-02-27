<?php

namespace App\Imports;

use App\Models\Kppn;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KppnImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $kppn) {
            Kppn::updateOrCreate([
                'id' => $kppn['kode'],
            ], [
                'kanwil_id' => $kppn['kode_kanwil'],
                'nama'      => $kppn['nama'],
            ]);
        }
    }
}
