@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
   <a href="{{{ URL::to('admin/chains') }}}" title="Manage store chains" class="tip-bottom"><i class="fa fa-user"></i>Store chains</a>
   <a href="{{{ URL::to('admin/chains/' . (isset($chain) ? $chain->id.'/edit' : 'create') ) }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-edit"></i>{{{ $title }}}</a>

@stop
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop

{{-- Content --}}
@section('formcontent')
{{-- Create category Form --}}
<form class="form-horizontal" name="basic_validate" id="basic_validate" method="post"
        action="@if (isset($chain)){{ URL::to('admin/chains/' . $chain->id . '/edit') }}@endif" autocomplete="off" novalidate="novalidate">
  <!-- CSRF Token -->
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  <!-- ./ csrf token -->

  <!-- chain_name -->
  <div class="form-group {{{ $errors->has('chain_name') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="chain_name">Name</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
    <input class="form-control input-sm" type="text" name="chain_name" id="chain_name" value="{{{ Input::old('chain_name', isset($chain) ? $chain->chain_name : null) }}}" />
    {{ $errors->first('chain_name', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ chain_name -->
  <!-- alternate_name -->
  <div class="form-group {{{ $errors->has('alternate_name') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="alternate_name">Alternate name</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
      <!-- row -->
      <div class="row">
        <!-- size -->
        <div class="col-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control input-sm" type="text" name="alternate_name" id="alternate_name" value="{{{ Input::old('alternate_name', isset($chain) ? $chain->alternate_name : null) }}}" />
            {{ $errors->first('alternate_name', '<span class="help-inline">:message</span>') }}
          </div>
         </div>
      </div><!-- /row -->
     </div>
  </div>
  <!-- ./ alternate_name -->
  <!-- url -->
  <div class="form-group {{{ $errors->has('url') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="url">Url</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
    <input class="form-control input-sm" type="text" name="url" id="url" value="{{{ Input::old('url', isset($chain) ? $chain->url : null) }}}" />
    {{ $errors->first('url', '<span class="help-inline">:message</span>') }}
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
        chain_name:{
          required:true
        },
        url:{
           required:true,
        },
        alternate_name:{
           required:false,
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
