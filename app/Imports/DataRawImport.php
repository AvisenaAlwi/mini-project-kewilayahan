<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataRawImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $collectionChunk = $collection->chunk(1000);
        foreach ($collectionChunk as $chunk) {
            $dataInsertInThisChunk = [];
            foreach ($chunk as $row) {
                $dataInsertInThisChunk[] = [
                    'id'          => $row->id,
                    'kanwil_id'   => $row->kanwil_djpb,
                    'kppn_id'     => $row->kppn,
                    'ba_id'       => $row->ba,
                    'baes1_id'    => $row->baes1,
                    'satker_id'   => $row->kdsatket,
                    'program_id'  => $row->kdprogram,
                    'kegiatan_id' => $row->kdgiat,
                    'kro_id'      => $row->kro,
                    'ro_id'       => $row->ro,
                    'revisi'      => $row->revision_number,
                    'pagu'        => $row->pagu,
                    'realisasi'   => $row->realisasi,
                    'target'      => $row->target,
                    'wilayah_id'  => $row->id_wilayah,
                    'provinsi_id' => $row->kd_prov,
                    'pemda_id'    => $row->kd_pemda,
                ];
            }
        }
    }
}
