@extends('layouts/navbar')
@section('title')
Wali Kelas |
@endsection
@section('content')
<div class="row">

    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header  with-border">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Tahun Akademik</th>
                        <th> : {{$tahunakademik->tahun_akademik}} </th>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <th> : {{$tahunakademik->semester}} </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header  with-border">
                <h3 class="box-title">Data Table Walikelas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KELAS</th>
                            <th>NAMA JURUSAN</th>
                            <th>TINGKATAN</th>
                            <th>NAMA WALIKELAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($walikelas as $w)

                        <tr>
                            <td></td>
                            <td>
                                {{$w->kelas->nama_kelas}}
                            </td>

                            <td>
                                {{$w->jurusan->nama_jurusan}}
                            </td>
                            <td>
                                {{$w->tingkatan->nama_tingkatan}}
                            </td> 
                            <td>
                                <select id="guru{{$w->id_walikelas}}" name="id_guru" class="form-control guru"
                                    onChange="updateGuru({{$w->id_walikelas}})">
                                    <option value="{{$w->id_guru}}">{{$w->guru->nama_guru}}</option>
                                    @foreach ($guru as $g)
                                    <option value="{{$g->id_guru}}">{{$g->nama_guru}}</option>
                                    @endforeach
                                </select>
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
<script>
    function updateGuru(id)
    {
    var guru = $("#guru"+id).val();
    $.ajax({
        type : 'GET',
        url : 'http://localhost:8000/walikelas/'+guru+'/'+id,
            success : function(res) {
                console.log(res);
            }
        })
    }
</script>