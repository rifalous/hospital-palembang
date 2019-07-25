<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pembayaran Rawan Jalan</title>
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
<center><p><strong>Laporan Pembayaran Rawan Jalan</strong></p></center>

<br>

<table class="custom-table" style="width: 100%">
	<thead>
		
        <tr>
            <th><center>No Registrasi</th></center>
            <th>Tanggal Bayar</th>
            <th>Total Biaya</th>
            <th>Sisa Tagihan</th>
            <th>Sisa Pembayaran</th>
            <th>Pembayaran</th>
        </tr>
	</thead>
	<tbody>
		@foreach($hospitalisationday as $data)
		<tr>
			<td><center>{{ $data->outpatient->no_registrasi }}</td></center>
			<center></center><td>{{ $data->tgl_bayar }}</td>
			<td>Rp {{ number_format($data->total_biaya) }}</td>
			<td>Rp {{ number_format($data->sisa_tagihan) }}</td>
			<td>Rp {{ number_format($data->sisa_pembayaran) }}</td>
			<center></center><td>{{ $data->payment }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>