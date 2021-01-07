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
                    <h3>{{$siswa->nama}}</h3>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header  with-border">
                <h3 class="box-title">Daftar Nilai </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>NO. </th>
                            <th>MATA PELAJARAN</th>
                            <th class="text-center">NILAI TUGAS</th>
                            <th class="text-center">NILAI UTS</th>
                            <th class="text-center">NILAI UAS</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        {{-- {{dd($nilai)}} --}}
                        @foreach ($nilai as $item)
                            <tr>
                                <td></td>
                                <td>{{$item->jadwal->mapel->nama_mapel}}</td>
                                <td class="text-center">{{$item->nilai_tugas}}</td>
                                <td class="text-center">{{$item->nilai_uts}}</td>
                                <td class="text-center">{{$item->nilai_uas}}</td>
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