<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReferenceImport implements WithMultipleSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return $this->sheets();
    }

    public function sheets(): array
    {
        return [
            'KANWIL DJPB' => new KanwilImport(),
            'KPPN'        => new KppnImport(),
            'BA'          => new BaImport(),
            'BAES-1'      => new Baes1Import(),
            'SATKER'      => new SatkerImport(),
            'PROGRAM'     => new ProgramImport(),
            'KEGIATAN'    => new KegiatanImport(),
            'KRO'         => new KroImport(),
            'RO'          => new RoImport(),
            'PROVINSI'    => new ProvinsiImport(),
            'KABUPATEN'   => new KabupatenKotaImport(),
        ];
    }
}
