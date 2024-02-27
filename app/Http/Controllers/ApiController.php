<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\KabupatenKota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    function getProvinsi(Request $request) {
        $q = strtolower($request->q) ?? '';
        $provinsis = Provinsi::where(DB::raw('LOWER(nama)'), 'like', '%'.$q.'%')->get();
        $dataProvinsis = [];
        foreach ($provinsis as $provinsi) {
            $dataProvinsis[] = [
                'id' => $provinsi->id,
                'text' => $provinsi->nama,
            ];
        }
        return response()->json(['results' => $dataProvinsis]);
    }

    function getKabupatenKota(Request $request) {
        $q = strtolower($request->q) ?? '';
        $provinsiId = strtolower($request->provinsi_id) ?? '';
        $provinsis = KabupatenKota::where('provinsi_id', $provinsiId)->where(DB::raw('LOWER(nama)'), 'like', '%'.$q.'%')->get();
        $dataProvinsis = [];
        foreach ($provinsis as $provinsi) {
            $dataProvinsis[] = [
                'id' => $provinsi->id,
                'text' => $provinsi->nama,
            ];
        }
        return response()->json(['results' => $dataProvinsis]);
    }

    function kabupatenKotaTerbaik() {
        $data = DB::table('data', 'd')
            ->selectRaw('p.nama AS nama_provinsi, kk.nama AS nama_kk, avg(d.persen_realisasi) AS persen_realisasi ')
            ->join('kabupaten_kotas as kk', 'kk.id', '=', 'd.kabupaten_kota_id')
            ->join('provinsis as p', 'p.id', '=', 'kk.provinsi_id')
            ->groupBy(['p.nama', 'kk.nama'])
            ->orderBy('persen_realisasi', 'desc')
            ->limit(5)
            ->get();
        return response()->json([ 'data' => $data ]);
    }
    function kabupatenKotaTerendah() {
        $data = DB::table('data', 'd')
            ->selectRaw('p.nama AS nama_provinsi, kk.nama AS nama_kk, avg(d.persen_realisasi) AS persen_realisasi ')
            ->join('kabupaten_kotas as kk', 'kk.id', '=', 'd.kabupaten_kota_id')
            ->join('provinsis as p', 'p.id', '=', 'kk.provinsi_id')
            ->groupBy(['p.nama', 'kk.nama'])
            ->orderBy('persen_realisasi', 'asc')
            ->limit(5)
            ->get();
        return response()->json([ 'data' => $data ]);
    }

    function getDataTable(Request $request) {
        $provinsiId = $request->provinsi_id;
        $kabupatenKotaId = $request->kabupaten_kota_id;
        if (empty($provinsiId))
            return response()->json([]);

        if ($provinsiId && !$kabupatenKotaId) {
            $data = DB::table('data', 'd')
                // ->leftJoin('programs as p', 'p.id', '=', 'd.program_id')
                ->leftJoin('kabupaten_kotas as kk', 'kk.id', '=', 'd.kabupaten_kota_id')
                ->where('d.provinsi_id', $provinsiId)
                ->selectRaw("kk.id as kab_kot_id, kk.nama, avg(d.persen_realisasi) AS realisasi_total, sum(pagu) as total_pagu, sum(realisasi) as realisasi, (sum(pagu) - sum(realisasi)) as sisa_pagu")
                ->groupBy(['kk.nama', 'kk.id'])
                ->orderBy('kk.nama')
                ->get();
            $response = [
                'data' => $data,
                'html' => view('inc.html_table_select_provinsi',['data' => $data])->render(),
            ];
            return response()->json($response);
        } else if ($provinsiId && $kabupatenKotaId){
            $data = DB::table('data', 'd')
                ->leftJoin('programs as p', 'p.id', '=', 'd.program_id')
                ->where('d.kabupaten_kota_id', $kabupatenKotaId)
                ->selectRaw("p.uraian, avg(d.persen_realisasi) AS realisasi_total, sum(pagu) as total_pagu, sum(realisasi) as realisasi, (sum(pagu) - sum(realisasi)) as sisa_pagu")
                ->groupBy(['p.uraian'])
                ->orderBy('p.uraian')
                ->get();
            $response = [
                'data' => $data,
                'html' => view('inc.html_table_select_kab_kota',['data' => $data])->render(),
            ];
            return response()->json($response);
        }
    }
}
