<?php

namespace App\Imports;

use App\Models\KabupatenKota;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KabupatenKotaImport implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
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
        return new KabupatenKota([
                'id'         => $row['kode'],
                'provinsi_id' => $row['kode_prov'],
                'nama'     => $row['nama'],
            ]);
    }

    public function uniqueBy()
    {
        return 'id';
    }
}
