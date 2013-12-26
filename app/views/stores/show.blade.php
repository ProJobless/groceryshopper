@extends('layouts.scaffold')

@section('main')

<h1>Show Store</h1>

<p>{{ link_to_route('stores.index', 'Return to all stores') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Title</th>
				<th>Phone_1</th>
				<th>Phone_2</th>
				<th>Fax</th>
				<th>Url</th>
				<th>Notes</th>
				<th>Searchable</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $store->name }}}</td>
					<td>{{{ $store->title }}}</td>
					<td>{{{ $store->phone_1 }}}</td>
					<td>{{{ $store->phone_2 }}}</td>
					<td>{{{ $store->fax }}}</td>
					<td>{{{ $store->url }}}</td>
					<td>{{{ $store->notes }}}</td>
					<td>{{{ $store->searchable }}}</td>
                    <td>{{ link_to_route('stores.edit', 'Edit', array($store->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('stores.destroy', $store->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
