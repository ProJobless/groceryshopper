@extends('layouts.scaffold')

@section('main')

<h1>Edit Product</h1>
{{ Form::model($product, array('method' => 'PATCH', 'route' => array('products.update', $product->id))) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('alternative_name', 'Alternative_name:') }}
            {{ Form::text('alternative_name') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('products.show', 'Cancel', $product->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
