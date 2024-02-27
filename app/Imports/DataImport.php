<?php

namespace App\Imports;

use App\Models\Data;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Str;

class DataImport implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts, WithChunkReading, WithProgressBar, WithCustomCsvSettings
{
    use Importable;

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'use_bom' => false,
            'output_encoding' => 'ISO-8859-1',
        ];
    }

    public function chunkSize(): int
    {
        return 10000;
    }
    public function batchSize(): int
    {
        return 1;
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        // if ($row['id'] == 7034120)
        //     dd($row, 
        
        //     $row['id']                    == '' || $row['id']                    === null ||
        //         $row['kd_prov']               == '' || $row['kd_prov']               === null ||
        //         $row['kd_pemda']              == '' || $row['kd_pemda']              === null ||
        //         $row['kanwil_djpb']           == '' || $row['kanwil_djpb']           === null ||
        //         $row['kppn']                  == '' || $row['kppn']                  === null ||
        //         $row['ba']                    == '' || $row['ba']                    === null ||
        //         $row['baes1']                 == '' || $row['baes1']                 === null ||
        //         $row['kdsatker']              == '' || $row['kdsatker']              === null ||
        //         $row['kdprogram']             == '' || $row['kdprogram']             === null ||
        //         $row['kdgiat']                == '' || $row['kdgiat']                === null ||
        //         $row['kro']                   == '' || $row['kro']                   === null ||
        //         $row['ro']                    == '' || $row['ro']                    === null ||
        //         $row['revision_number']       == '' || $row['revision_number']       === null ||
        //         $row['pagu']                  == '' || $row['pagu']                  === null ||
        //         $row['realisasi']             == '' || $row['realisasi']             === null ||
        //         $row['persen_realisasi']      == '' || $row['persen_realisasi']      === null ||
        //         $row['target']                == '' || $row['target']                === null ||
        //         $row['real_ro_bulan_ini']     == '' || $row['real_ro_bulan_ini']     === null ||
        //         $row['progress_ro_bulan_ini'] == '' || $row['progress_ro_bulan_ini'] === null ||
        //         $row['real_ro_bulan_akm']     == '' || $row['real_ro_bulan_akm']     === null ||
        //         $row['progress_ro_bulan_akm'] == '' || $row['progress_ro_bulan_akm'] === null ||
        //         $row['gap']                   == '' || $row['gap']                   === null
        // );
        if (
                $row['id']                    == '' || $row['id']                    === null ||
                $row['kd_prov']               == '' || $row['kd_prov']               === null ||
                $row['kd_pemda']              == '' || $row['kd_pemda']              === null ||
                $row['kanwil_djpb']           == '' || $row['kanwil_djpb']           === null ||
                $row['kppn']                  == '' || $row['kppn']                  === null ||
                $row['ba']                    == '' || $row['ba']                    === null ||
                $row['baes1']                 == '' || $row['baes1']                 === null ||
                $row['kdsatker']              == '' || $row['kdsatker']              === null ||
                $row['kdprogram']             == '' || $row['kdprogram']             === null ||
                $row['kdgiat']                == '' || $row['kdgiat']                === null ||
                $row['kro']                   == '' || $row['kro']                   === null ||
                $row['ro']                    == '' || $row['ro']                    === null ||
                $row['revision_number']       == '' || $row['revision_number']       === null ||
                $row['pagu']                  == '' || $row['pagu']                  === null ||
                $row['realisasi']             == '' || $row['realisasi']             === null ||
                $row['persen_realisasi']      == '' || $row['persen_realisasi']      === null ||
                $row['target']                == '' || $row['target']                === null ||
                $row['real_ro_bulan_ini']     == '' || $row['real_ro_bulan_ini']     === null ||
                $row['progress_ro_bulan_ini'] == '' || $row['progress_ro_bulan_ini'] === null ||
                $row['real_ro_bulan_akm']     == '' || $row['real_ro_bulan_akm']     === null ||
                $row['progress_ro_bulan_akm'] == '' || $row['progress_ro_bulan_akm'] === null ||
                $row['gap']                   == '' || $row['gap']                   === null
        ) {
            return null;
        }
        return new Data([
                'id'                    => $row['id'],
                'provinsi_id'           => $row['kd_prov'],
                'kabupaten_kota_id'     => $row['kd_pemda'],
                'kanwil_id'             => $row['kanwil_djpb'],
                'kppn_id'               => $row['kppn'],
                'ba_id'                 => $row['ba'],
                'baes1_id'              => $row['baes1'],
                'satker_id'             => $row['kdsatker'],
                'program_id'            => $row['kdprogram'],
                'kegiatan_id'           => $row['kdgiat'],
                'kro_id'                => $row['kro'],
                'ro_id'                 => $row['ro'],
                'revision'              => $this->smoothNumber( $row['revision_number']),
                'pagu'                  => $this->smoothNumber( $row['pagu']),
                'realisasi'             => $this->smoothNumber( $row['realisasi'] ),
                'persen_realisasi'      => $this->smoothNumber( $row['persen_realisasi'] ),
                'target'                => $this->smoothNumber( $row['target'] ),
                'real_ro_bulan_ini'     => $this->smoothNumber( $row['real_ro_bulan_ini'] ),
                'progress_ro_bulan_ini' => $this->smoothNumber( $row['progress_ro_bulan_ini'] ),
                'real_ro_bulan_akm'     => $this->smoothNumber( $row['real_ro_bulan_akm'] ),
                'progress_ro_bulan_akm' => $this->smoothNumber( $row['progress_ro_bulan_akm'] ),
                'gap'                   => $this->smoothNumber( $row['gap'] ),
            ]);
    }

    private function smoothNumber($s) {
        if ( Str::contains($s, 'E') ) {
            $s = str_replace(',', '.', $s);
            $s = sprintf('%f', floatval($s));
        }
        return $this->floatvalue($s);
    }
    private function floatvalue($val){
            $val = str_replace(",",".",$val);
            $val = preg_replace('/\.(?=.*\.)/', '', $val);
            return floatval($val);
    }
    public function uniqueBy()
    {
        return 'id';
    }
}
