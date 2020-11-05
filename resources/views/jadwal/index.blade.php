@extends('layouts/navbar')
@section('title')
Data Jadwal |
@endsection
@section('content')
<div class="row">

    <!-- filter -->
    <div class="col-xs-5">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Filter Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{-- CETAK JADWAL --}}
                <table class="table table-bordered">
                    <tr>
                        <th>Jurusan</th>
                        <th>
                            <select class="form-control select-change" name="kd_jurusan" id="filter_jurusan">
                                @foreach ($jurusan as $j)
                                <option value="{{$j->kd_jurusan}}">{{$j->nama_jurusan}}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>

                    <tr>
                        <th>Tingkatan Kelas</th>
                        <th>
                            <select class="form-control select-change" name="kd_tingkatan" id="filter_tingkatan">
                                @foreach ($tingkatan as $t)
                                <option value="{{$t->kd_tingkatan}}">{{$t->nama_tingkatan}}
                                </option>
                                @endforeach
                            </select>
                        </th>
                    </tr>

                    <tr>
                        <th>Kelas</th>
                        <th>
                            <div id="tampilKelas">
                                <select name="kd_kelas" id="kelas" class="form-control kelas" disabled>
                                    <option value="">Pilih Kelas</option>
                                </select>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#myModal">
                                <i class="fa fa-cogs" aria-hidden="true"></i> Generate Jadwal
                            </button>
                            <button type="submit" name="export_jadwal" class="btn btn-danger btn-sm"><i
                                    class="fa fa-print" aria-hidden="true"></i> Cetak PDF</button>
                        </th>
                    </tr>
                </table>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

    <!-- tabel -->
    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header  with-border">
                <h3 class="box-title">Data Jadwal Pelajaran</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <!-- disini tampil data -->
                <table id="table_daftarpelajaran"
                    class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0"
                    width="100%">
                    <tr>
                        <th>NO</th>
                        <th>MATA PELAJARAN</th>
                        <th>GURU</th>
                        <th>RUANGAN</th>
                        <th>HARI</th>
                        <th>JAM</th>
                        <th></th>
                    </tr>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

