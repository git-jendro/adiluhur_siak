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
                </table>
            </div>
        </div>
    </div>

    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header  with-border">
                <h3 class="box-title">Daftar Kelas yang Diajar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Jurusan &amp; Tingkatan</th>
                            <th>MATA PELAJARAN</th>
                            <th>HARI</th>
                            <th>JAM</th>
                            <th>RUANG</th>
                            <th></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($jadwal as $j)
                        <tr>
                            <td></td>
                            <td>{{$j->jurusan->nama_jurusan}} {{$j->tingkatan->nama_tingkatan}}</td>
                            <td>{{$j->mapel->nama_mapel}}</td>
                            <td>{{$j->hari}}</td>
                            <td>{{$j->jam}}</td>
                            <td>{{$j->ruangan->nama_ruangan}}</td>
                            <td><a href="nilai/{{$j->id_jadwal}}"><i class="fa fa-eye"
                                        aria-hidden="true"></i></a>
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