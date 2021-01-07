<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Print Laporan Nilai</title>
    <style type="text/css">
        body {
            font-size: 10pt;
            padding-top: 1rem;
        }
        table {
            border-left: 0.01em solid #ccc;
            border-right: 0;
            border-top: 0.01em #ccc;
            border-bottom: 0;
            border-collapse: collapse;
            margin:auto;
        }
        table td,
        table th {
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
        }
        /* table td, table th {
            border: 1px solid;
        } */
        .rowspan {
            border-left-width: 10px;
        }
        thead {
            display: table-header-group;
        }
        
    </style>
</head>
<body>
	<center>
		{{-- <img src="https://picsum.photos/200/300"><h5>SMA Adiluhur</h4> --}}
    </center>
    
    <table style="border: 0rem; margin-top: 4rem;">
        <thead>
            <tr>
                <td style="width: 150px; border: 0rem;">
                    Nama Sekolah
                </td>
                <td style="width: 150px; border: 0rem;">
                    : SMA Adi Luhur
                </td>
                <td style="width: 150px; border: 0rem;; padding-left:2rem">
                    Kelas
                </td>
                <td style="width: 150px; border: 0rem;">
                    : SMA Adi Luhur
                </td>
            </tr>
            <tr>
                <td style="width: 150px; border: 0rem;">
                    Alamat Sekolah
                </td>
                <td style="width: 150px; border: 0rem;">
                    : Jl. Condet Raya No. 4
                </td>
                <td style="width: 150px; border: 0rem;; padding-left:2rem">
                    Semester
                </td>
                <td style="width: 150px; border: 0rem;">
                    : {{$tahun->semester}}
                </td>
            </tr>
            <tr>
                <td style="width: 150px; border: 0rem;">
                    Nama Siswa
                </td>
                <td style="width: 150px; border: 0rem;">
                    : {{$siswa->nama}}
                </td>
            </tr>
            <tr>
                <td style="width: 150px; border: 0rem;">
                    Nomor Induk Siswa / NISN
                </td>
                <td style="width: 150px; border: 0rem;">
                    : {{$siswa->nis}}
                </td>
            </tr>
        </thead>
    </table>

	<table style="margin-top: 2rem">
		<thead>
			<tr>
				<th style="border: 1px solid;" rowspan="2">No</th>
				<th style="border: 1px solid;" rowspan="2">MATA PELAJARAN</th>
				<th style="border: 1px solid;" rowspan="2" style="width: 200px;">KKM</th>
				<th colspan="2" style="width: 150px; border: 1px solid;">Pengetahuan</th>
				<th colspan="2" style="width: 150px; border: 1px solid;">Keterampilan</th>
			</tr>
			<tr>
				<th style="border: 1px solid;">Angka</th>
				<th style="border: 1px solid;">Predikat</th>
				<th style="border: 1px solid;">Angka</th>
				<th style="border: 1px solid;">Predikat</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($nilai as $item)
			<tr>
                {{-- {{dd($item->jadwal)}} --}}
				<td style="width: 50px; border: 1px solid;"><center>{{ $i++ }}</center></td>
				<td style="width: 350px; border: 1px solid;">{{$item->jadwal->mapel->nama_mapel}}</td>
				<td style="border: 1px solid;">{{$item->kkm}}</td>
				<td style="border: 1px solid;">{{$item->alamat}}</td>
				<td style="border: 1px solid;">{{$item->telepon}}</td>
				<td style="border: 1px solid;">{{$item->pekerjaan}}</td>
				<td style="border: 1px solid;">{{$item->pekerjaan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>