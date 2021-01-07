@extends('layouts/navbar')
@section('title', 'Admin LTE | Skripsi Yunita')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    {{-- {{Auth::user()->id_level_user}} --}}
    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $users }}</h3>
                <p>Pengguna Sistem</p>
            </div>
            <div class="icon">
                <i class="fa fa-id-badge"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $siswa }}</h3>

                <p>Siswa</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $guru }}</h3>

                <p>Guru</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-circle"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $ruangan }}</h3>

                <p>Ruangan Kelas</p>
            </div>
            <div class="icon">
                <i class="fa fa-building"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->

</div>
<!-- /.row -->
@endsection