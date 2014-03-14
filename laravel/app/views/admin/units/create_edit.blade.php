@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
   <a href="{{{ URL::to('admin/units') }}}" title="Manage users" class="tip-bottom"><i class="fa fa-user"></i>Units</a>
   <a href="{{{ URL::to('admin/units/' . (isset($unit) ? $unit->id.'/edit' : 'create') ) }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-edit"></i>{{{ $title }}}</a>

@stop
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop

{{-- Content --}}
@section('formcontent')
{{-- Create category Form --}}
<form class="form-horizontal" name="basic_validate" id="basic_validate" method="post"
        action="@if (isset($unit)){{ URL::to('admin/units/' . $unit->id . '/edit') }}@endif" autocomplete="off" novalidate="novalidate">
  <!-- CSRF Token -->
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  <!-- ./ csrf token -->

  <!-- title -->
  <div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="title">Title</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
    <input class="form-control input-sm" type="text" name="title" id="title" value="{{{ Input::old('title', isset($unit) ? $unit->title : null) }}}" />
    {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ title -->
  <!-- symbol -->
  <div class="form-group {{{ $errors->has('symbol') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="symbol">Symbol</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
      <!-- row -->
      <div class="row">
        <!-- size -->
        <div class="col-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control input-sm" type="text" name="symbol" id="symbol" value="{{{ Input::old('symbol', isset($unit) ? $unit->symbol : null) }}}" />
            {{ $errors->first('symbol', '<span class="help-inline">:message</span>') }}
          </div>
         </div>
      </div><!-- /row -->
     </div>
  </div>
  <!-- ./ symbol -->
  <!-- name -->
  <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="name">System name</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
    <input class="form-control input-sm" type="text" name="name" id="name" value="{{{ Input::old('name', isset($unit) ? $unit->name : null) }}}" />
    {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ name -->

<!-- Form Actions -->
  <div class="form-actions">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn">Cancel</button>
        <button type="reset" class="btn btn-default">Reset</button>
  </div>
<!-- ./ form actions -->
</form>
@stop
@section('scripts')
  <script type="text/javascript">
  $(document).ready(function(){

    // Form Validation
    $("#basic_validate").validate({
      rules:{
        title:{
          required:true
        },
        name:{
           required:false,
        },
        symbol:{
           required:true,
        },
      },
      errorClass: "help-inline has-error",
      errorElement: "div",
      highlight:function(element, errorClass, validClass) {
        $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
       },
      unhighlight: function(element, errorClass, validClass) {
        $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
      }
    });
  });
</script>
@stop
