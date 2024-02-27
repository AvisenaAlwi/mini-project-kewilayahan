<?php

namespace App\Imports;

use App\Models\Baes1;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Baes1Import implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $baes1) {
            Baes1::updateOrCreate([
                'id' => $baes1['kode'],
            ], [
                'ba_id' => $baes1['kode_ba'],
                'nama'  => $baes1['nama'],
            ]);
        }
    }
}
