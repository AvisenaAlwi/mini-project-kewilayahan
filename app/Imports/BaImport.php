<?php

namespace App\Imports;

use App\Models\Ba;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $ba) {
            Ba::updateOrCreate([
                'id' => $ba['kode'],
            ], [
                'nama' => $ba['nama'],
            ]);
        }
    }
}
