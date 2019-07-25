@extends('layouts.app')

@section('content')

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Part Name</th>
			<th>Qty</th>
			<th>Price</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($sales as $sale)
		<tr>
			<td>{{ $sale->parts->part_name }}</td>
			<td>{{ $sale->jan_qty }}</td>
			<td>{{ $sale->parts->price->price }}</td>
			<td>{{ $sale->jan_qty * $sale->parts->price->price }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection