<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <select name="provinsi_id" id="provinsi_id" class="select2" style="width: 300px;"></select>
    <select name="kabupaten_kota_id" id="kabupaten_kota_id" class="select2" style="width: 300px;"></select>
    <script>
        $('#provinsi_id').on('change', function(){
            $('#kabupaten_kota_id').val('').change();
        });
        $('#provinsi_id').select2({
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
    </script>

    <script>
        const loadDataTable = function(event){
            $.ajax({
                url: '{{ route('api.data') }}',
                dataType: 'json',
                data: {
                    provinsi_id: $('#provinsi_id').val(),
                },
            });
        };

        $('#kabupaten_kota_id').on('change', loadDataTable);
    </script>
</body>
</html>
