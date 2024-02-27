<table class="table table-striped table-responsive">
    <thead class="thead-dark">
        <tr>
            <th>Wilayah</th>
            <th style="text-align: right;">Total Pagu Anggaran</th>
            <th style="text-align: right;">Realisasi Anggaran</th>
            <th style="text-align: right;">Sisa Pagu Anggaran</th>
            <th style="text-align: right;">Realisasi</th>
            <th style="text-align: center;">Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td scope="row">{{ $row->nama }}</td>
                <td style="text-align: right;">{{ number_format($row->total_pagu, 2, ',', '.') }}</td>
                <td style="text-align: right;">{{ number_format($row->realisasi, 2, ',', '.') }}</td>
                <td style="text-align: right;">{{ number_format($row->sisa_pagu, 2, ',', '.') }}</td>
                <td style="text-align: right;">{{ round($row->realisasi_total, 4) }}%</td>
                <td><button class="w-100 btn btn-success prov-go-detail" data-kabupaten-kota-nama="{{ $row->nama }}" data-kabupaten-kota-id="{{ $row->kab_kot_id }}">
                    Detail
                </button></td>
            </tr>
        @endforeach
    </tbody>
</table>
