<?php

namespace App\Imports;

use App\Models\Provinsi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProvinsiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $provinsi) {
            Provinsi::updateOrCreate([
                'id' => $provinsi['kode'],
            ],[
                'nama' => $provinsi['nama'],
            ]);
        }
    }
}
