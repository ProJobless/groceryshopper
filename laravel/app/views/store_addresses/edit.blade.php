@extends('layouts.scaffold')

@section('main')

<h1>Edit Store_address</h1>
{{ Form::model($store_address, array('method' => 'PATCH', 'route' => array('store_addresses.update', $store_address->id))) }}
	<ul>
        <li>
            {{ Form::label('store_id', 'Store_id:') }}
            {{ Form::input('number', 'store_id') }}
        </li>

        <li>
            {{ Form::label('line_1', 'Line_1:') }}
            {{ Form::text('line_1') }}
        </li>

        <li>
            {{ Form::label('line_2', 'Line_2:') }}
            {{ Form::text('line_2') }}
        </li>

        <li>
            {{ Form::label('line_3', 'Line_3:') }}
            {{ Form::text('line_3') }}
        </li>

        <li>
            {{ Form::label('city', 'City:') }}
            {{ Form::text('city') }}
        </li>

        <li>
            {{ Form::label('province_state', 'Province_state:') }}
            {{ Form::text('province_state') }}
        </li>

        <li>
            {{ Form::label('country', 'Country:') }}
            {{ Form::text('country') }}
        </li>

        <li>
            {{ Form::label('postal_zip', 'Postal_zip:') }}
            {{ Form::text('postal_zip') }}
        </li>

        <li>
            {{ Form::label('latitude', 'Latitude:') }}
            {{ Form::text('latitude') }}
        </li>

        <li>
            {{ Form::label('longitude', 'Longitude:') }}
            {{ Form::text('longitude') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('store_addresses.show', 'Cancel', $store_address->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
