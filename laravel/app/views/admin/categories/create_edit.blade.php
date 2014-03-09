@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
   <a href="{{{ URL::to('admin/categories') }}}" title="Manage users" class="tip-bottom"><i class="fa fa-user"></i>categories</a>
   <a href="{{{ URL::to('admin/categories/' . (isset($category) ? $category->id.'/edit' : 'create') ) }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-edit"></i>{{{ $title }}}</a>

@stop
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop

{{-- Content --}}
@section('formcontent')
{{-- Create category Form --}}
<form class="form-horizontal" name="basic_validate" id="basic_validate" method="post"
        action="@if (isset($category)){{ URL::to('admin/categories/' . $category->id . '/edit') }}@endif" autocomplete="off" novalidate="novalidate">
  <!-- CSRF Token -->
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  <!-- ./ csrf token -->

  <!-- title -->
  <div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="title">Title</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
    <input class="form-control input-sm" type="text" name="title" id="title" value="{{{ Input::old('title', isset($category) ? $category->title : null) }}}" />
    {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ title -->
  <!-- Rank -->
  <div class="form-group {{{ $errors->has('rank') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="rank">Rank</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
      <!-- row -->
      <div class="row">
        <!-- size -->
        <div class="col-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control input-sm" type="text" name="rank" id="rank" value="{{{ Input::old('rank', isset($category) ? $category->rank : null) }}}" />
            {{ $errors->first('rank', '<span class="help-inline">:message</span>') }}
          </div>
         </div>
      </div><!-- /row -->
     </div>
  </div>
  <!-- ./ rank -->
  <!-- meta_title -->
  <div class="form-group {{{ $errors->has('meta_title') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="meta_title">Meta title</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
    <input class="form-control input-sm" type="text" name="meta_title" id="meta_title" value="{{{ Input::old('meta_title', isset($category) ? $category->meta_title : null) }}}" />
    {{ $errors->first('meta_title', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ meta_title -->
  <!-- slug -->
  <div class="form-group {{{ $errors->has('slug') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="slug">slug</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
    <input class="form-control input-sm" type="text" name="slug" id="slug" value="{{{ Input::old('slug', isset($category) ? $category->slug : null) }}}" />
    {{ $errors->first('slug', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ slug -->

<!-- Form Actions -->
  <div class="form-actions">
        <button type="submit" class="btn btn-success">Save changes</button>
        <button type="button" class="btn">Cancel</button>
        <button type="reset" class="btn btn-default">Reset</button>
  </div>
<!-- ./ form actions -->
</form>
@stop
@section('scripts')
  <script type="text/javascript">
  $(document).ready(function(){
    $('input[type=checkbox],input[type=radio]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    // Form Validation
    $("#basic_validate").validate({
      rules:{
        title:{
          required:true
        },
        meta_title:{
           required:false,
        },
        rank:{
           required:true,
          number:true,
          min:1
        },
        slug:{
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
