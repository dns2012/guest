<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buku Tamu Dani & Diah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            padding: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        @if (empty($guests))
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pilih Pengantin</h5>
                        <form action="" method="GET">
                            <div class="form-group">
                                <select class="form-select" name="bride">
                                    <option value="dani">Dani Susanto</option>
                                    <option value="diah">Diah Permatasari</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <button class="btn btn-primary">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12 mb-3"><a href="/" class="btn btn-success"><< Halaman Utama</a></div>
            <div class="col-md-12">
                <h4>Daftar Tamu <b>{{ $bride }}</b></h4>
                <hr>
                <form class="mb-3">
                    <div class="form-group">
                        <input type="text" name="keyword" class="form-control form-control-lg" placeholder="Cari Nama Tamu">
                    </div>
                </form>
                @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {!! session('message') !!}
                </div>
                @endif
                <div id="guest-box">
                    @foreach ($guests as $guest)
                    <div class="card mb-1">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h5 class="card-title"><b>{{ $guest['name']}}</b></h5>
                                </div>
                                <div class="col-3">
                                    <a href="{{ route('update', $guest['id']) }}" class="btn btn-primary">HADIR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>
</html>

<script>
    $(document).ready(function() {
        $("[name='keyword']").keyup(function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/search',
                data: {keyword: $(this).val(), bride: "{{ $brideKey }}"},
                success: function(data) {
                    var html = '';
                    if (data.length > 0) {
                        for(var i in data) {
                            html += '<div class="card mb-1">'
                            +'<div class="card-body">'
                            +'<div class="row align-items-center">'
                            +'<div class="col-9">'
                            +'<h5 class="card-title"><b>' + data[i]['name'] + '</b></h5>'
                            +'</div>'
                            +'<div class="col-3">'
                            +'<a href="/' + data[i]['id'] + '" class="btn btn-primary">HADIR</a>'
                            +'</div>'
                            +'</div>'
                            +'</div>'
                            +'</div>'
                        }
                    } else {
                        html += '<div class="text-center">Tamu tidak ditemukan</div>'
                    }
                    $('#guest-box').html(html)
                }
            })
        })

        setTimeout(function() {
            $('.alert-success').hide();
        }, 5000)
    })
</script>