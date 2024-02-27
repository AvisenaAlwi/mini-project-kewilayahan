<?php

namespace App\Imports;

use App\Models\Kegiatan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KegiatanImport implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
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
        return new Kegiatan([
                'id'         => $row['kode'],
                'program_id' => $row['kode_program'],
                'uraian'     => $row['uraian'],
            ]);
    }

    public function uniqueBy()
    {
        return 'id';
    }
}
