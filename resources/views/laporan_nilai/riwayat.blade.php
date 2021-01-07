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
                    @if($walikelas != null || Auth::user()->id_level_user == 6)
                    <tr>
                        <th>
                            @if (Auth::user()->id_level_user == 6)
                                Daftar Riwayat Kelas
                            @else
                                Kelas Yang Pernah Diwalikan
                            @endif
                        </th>
                        <th>
                            <select class="form-control" id="filterkelas" onchange="changeKelas()">
                                <option value="">Pilih Kelas</option>
                                @foreach ($walikelas as $item)
                                    <option value="{{$item->id_walikelas}}">{{$item->kelas->nama_kelas}} ({{$item->tahunakademik->tahun_akademik}})</option>
                                @endforeach
                            </select>
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
                            <th class="text-center">LIHAT SISWA</th>
                        </tr>
                    </thead>

                    @if ($walikelas != null)
                    <tbody id="tbody">
                        <tr>
                            <td colspan="4" class="text-center">
                                <h3>Silahkan Pilih Kelas !</h3>
                            </td>
                        </tr>
                    </tbody>
                    @endif

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
    function changeKelas(){
    var wali = $("#filterkelas").val();
    $('#tbody').html('');
    $.ajax({
        type : 'GET',
        url : 'http://localhost:8000/walikelas/'+wali,
        success : function(res) {
                  console.log(res);
                  $.each(res, function(i, item){
                    try {
                    $('#tbody').append('<tr><td>'+item.siswa.nis+'</td><td>'+item.siswa.nama+'</td><td class="text-center">'+item.siswa.status_siswa+'</td><td class="text-center"><a href="/laporan_nilai/nilai/'+item.siswa.nis+'"><i class="fa fa-eye" aria-hidden="true"></i></a></td></tr>');
                    } catch (error) {
                    console.log(error);
                    }
                    })
            }
        });
    }
</script>