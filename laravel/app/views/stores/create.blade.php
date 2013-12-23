@extends('layouts.scaffold')

@section('main')

<h1>Create Store</h1>

{{ Form::open(array('route' => 'stores.store')) }}
	<ul>
        <li>
            {{ Form::label('slug', 'Slug:') }}
            {{ Form::text('slug') }}
        </li>

        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
            {{ Form::label('phone_1', 'Phone_1:') }}
            {{ Form::text('phone_1') }}
        </li>

        <li>
            {{ Form::label('phone_2', 'Phone_2:') }}
            {{ Form::text('phone_2') }}
        </li>

        <li>
            {{ Form::label('fax', 'Fax:') }}
            {{ Form::text('fax') }}
        </li>

        <li>
            {{ Form::label('url', 'Url:') }}
            {{ Form::textarea('url') }}
        </li>

        <li>
            {{ Form::label('notes', 'Notes:') }}
            {{ Form::textarea('notes') }}
        </li>

        <li>
            {{ Form::label('searchable', 'Searchable:') }}
            {{ Form::checkbox('searchable') }}
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


