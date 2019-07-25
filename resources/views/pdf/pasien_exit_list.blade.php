<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pasien Keluar Periode</title>
</head>
<body>
<style type="text/css">

	body {
		color: #333;
	}

	table {
	    border-collapse: collapse;
	    font-size: 12px;
	}

	p {
		font-size: 13px;
	}

	.custom-table thead {
		background-color: #e1e1e1;
	}

	.custom-table tr > th, .custom-table tr > td {
		border: 1px solid #ccc;
		box-shadow: none;
		padding: 5px;
	}

	.text-center {
		text-align: center;
	}

	.top-table {
		margin-bottom: 10px;
	}

	.top-table tr > td {
		padding: 3px 10px;
	}

</style>
<center><p><strong>Laporan Pasien Keluar</strong></p></center>

<br>

<table class="custom-table" style="width: 100%">
	<thead>
		
        <tr>
            <th>No Registrasi</th>
            <th>Nama Pasien</th>
            <th>Usia </th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Masuk</th>
            <th>Jam</th>
            <th>Ruang</th>
            <th>Kelas</th>
            <th>Diagnosis</th>
            <th>Tanggal keluar</th>
            <th>Jam</th>
            <th>Cara Keluar</th>
            <th>Keadaan Keluar</th>
            <th>Total Biaya</th>
        </tr>
	</thead>
	<tbody>
		@foreach($pasien_exit as $data)
		<tr>
			<td><center>{{ $data->outpatient->no_registrasi }}</td></center>
			<center></center><td>{{ $data->no_registrasi }}</td>
			<center></center><td>{{ $data->pasien->name }}</td>
			<center></center><td>{{ $data->pasien->details->age }}</td>
			<center></center><td>{{ $data->pasien->details->gender }}</td>
			<center></center><td>{{ $data->tgl_masuk }}</td>
			<center></center><td>{{ $data->time }}</td>
			<center></center><td>{{ $data->room->name }}</td>
			<center></center><td>{{ $data->room->level->class }}</td>
			<center></center><td>{{ $data->disease }}</td>
			<center></center><td>{{ $data->tgl_keluar }}</td>
			<center></center><td>{{ $data->time_keluar }}</td>
			<center></center><td>{{ $data->way_out }}</td>
			<td>Rp {{ number_format($data->exit_state) }}</td>
			<td>Rp {{ number_format($data->total_biaya) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>