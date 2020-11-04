@extends('layouts/navbar')
@section('title')
Data Jadwal |
@endsection
@section('content')
    <div class="row">

        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header  with-border">
                    <table class="table table-bordered">
                        <tr>
                            <td width="200">Tahun Akademik</td>
                            <td> : {{$tahun->tahun_akademik}}</td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td> : {{$tahun->semester}}</td>
                        </tr>
                        <tr>
                            <td>Jurusan &amp; Tingkatan</td>
                            <td> : {{$jadwal->jurusan->nama_jurusan}}{{$jadwal->tingkatan->nama_tingkatan}} ( {{$jadwal->kelas->nama_kelas}} )
                            </td>
                        </tr>
                        <tr>
                            <td>Mata Pelajaran</td>
                            <td>: {{$jadwal->mapel->nama_mapel}}</td>
                        </tr>
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

                    <table id="mytable"
                        class="table table-striped table-bordered table-hover table-full-width dataTable"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="100">NIS</th>
                                <th class="text-center">NAMA SISWA</th>
                                <th class="text-center">Nilai Tugas</th>
                                <th class="text-center">Nilai UTS</th>
                                <th class="text-center">NIlai Uas</th>
                                <th class="text-center">Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $n)
                                <tr>
                                    <td class="text-center">{{$n->nis}}</td>
                                    <td>{{$n->siswa->nama}}</td>
                                    <td class="col-sm-1">
                                        <input type="int" id="nilai_tugas{{$n->id_nilai}}" class="form-control" onkeyup="updateNilai({{$n->id_nilai}})" value="{{$n->nilai_tugas}}">
                                    </td>
                                    <td class="col-sm-1">
                                        <input type="int" id="nilai_uts{{$n->id_nilai}}" class="form-control" onkeyup="updateNilai({{$n->id_nilai}})" value="{{$n->nilai_uts}}">
                                    </td>
                                    <td class="col-sm-1">
                                        <input type="int" id="nilai_uas{{$n->id_nilai}}" class="form-control" onkeyup="updateNilai({{$n->id_nilai}})" value="{{$n->nilai_uas}}">
                                    </td>
                                    <td id="nilai{{$n->id_nilai}}" class="col-sm-1 text-center">
                                        {{$n->nilai}}
                                    </td>
                                </tr>
                            @endforeach
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
@endsection

<script>
function updateNilai(id) {
    var tugas = $("#nilai_tugas"+id).val();
    var uts = $("#nilai_uts"+id).val();
    var uas = $("#nilai_uas"+id).val();
    $.ajax({
        type : 'GET',
        url  : 'http://localhost:8000/nilai/update/'+id+'/'+tugas+'/'+uts+'/'+uas,
        success : function(res) {
            $.each(res, function (i, item) {
                console.log(item.nilai);
                $('#nilai'+id).html('<td id="nilai'+item.id_jadwal+''" class="col-sm-1">'+item.nilai+'</td>');
            })
        }
    })
    
}

</script>


