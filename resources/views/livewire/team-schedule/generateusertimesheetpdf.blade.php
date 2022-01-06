<html>
<head>
	<title>Generate Timesheet User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 8pt;
		}
	</style>

    <center>
		<h5>Generate Timesheet User </h4>		
	</center>

 
	<table class='table table-striped '>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>NIK</th>
				<th style="background-color: #ffcfcf;">Date Plan Schedule</th>
				<th style="background-color: #ffcfcf;">Start Time</th>
				<th style="background-color: #ffcfcf;">End Time</th>
                <th style="background-color: #d2ffcf;">Date Actual Schedule</th>
				<th style="background-color: #d2ffcf;">Start Time</th>
				<th style="background-color: #d2ffcf;">End Time</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($data as $item)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{ $item->name }}</td>
				<td>{{ $item->nik }}</td>
				<td>{{ date_format(date_create($item->start_schedule), 'd M Y') }}</td>
				<td>{{ date_format(date_create($item->start_schedule), 'H:i') }}</td>
				<td>{{ date_format(date_create($item->end_schedule), 'H:i') }}</td>
				<td>{{ date_format(date_create($item->start_actual), 'd M Y') }}</td>
				<td>{{ date_format(date_create($item->start_actual), 'H:i') }}</td>
				<td>{{ date_format(date_create($item->end_actual), 'H:i') }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>