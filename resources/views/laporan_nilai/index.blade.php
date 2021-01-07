@extends('layouts/navbar')
@section('title')
Data Pelajaran |
@endsection
@section('content')
<div class="row">

    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header  with-border">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Tahun Akademik</th>
                        <th> : {{$tahun->tahun_akademik}}</th>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <th> : {{$tahun->semester}}</th>
                    </tr>
                    @if (Auth::user()->id_level_user == 6)
                    <tr>
                        <th>
                            Jurusan
                        </th>
                        <th>
                            <select onchange="handleChange()" name="kd_jurusan" class="form-control"
                                id="filter_jurusan">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $j)
                                <option value="{{$j->kd_jurusan}}">{{$j->nama_jurusan}}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Kelas
                        </th>
                        <th>
                            <select onchange="loadSiswa()" class="form-control kelas" id="cbkelas">
                                <option>Pilih Kelas</option>
                        </th>
                    </tr>
                    @elseif($walikelas != null)
                    <tr>
                        <th>
                            Jurusan & Tingkatan
                        </th>
                        <th>
                            : Jurusan {{$walikelas->jurusan->nama_jurusan}} ({{$walikelas->kelas->nama_kelas}})
                        </th>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header  with-border">
                <h3 class="box-title">Daftar Siswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">NIS</th>
                            <th class="text-center">NAMA </th>
                            <th class="text-center">STATUS SISWA</th>
                            <th class="text-center">LIHAT NILAI</th>
                            @if (Auth::user()->id_level_user == 6)
                                
                            <th class="text-center">AKSI</th>
                            @else
                            <th class="text-center" colspan="2">AKSI</th>
                                
                            @endif
                        </tr>
                    </thead>

                    <tbody id="tbody"> 
                        @if ($walikelas != null)
                        @foreach ($siswa as $s)
                        <tr>
                            <td class="text-center col-sm-1">{{$s->nis}}</td>
                            <td> {{$s->nama}} </td>
                            <td class="text-center col-sm-2">{{$s->status_siswa}}</td>
                            <td class="text-center col-sm-1">
                                <a href="/laporan_nilai/{{$s->nis}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>

                            @if (Auth::user()->id_level_user == 6)
                            <td class="text-center col-sm-2">
                                <a href="#" class="btn btn-xs bg-orange" data-placement="top">Setujui</a>
                            </td>
                            @else
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-success" onclick="naik({{$s->nis}})" {{$s->kelas->kd_tingkatan == 003 ? 'disabled' : ''}}>Naik Kelas</button>
                            </td>
                            <td class="text-center">
                                <a href="/nilai/print/{{$s->nis}}" class="btn btn-primary">Cetak Laporan Nilai</a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @endif
                    </tbody>

                </table>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<!-- Button trigger modal -->

@endsection
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('printjs/print.min.css') }}"></script>
<script>
    function handleChange()
    {
    var jurusan = $("#filter_jurusan").val();

    $('#cbkelas').html('<select onchange="loadSiswa(kelas)" name="kd_kelas" class="form-control kelas" id="cbkelas"></select>');
    $.ajax({
        type : 'GET',
        url : 'http://localhost:8000/laporan_nilai/kelas/'+jurusan,
        success : function(res) {
                $.each(res, function(i, item){
                    try {
                    $('.kelas').append('<option value="'+item.kd_kelas+'">'+item.nama_kelas+'</option>');
                    } catch (error) {
                        console.log(error);
                    }
                })
        }
    })
    }
    function loadSiswa(kelas)
    {
        var kelas = $("#cbkelas").val();
        $('#mytable').html('<table class="table lists"><th class="text-center">NIS</th><th class="text-center">NAMA </th><th class="text-center">STATUS SISWA</th><th class="text-center">LIHAT NILAI</th><th class="text-center">AKSI</th></table>');
            $.ajax({
                type : 'GET',
                url : 'http://localhost:8000/laporan_nilai/siswa/'+kelas,
                success : function(res) {
                    $.each(res, function(i, item){
                    try {
                    $('.lists').append('<tr><td>'+item.nis+'</td><td>'+item.nama+'</td><td>'+item.jenis_kelamin+'</td></tr>');
                    } catch (error) {
                    console.log(error);
                    }
                    })
                // console.log(res);
            }
        })
    }

    function kelas(kelas)
    {
        var kelas = $("#cbkelas").val();
        $.ajax({
                type : 'GET',
                url : 'http://localhost:8000/laporan_nilai/siswa/'+kelas,
                success : function(res) {
                    $.each(res, function(i, item){
                    try {
                    $('.lists').append('<tr><td>'+item.nis+'</td><td>'+item.nama+'</td><td>'+item.jenis_kelamin+'</td></tr>');
                    } catch (error) {
                    console.log(error);
                    }
                    })
            }
        })
    }

    function naik(id) {
        $.ajax({
            type : 'GET',
            url : 'http://localhost:8000/laporan_nilai/naik/'+id,
            success : function(res) {
                console.log(res);
                if (res == 'penuh') {
                    alert('Kelas Penuh, Harap Buat Data Kelas Baru');
                }
                alert('Siswa bernama '+res.siswa+' telah naik ke kelas '+res.kd);
                $('#tbody').html('');
                $.each(res.siswa2, function(i, item){
                    try {
                        $('#tbody').append('<tr><td class="text-center col-sm-1">'+item.nis+'</td><td> '+item.nama+' </td><td class="text-center col-sm-2">'+item.status_siswa+'</td><td class="text-center col-sm-1"><a href="/laporan_nilai/'+item.nis+'"><i class="fa fa-eye" aria-hidden="true"></i></a></td><td class="text-center"><button type="button" class="btn btn-sm btn-success" onclick="naik('+item.nis+')">Naik Kelas</button></td><td class="text-center"><button type="button" class="btn btn-sm btn-primary" onclick="cetak('+item.nis+')">Cetak Laporan Nilai</button></td></tr>');
                    } catch (error) {
                    console.log(error);
                    }
                })

            }
        })
    }

</script>