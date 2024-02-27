<?php

namespace App\Imports;

use App\Models\Ro;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class RoImport implements ToCollection, WithHeadingRow
// , WithBatchInserts, WithUpserts
{
    // public function batchSize(): int
    // {
    //     return 1;
    // }

    // /**
    // * @param Collection $collection
    // */
    // public function model(array $row)
    // {
    //     return new Ro([
    //         'id' => $row['kode'],
    //         'kro_id' => $row['kode_kro'],
    //         'uraian' => $row['uraian'] ?? '-',
    //     ]);
    // }

    function collection(Collection $collection)
    {
        foreach ($collection as $col) {
            Ro::updateOrCreate([
                'id' => $col['kode'],
                'kro_id' => $col['kode_kro'],
                'uraian' => $col['uraian'] ?? '-'
            ], [
            ]);
        }
    }

    // public function uniqueBy()
    // {
    //     return ['id', 'kro_id'];
    // }
}
