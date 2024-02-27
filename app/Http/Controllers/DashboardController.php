<?php

namespace App\Http\Controllers;

use App\Models\Ba;
use App\Models\Baes1;
use App\Models\KabupatenKota;
use App\Models\Kanwil;
use App\Models\Kppn;
use App\Models\Program;
use App\Models\Provinsi;
use App\Models\Satker;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() {
        $jumlahKanwil        = Kanwil::get()->count();
        $jumlahKppn          = Kppn::get()->count();
        $jumlahBa            = Ba::get()->count();
        $jumlahBaes1         = Baes1::get()->count();
        $jumlahProvinsi      = Provinsi::get()->count();
        $jumlahKabupatenKota = KabupatenKota::get()->count();
        $jumlahSatker        = Satker::get()->count();
        $jumlahProgram       = Program::get()->count();

        $data = [];
        $data['kanwil_count']         = $jumlahKanwil;
        $data['kppn_count']           = $jumlahKppn;
        $data['ba_count']             = $jumlahBa;
        $data['baes1_count']          = $jumlahBaes1;
        $data['provinsi_count']       = $jumlahProvinsi;
        $data['kabupaten_kota_count'] = $jumlahKabupatenKota;
        $data['sateker_count']        = $jumlahSatker;
        $data['program_count']        = $jumlahProgram;

        $data['data_card'] = [
            [
                'title' => 'Kanwil',
                'count' => $jumlahKanwil,
                'color' => '#2e86de',
            ],
            [
                'title' => 'KPPN',
                'count' => $jumlahKppn,
                'color' => '#ff9f43',
            ],
            [
                'title' => 'BA',
                'count' => $jumlahBa,
                'color' => '#ee5253',
            ],
            [
                'title' => 'BA Eselon 1',
                'count' => $jumlahBaes1,
                'color' => '#0abde3',
            ],
            [
                'title' => 'Provinsi',
                'count' => $jumlahProvinsi,
                'color' => '#10ac84',
            ],
            [
                'title' => 'Kabupaten/Kota',
                'count' => $jumlahKabupatenKota,
                'color' => '#576574',
            ],
            // [
            //     'title' => 'Satker',
            //     'count' => $jumlahSatker,
            //     'color' => '#000',
            // ],
            // [
            //     'title' => 'Program',
            //     'count' => $jumlahProgram,
            //     'color' => 'danger',
            // ],
        ];
        return view('dashboard', $data);
    }
}
