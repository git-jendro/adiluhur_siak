@extends('layouts/navbar')
@section('title')
Rule
@endsection
@section('content')
<div class="row">

    <!-- filter -->
    <div class="col-xs-4">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Filter Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table class="table table-bordered">
                    <tr>
                        <th>Level User</th>
                        <th>
                            <select onchange="handleChange()" class="form-control" name="level_user" id="filter_level">
                                <option value="">Pilih Level</option>
                                @foreach ($level as $l)
                                <option value="{{$l->id_level_user}}">{{$l->nama_level}}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

    <div class="col-xs-8">

        <div class="box box-primary">
            <div class="box-header  with-border">
                <h3 class="box-title">Data Hak Akses Module</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div id="table-module">
                    <table id="mytable"
                        class="table table-striped table-bordered table-hover table-full-width dataTable"
                        cellspacing="0" width="100%">
                        <thead>
                            <th>NO</th>
                            <th>NAMA MODUL</th>
                            <th>LINK</th>
                            <th>HAK AKSES</th>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($modul as $m)
                            <tr>
                                <td>{{$m->id}}</td>
                                <td>
                                    {{$m->nama_menu}}
                                </td>
                                <td>{{$m->link}}</td>

                                <td id="check" class="text-center">
                                    <input class="id_check({{$m->id}})" type="checkbox">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

</div>
@endsection
<script>
    function handleChange()
    {
    var level = $("#filter_level").val();
    $('#tbody').html('');
    $.ajax({
        type : 'GET',
        url : 'http://localhost:8000/user/rule/'+level,
        success : function(res) {
                $.each(res.modul, function(mkey, vm) {
                    var id = vm.id 
                    var count = 0;
                    $('#tbody').append('<tr id="' + vm.id + '"><td>' + vm.id + '</td><td>' + vm.nama_menu + '</td><td>' + vm.link + '</td></tr>');
                    $.each(res.count, function(ckey, vc) {
                    if (id == vc.id) {
                        $('#' + id).append('<td id=""><input id="id_check(' + id + ')" onchange="uprule('+ id +')" type="checkbox" checked></td>');
                        count = 1;
                        return false;
                    }
                    });
                    if (count == 0) {
                    $('#' + id).append('<td><input id="id_check(' + id + ')" onchange="uprule('+ id +')" type="checkbox"></td>');
                    }
                });  
            }
        });
    }

    function uprule(id)
    {
    var level = $("#filter_level").val();

    $.ajax({
        type : 'GET',
        url : 'http://localhost:8000/user/uprule/'+level+'/'+id,
        success : function(res) {
                console.log(res)
                 
            }
        });
    }
    
</script>