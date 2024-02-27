<?php

namespace App\Imports;

use App\Models\Kanwil;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class KanwilImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // $collection = $collection->sort(function($i) {
        //     return $i['kode'];
        // });
        // dd($collection);
        foreach($collection as $kanwil) {
            Kanwil::updateOrCreate([
                'id' => $kanwil['kode'],
            ], [
                'nama' => $kanwil['nama'],
            ]);
        }
    }
}
