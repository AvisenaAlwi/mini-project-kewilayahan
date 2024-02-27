@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    {{-- <div class="input-group date datepicker wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
      <span class="input-group-text input-group-addon bg-transparent border-primary"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control border-primary bg-transparent">
    </div>
    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Download Report
    </button> --}}
  </div>
</div>

<div class="row">
  {{-- <div class="col-12 col-xl-12 stretch-card"> --}}
    <div class="row">
        @foreach ($data_card as $card)
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 grid-margin stretch-card text-white">
                <div class="card @if( !str_contains($card['color'], '#') ) bg-{{ $card['color'] }} @endif" @if( str_contains($card['color'], '#') ) style="background-color: {{ $card['color'] }}" @endif>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title mb-0">{{ $card['title'] }}</h6>
                        </div>
                        <div class="row">
                        <div class="col-12">
                            <h3 class="mb-2">{{ $card['count'] }}</h3>
                            <div class="d-flex align-items-baseline">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  {{-- </div> --}}
</div> <!-- row -->

<div class="row mb-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">5 Kota/Kabupaten dengan Realisasi Tertinggi</h6>
                </div>
            </div>
            <div class="card-body">
              <p class="text-muted">Menampilkan kota/kabupaten dengan rerata persentase realisasi tertinggi</p>
              <div id="chart-5-kota-realisasi-tertinggi"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">5 Kota/Kabupaten dengan Realisasi Terendah</h6>
                </div>
            </div>
            <div class="card-body">
              <p class="text-muted">Menampilkan kota/kabupaten dengan rerata persentase realisasi terendah</p>
              <div id="chart-5-kota-realisasi-terendah"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card overflow-hidden">
            <div class="card-header">
                <div class="card-title">Cek realisasi pagu anggaran per daerah</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <select class="select2 w-100" id="provinsi_id"></select>
                    </div>
                    <div class="col-md-6">
                        <select class="select2 w-100" id="kabupaten_kota_id"></select>
                    </div>
                </div>
                <hr>
                <div id="data_container" class="table-responsive">
                    <table class="w-100"><tr><th style="text-align: center;">Tidak Ada Data</th></tr></table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  {{-- <script src="{{ asset('assets/js/dashboard.js') }}"></script> --}}
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>

  <script>
    var colors = {
        primary        : "#6571ff",
        secondary      : "#7987a1",
        success        : "#05a34a",
        info           : "#66d1d1",
        warning        : "#fbbc06",
        danger         : "#ff3366",
        light          : "#e9ecef",
        dark           : "#060c17",
        muted          : "#7987a1",
        gridBorder     : "rgba(77, 138, 240, .15)",
        bodyColor      : "#000",
        cardBg         : "#fff"
    }

    function loadKotaTertinggi(data_x, label_y){

        minValue = Math.min(...data_x);
        maxValue = Math.max(...data_x);

        if($('#chart-5-kota-realisasi-tertinggi').length) {
            var options = {
            chart: {
                type: 'bar',
                height: '318',
                parentHeightOffset: 0,
                foreColor: colors.bodyColor,
                background: colors.cardBg,
                toolbar: {
                show: false
                },
            },
            theme: {
                mode: 'dark'
            },
            tooltip: {
                theme: 'light'
            },
            colors: [colors.primary],
            fill: {
                opacity: .9
            } ,
            grid: {
                padding: {
                bottom: -4
                },
                borderColor: colors.gridBorder,
                xaxis: {
                lines: {
                    show: true
                }
                }
            },
            series: [{
                name: 'Kota/Kabupaten',
                data: data_x,
            }],
            xaxis: {
                categories: label_y,
                axisBorder: {
                color: colors.gridBorder,
                },
                axisTicks: {
                color: colors.gridBorder,
                },
            },
            yaxis: {
                forceNiceScale: true,
                max: maxValue + 0.5,
                min: minValue - 1,
                labels: {

                },
                title: {
                    text: 'Kota/Kabupaten',
                    style:{
                        size: 9,
                        color: colors.muted
                    }
                },
            },
            legend: {
                show: true,
                position: "top",
                horizontalAlign: 'center',
                itemMargin: {
                horizontal: 8,
                vertical: 0
                },
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '10px',
                },
                offsetY: 0,
                offsetX: -10,
                rotate: 0,
                formatter: (value) => { return value + "%" },
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: "50%",
                    borderRadius: 4,
                    dataLabels: {
                        position: 'top',
                        orientation: 'horizontal',
                    }
                },
            },
            }

            var apexBarChart = new ApexCharts(document.querySelector("#chart-5-kota-realisasi-tertinggi"), options);
            apexBarChart.render();
        }

    }

    function loadKotaTerendah(data_x, label_y){

        minValue = Math.min(...data_x);
        maxValue = Math.max(...data_x);

        if($('#chart-5-kota-realisasi-terendah').length) {
            var options = {
            chart: {
                type: 'bar',
                height: '318',
                parentHeightOffset: 0,
                foreColor: colors.bodyColor,
                background: colors.cardBg,
                toolbar: {
                show: false
                },
            },
            theme: {
                mode: 'dark'
            },
            tooltip: {
                theme: 'light'
            },
            colors: ['#eb4d4b'],
            fill: {
                opacity: .9
            } ,
            grid: {
                padding: {
                bottom: -4
                },
                borderColor: colors.gridBorder,
                xaxis: {
                lines: {
                    show: true
                }
                }
            },
            series: [{
                name: 'Kota/Kabupaten',
                data: data_x,
            }],
            xaxis: {
                categories: label_y,
                axisBorder: {
                color: colors.gridBorder,
                },
                axisTicks: {
                color: colors.gridBorder,
                },
            },
            yaxis: {
                forceNiceScale: true,
                max: maxValue + 0.5,
                min: minValue - 1,
                labels: {

                },
                title: {
                    text: 'Kota/Kabupaten',
                    style:{
                        size: 9,
                        color: colors.muted
                    }
                },
            },
            legend: {
                show: true,
                position: "top",
                horizontalAlign: 'center',
                itemMargin: {
                horizontal: 8,
                vertical: 0
                },
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '10px',
                },
                offsetY: 0,
                offsetX: -10,
                rotate: 0,
                formatter: (value) => { return value + "%" },
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: "50%",
                    borderRadius: 4,
                    dataLabels: {
                        position: 'top',
                        orientation: 'horizontal',
                    }
                },
            },
            }

            var apexBarChart = new ApexCharts(document.querySelector("#chart-5-kota-realisasi-terendah"), options);
            apexBarChart.render();
        }

    }

    function loadData(){
        var provinsiId = $('#provinsi_id').val();
        var kabupatenKotaId = $('#kabupaten_kota_id').val();
        if ( provinsiId == null && kabupatenKotaId == null) {
            $('#data_container').html('<table class="w-100"><tr><th style="text-align: center;">Tidak Ada Data</th></tr></table>');
        } else if (provinsiId != null && kabupatenKotaId == null ) {
            // Load data per provinsi
            loadDataTable(provinsiId, kabupatenKotaId);
        } else if (provinsiId != null && kabupatenKotaId != null) {
            // load data per program per kabupaten kota
            loadDataTable(provinsiId, kabupatenKotaId);
        }
    }

    function loadDataTable(provinsiId, kabupatenKotaId) {
        $.ajax({
            url: '{{ route('api.get_data') }}',
            data: {
                provinsi_id: provinsiId,
                kabupaten_kota_id: kabupatenKotaId,
            },
            success: function(res){
                $('#data_container').html(res.html);
            },
            error: function(x, t, m) {
                alert('Gagal mendapatkan data')
            }
        });
    }

    $.ajax({
        url: '{{ route('api.kabupaten_kota_terbaik') }}',
        success: function(res){
            var data = res.data;
            dataX = [];
            labelY = [];
            data.forEach(function(item){
                dataX.push(  Math.round((item.persen_realisasi + Number.EPSILON) * 100) / 100 );
                labelY.push(item.nama_kk);
            });
            loadKotaTertinggi(dataX, labelY);
        },
        error: function(x, t, m) {
            alert('Gagal mendapatkan kota kabupaten terbaik')
        }
    });
    $.ajax({
        url: '{{ route('api.kabupaten_kota_terendah') }}',
        success: function(res){
            var data = res.data;
            dataX = [];
            labelY = [];
            data.forEach(function(item){
                dataX.push(  Math.round((item.persen_realisasi + Number.EPSILON) * 100) / 100 );
                labelY.push(item.nama_kk);
            });
            loadKotaTerendah(dataX, labelY);
        },
        error: function(x, t, m) {
            alert('Gagal mendapatkan kota kabupaten terendah')
        }
    });

    $('#provinsi_id').on('change', function(){
        $('#kabupaten_kota_id').val('').change();
        // clear data chart
        loadData();
    });
    $('#kabupaten_kota_id').on('change', function(){
        loadData();
    });
    $('#provinsi_id').select2({
        placeholder: "Pilih provinsi",
        allowClear: true,
        ajax: {
            url: '{{ route('api.provinsi') }}',
            dataType: 'json',
            data: function (params) {
                var query = {
                    q: params.term
                }
                return query;
            }
        }
    });
    $('#kabupaten_kota_id').select2({
        placeholder: "Pilih kabupaten kota",
        allowClear: true,
        ajax: {
            url: '{{ route('api.kabupaten_kota') }}',
            dataType: 'json',
            data: function (params) {
                var query = {
                    provinsi_id: $('#provinsi_id').val(),
                    q: params.term
                }
                return query;
            }
        }
    });

    $(document).on('click', 'button.prov-go-detail', function(event){
        var id = $(event.target).attr('data-kabupaten-kota-id');
        var nama = $(event.target).attr('data-kabupaten-kota-nama');

        var newOption = new Option(nama, id, true, true);
        // $('#kabupaten_kota_id').val(null).trigger('change');
        // Append it to the select
        $('#kabupaten_kota_id').append(newOption).trigger('change');
    });
  </script>
@endpush
