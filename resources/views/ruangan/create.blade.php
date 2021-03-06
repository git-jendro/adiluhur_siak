@extends('layouts/navbar')
@section('title')
Tambah Data Ruangan |
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Tambah Ruangan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                <form role="form" class="form-horizontal" action="/ruangan/store" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kode Ruangan</label>

                        <div class="col-sm-9">
                            <input type="text" name="kd_ruangan" class="form-control" placeholder="Masukkan Kode Mapel"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Ruangan</label>

                        <div class="col-sm-9">
                            <input type="text" name="nama_ruangan" class="form-control"
                                placeholder="Masukkan Nama Mapel" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kapasitas</label>

                        <div class="col-sm-9">
                            <input type="text" name="kapasitas" class="form-control" placeholder="Masukkan Kapasistas"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-1">
                            <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</div>
<!-- /.box-body -->
</form>
</div>
<!-- /.box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
@endsection