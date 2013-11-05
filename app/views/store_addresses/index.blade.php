@extends('layouts.scaffold')

@section('main')

<h1>All Store_addresses</h1>

<p>{{ link_to_route('store_addresses.create', 'Add new store_address') }}</p>

@if ($store_addresses->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Store_id</th>
				<th>Line_1</th>
				<th>Line_2</th>
				<th>Line_3</th>
				<th>City</th>
				<th>Province_state</th>
				<th>Country</th>
				<th>Postal_zip</th>
				<th>Latitude</th>
				<th>Longitude</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($store_addresses as $store_address)
				<tr>
					<td>{{{ $store_address->store_id }}}</td>
					<td>{{{ $store_address->line_1 }}}</td>
					<td>{{{ $store_address->line_2 }}}</td>
					<td>{{{ $store_address->line_3 }}}</td>
					<td>{{{ $store_address->city }}}</td>
					<td>{{{ $store_address->province_state }}}</td>
					<td>{{{ $store_address->country }}}</td>
					<td>{{{ $store_address->postal_zip }}}</td>
					<td>{{{ $store_address->latitude }}}</td>
					<td>{{{ $store_address->longitude }}}</td>
                    <td>{{ link_to_route('store_addresses.edit', 'Edit', array($store_address->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('store_addresses.destroy', $store_address->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no store_addresses
@endif

@stop