</div>
<!-- /.row -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/jadwal/store" method="post" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Generate Jadwal</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered">
                        <tr>
                            <td>Kurikulum</td>
                            <td>
                                <select name="id_kurikulum" class="form-control">
                                    @foreach ($kurikulum as $k)
                                    <option value="{{$k->id_kurikulum}}">{{$k->nama_kurikulum}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td>
                                <select name="semester" class="form-control">
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                </select>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="submit" class="btn btn-primary">Generate Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.select-change').change(function () {
        var jurusan         = $("#filter_jurusan").val();
        var tingkatan_kelas = $("#filter_tingkatan").val();

        $('#kelas').html('<option value="">Pilih Kelas</option>');
        $('#kelas').prop('disabled', false);
        $.ajax({
            type : 'GET',
            url : 'http://localhost:8000/jadwal/kelas/'+jurusan+'/'+tingkatan_kelas,
            success : function(res) {
                $.each(res, function(i, item){
                    try {
                        $('#kelas').append('<option value="'+item.kd_kelas+'">'+item.nama_kelas+'</option>');
                    } catch (error){
                        console.log(error);
                    }
                })
            }
        });
    })

    $('#kelas').change(function () {
        var tingkatan_kelas = $("#filter_tingkatan").val();
        var jurusan         = $("#filter_jurusan").val();
        var kelas           = $("#kelas").val();
        $('#table_daftarpelajaran').html('<table><tr><th>NO</th><th>MATA PELAJARAN</th><th>GURU</th><th>RUANGAN</th><th>HARI</th><th>JAM</th></tr></table>');
        $.ajax({
            type : 'GET',
            url : 'http://localhost:8000/jadwal/mapel/'+tingkatan_kelas+'/'+jurusan,
            success : function(res) {
                $.each(res.jadwal, function(i, item){
                    // console.log(item);
                    try {
                        $('#table_daftarpelajaran').append('<tr class="align-items-center"><td></td><td>'+item.mapel.nama_mapel+'</td><td><select id="guru-select-'+item.id_jadwal+'" name="id_guru" class="form-control guru" onChange="updateGuru('+item.id_jadwal+')"><option value="'+item.id_guru+'">'+item.guru.nama_guru+'</option></select></td><td><select id="ruangan-select-'+item.id_jadwal+'" name="kd_ruangan" class="form-control ruangan" onChange="updateRuangan('+item.id_jadwal+')"><option value="'+item.kd_ruangan+'">'+item.ruangan.nama_ruangan+'</option></select></td><td><select id="hari-select-'+item.id_jadwal+'" name="hari" class="form-control hari" onChange="updateHari('+item.id_jadwal+')"><option value="'+item.hari+'">'+item.hari+'</option><option value="Senin">Senin</option><option value="Selasa">Selasa</option><option value="Rabu">Rabu</option><option value="Kamis">Kamis</option><option value="Jumat">Jumat</option></select></td><td><select id="jam-select-'+item.id_jadwal+'" name="jam" class="form-control jam" onChange="updateJam('+item.id_jadwal+')"><option value="'+item.jam+'">'+item.jam+'</option><option value="06.30-07.15">06.30-07.15</option><option value="07.15-08.00">07.15-08.00</option><option value="08.00-08.45">08.00-08.45</option><option value="08.45-09.30">08.45-09.30</option><option value="09.45-10.30">09.45-10.30</option><option value="10.30-11.45">10.30-11.15</option><option value="11.15-12.00">11.15-12.00</option><option value="12.30-13.15">12.30-13.15</option><option value="13.15-14.00">13.15-14.00</option><option value="14.00-14.30">14.00-14.30</option><td><a href="/jadwal/'+item.id_jadwal+'/delete"><i class="fa fa-timesfa fa-times fa fa-white" style="color:red"></i></a></td></tr>');
                        $.each(res.guru, function (x, guru) {
                            $('#guru-select-'+item.id_jadwal).append('<option value="'+guru.id_guru+'" >'+guru.nama_guru+'</option>');
                        })
                        $.each(res.ruangan, function (y, ruangan) {
                            $('#ruangan-select-'+item.id_jadwal).append('<option value="'+ruangan.kd_ruangan+'">'+ruangan.nama_ruangan+'</option>');
                        })
                    } catch (error) {
                        console.log(error);
                    }
                })
            }
        });
    })

    function updateGuru(id)
    {
        var guru = $("#guru-select-"+id).val();
        $.ajax({
        type : 'GET',
        url : 'http://localhost:8000/jadwal/guru/'+guru+'/'+id,
        success : function(res) {
        console.log(guru);
        }
        })
    }

    function updateRuangan(id)
    {
        var ruangan = $("#ruangan-select-"+id).val();
        $.ajax({
        type : 'GET',
        url : 'http://localhost:8000/jadwal/ruangan/'+ruangan+'/'+id,
        success : function(res) {
            console.log(res);
            }
        })
    }

    function updateHari(id)
    {
        var hari = $("#hari-select-"+id).val();
        $.ajax({
        type : 'GET',
        url : 'http://localhost:8000/jadwal/hari/'+hari+'/'+id,
        success : function(res) {
            console.log(res);
            }
        })
    }

    function updateJam(id)
    {
        var jam = $("#jam-select-"+id).val();
        var guru = $("#guru-select-"+id).val();
        var ruangan = $("#ruangan-select-"+id).val();
        var hari = $("#hari-select-"+id).val();
        
        $.ajax({
        type : 'GET',
        url : 'http://localhost:8000/jadwal/jam/'+jam+'/'+id+'/'+guru+'/'+ruangan+'/'+hari,
        success : function(res) {
            if (res.con == 'gagal') {
                alert("Jadwal Bentrok");
            }
            }
        })
    }

</script>
@endsection