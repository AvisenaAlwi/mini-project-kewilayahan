<?php

namespace App\Imports;

use App\Models\Satker;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class SatkerImport implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
{

    public function batchSize(): int
    {
        return 1000;
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Satker([
                'id'       => $row['kode'],
                'baes1_id' => $row['kode_baes1'],
                'nama'     => $row['nama'],
            ]);
    }

    public function uniqueBy()
    {
        return 'id';
    }
}
