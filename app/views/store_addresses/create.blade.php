@extends('layouts.scaffold')

@section('main')

<h1>Create Store_address</h1>

{{ Form::open(array('route' => 'store_addresses.store')) }}
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
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


