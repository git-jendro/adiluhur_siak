@extends('layouts/navbar')
@section('title', 'Tambah Data Siswa | ')
@section('content')
<div class="row">
    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Tambah Siswa</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                <form role="form" class="form-horizontal" action="/siswa/store" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <!--div class="form-group">
                                      <label class="col-sm-2 control-label">NIS</label>
                
                                      <div class="col-sm-9">
                                        <input type="text" id="number" name="nis" class="form-control" value="0" readonly>
                                      </div>
                                  </div-->

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>

                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tempat, Tgl Lahir</label>

                        <div class="col-sm-5">
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir"
                                required>
                        </div>

                        <div class="col-sm-2">
                            <input type='text' class="form-control" id='datepicker'
                                placeholder='Tahun / Bulan / Tanggal' name="tanggal_lahir" style='width: 300px;'
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Kelamin</label>

                        <div class="col-sm-5">
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="0">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Agama</label>

                        <div class="col-sm-5">
                            <select name="kd_agama" class="form-control" required>
                                <option value="">Pilih Agama</option>
                                <option value="1">ISLAM</option>
                                <option value="2">KRISTEN/ PROTESTAN</option>
                                <option value="3">KATHOLIK</option>
                                <option value="4">HINDU</option>
                                <option value="5">BUDHA</option>
                                <option value="6">KHONG HU CHU</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat Siswa</label>

                        <div class="col-sm-9">
                            <input type="text" name="alamat_siswa" class="form-control"
                                placeholder="Masukkan Alamat Siswa" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Telp Siswa</label>

                        <div class="col-sm-9">
                            <input type="text" name="no_telp_siswa" class="form-control"
                                placeholder="Masukkan Nomor Telp Siswa" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Sekolah Asal</label>

                        <div class="col-sm-9">
                            <input type="text" name="sekolah_asal" class="form-control"
                                placeholder="Masukkan Nama Sekolah Asal" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Ijazah</label>

                        <div class="col-sm-9">
                            <input type="text" name="no_ijazah" class="form-control" placeholder="Masukkan Nomor Ijazah"
                                required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Ayah</label>

                        <div class="col-sm-9">
                            <input type="text" name="nama_ayah" class="form-control"
                                placeholder="Masukkan Nama Ayah Siswa" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Ibu</label>

                        <div class="col-sm-9">
                            <input type="text" name="nama_ibu" class="form-control"
                                placeholder="Masukkan Nama Ibu Siswa" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat Orang Tua</label>

                        <div class="col-sm-9">
                            <input type="text" name="alamat_ortu" class="form-control"
                                placeholder="Masukkan Alamat Orang Tua " required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Telp Orang Tua</label>

                        <div class="col-sm-9">
                            <input type="text" name="no_telp_ortu" class="form-control"
                                placeholder="Masukkan Nomor Telp Orang Tua " required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Foto</label>

                        <div class="col-sm-5">
                            <input type="file" name="foto">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kelas Awal</label>

                        <div class="col-sm-5">
                            <select id="kelas" name="kd_kelas" class="form-control" onchange="check()" required>
                                <option value="">Pilih Kelas</option>
                                <option value="IPAX1">X IPA 1</option>
                                <option value="IPAX2">X IPA 2</option>
                                <option value="IPAXI1">XI IPA 1</option>
                                <option value="IPAXI2">XI IPA 2</option>
                                <option value="IPAXII">XII IPA </option>
                                <option value="IPSX1">X IPS 1</option>
                                <option value="IPSX2">X IPS 2</option>
                                <option value="IPSXI">XI IPS </option>
                                <option value="IPSXII">XII IPS</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status Siswa</label>

                        <div class="col-sm-5">
                            <select name="status_siswa" class="form-control" required>
                                <option value="0">Pilih Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Keluar">Keluar</option>
                                <option value="Pindah">Pindah</option>
                                <option value="Lulus">Lulus</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" placeholder="Masukkan Username"
                                required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-1">
                            <button type="submit" name="submit" onclick="incrementValue()" value="Increment Value"
                                class="btn btn-primary btn-flat">Simpan</button>
                        </div>

                        <div class="col-sm-1">

                        </div>
                    </div>

            </div>
            <!-- /.box-body -->
            </form>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<script type="text/javascript">
    function incrementValue()
    {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('number').value = value;
    }
    
    
    // JS Datepicker
    $(document).ready(function(){
     
      $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        startDate: new Date('2000-1-1'),
        endDate: new Date('2006-12-31')
      });
    
    });

    function check()
    {
        var kelas = $("#kelas").val();
        $.ajax({
            type : 'GET',
            url : 'http://localhost:8000/siswa/kelas/'+kelas,
            success : function(res) {
                console.log(res);
                if (res == 'false') {
                    alert("Kelas Penuh");
                }
                }
        })
    }
</script>
@endsection