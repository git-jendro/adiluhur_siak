@extends('layouts/navbar')
@section('title')
Data Nilai |
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
    
            <div class="box box-primary">
                <div class="box-header  with-border">
                    <h3 class="box-title">Data Nilai Siswa {{$siswa->nama}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
    
                    <!-- button add -->
    
                    <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="50px">NO</th>
                                <th>Nama Mapel</th>
                                <th>Nilai</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $n)
                                <tr>
                                    <td></td>
                                    <td>{{$n->jadwal->mapel->nama_mapel}}</td>
                                    <td>{{$n->nilai}}</td>
                                    <td class="text-center">
                                        @if ($n->nilai > 90)
                                            <p class="text-green">Sangat baik</p>
                                        @elseif($n->nilai > 80 and $n->nilai <= 90)
                                            <p class="text-green">Baik</p>
                                        @elseif($n->nilai > 70 and $n->nilai <= 80)
                                            <p class="text-yellow">Cukup</p>
                                        @else
                                            <p class="text-red">Kurang</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="col-sm-12 text-center">
                        
                    </div> --}}
    
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
<style>
    body {
        counter-reset: Serial;
        /* Set the Serial counter to 0 */
    }

    table {
        border-collapse: separate;
    }

    tr td:first-child:before {
        counter-increment: Serial;
        /* Increment the Serial counter */
        content: counter(Serial);
        /* Display the counter */
    }

</style>