@extends('layouts.scaffold')

@section('main')

<h1>Show Store_brand</h1>

<p>{{ link_to_route('store_brands.index', 'Return to all store_brands') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Url</th>
				<th>Notes</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $store_brand->name }}}</td>
					<td>{{{ $store_brand->url }}}</td>
					<td>{{{ $store_brand->notes }}}</td>
                    <td>{{ link_to_route('store_brands.edit', 'Edit', array($store_brand->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('store_brands.destroy', $store_brand->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
