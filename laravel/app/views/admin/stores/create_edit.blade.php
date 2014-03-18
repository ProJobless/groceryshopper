@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
   <a href="{{{ URL::to('admin/units') }}}" title="Manage users" class="tip-bottom"><i class="fa fa-user"></i>Stores</a>
   <a href="{{{ URL::to('admin/units/' . (isset($unit) ? $unit->id.'/edit' : 'create') ) }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-edit"></i>{{{ $title }}}</a>
@stop
asdasd
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop


{{-- Content --}}
@section('formcontent')
{{-- Edit Store Form --}}
<form class="form-horizontal" name="basic_validate" id="basic_validate" method="post"
        action="@if (isset($unit)){{ URL::to('admin/units/' . $unit->id . '/edit') }}@endif" autocomplete="off" novalidate="novalidate">
  <!-- CSRF Token -->
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  <!-- ./ csrf token -->

  <!-- Store Title -->
  <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="title">Store title</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
    <input class="form-control input-sm" type="text" name="title" id="title" value="{{{ Input::old('title', isset($store) ? $store->title : null) }}}" />
    {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ store title -->
  <div class="form-group {{{ $errors->has('chain') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="chain">Store chain</label>
      <div class="col-sm-9 col-md-9 col-lg-10">
            <select multiple id="chains" name="chains[]" class="from-control" >
              @foreach ($chains as $chain)
                @if ($mode == 'create')
                <option value="{{{ $chain->id }}}"{{{ ( in_array($chain->id, $selectedChains) ? ' selected="selected"' : '') }}}>{{{ $chain->chain_name }}}</option>
                @else
                <option value="{{{ $chain->id }}}"{{{ ( array_search($chain->id, $store->currentChainIds()) !== false && array_search($chain->id, $groceryitem->currentcategoryIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $chain->chain_name }}}</option>
                @endif
              @endforeach
            </select>
            {{ $errors->first('chains', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ chain id -->


  <!-- Address -->
  <div class="form-group {{{ $errors->has('line_1') ? 'error' : '' }}}">
      <div class="col-md-12">
          <label class="control-label" for="line_1">Street</label>
          <input class="form-control" type="text" name="line_1" id="line_1" value="{{{ Input::old('line_1', isset($store) ? $store->line_1 : null) }}}" />
          {{ $errors->first('line_1', '<span class="help-inline">:message</span>') }}
      </div>
  </div>
  <div class="controls controls-row">
      <div class="form-group row {{{ $errors->has('city') ? 'error' : '' }}}">
          <div class="col-lg-4">
              <label class="control-label" for="store">City</label>
              <input class="form-control" type="text" name="city" id="city" value="{{{ Input::old('city', isset($store) ? $store->city : null) }}}" />
              {{ $errors->first('city', '<span class="help-inline">:message</span>') }}
          </div>
          <div class="col-lg-3">
              <label class="control-label" for="province_state">Province</label>
              {{ Form::select('province_state',
                                       array('QC' => 'Quebec', 'ON' => 'Ontario'),
                                       Input::old('province_state', isset($store) ? $store->province_state : null),
                                       array (
                                              'class' => 'form-control',
                                              'name' => 'province_state',
                                              'id'    => 'province_state'
                                       )
                             )
               }}
              {{ $errors->first('province_state', '<span class="help-inline">:message</span>') }}
          </div>
          <div class="col-lg-3">
              <label class="control-label" for="country">Country</label>
              {{ Form::select('country',
                                       array('CA' => 'Canada', 'USA' => 'USA'),
                                       Input::old('country', isset($store) ? $store->country : null),
                                       array (
                                              'class' => 'form-control',
                                              'name' => 'country',
                                              'id'    => 'country'
                                       )
                             )
               }}
              {{ $errors->first('country', '<span class="help-inline">:message</span>') }}
          </div>
          <div class="col-lg-2">
              <label class="control-label" for="postal_zip">Postal Code</label>
              <input class="form-control" type="text" name="postal_zip" id="postal_zip" value="{{{ Input::old('postal_zip', isset($store) ? $store->postal_zip : null) }}}" />
              {{ $errors->first('postal_zip', '<span class="help-inline">:message</span>') }}
          </div>
      </div>
      <div class="form-group {{{ $errors->has('line_1') ? 'error' : '' }}}">
      </div>
  </div>
  <!-- phone -->
  <div class="form-group {{{ $errors->has('phone_1') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="phone_1">Phone</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
      <input class="form-control" type="text" name="phone_1" id="phone" value="{{{ Input::old('phone', isset($groceryitem) ? $groceryitem->phone : null) }}}" />
      {{ $errors->first('phone_1', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ manufacturer -->
  <div class="form-group {{{ $errors->has('fax') ? 'error' : '' }}}">
      <div class="col-md-12">
          <label class="control-label" for="fax">Fax</label>
          <input class="form-control" type="text" name="fax" id="fax" value="{{{ Input::old('line_1', isset($store) ? $store->fax : null) }}}" />
          {{ $errors->first('fax', '<span class="help-inline">:message</span>') }}
      </div>
  </div>
  <!-- URL friendly slug -->
  <div class="form-group {{{ $errors->has('slug') ? 'error' : '' }}}">
      <div class="col-md-12">
          <label class="control-label" for="slug">URL friendly name</label>
          <input class="form-control" type="text" name="slug" id="slug" value="{{{ Input::old('slug', isset($store) ? $store->slug : null) }}}" />
          {{ $errors->first('slug', '<span class="help-inline">:message</span>') }}
      </div>
  </div>
  <!-- ./ slug -->

  <!-- Website -->
  <div class="form-group {{{ $errors->has('url') ? 'error' : '' }}}">
      <div class="col-md-12">
          <label class="control-label" for="url">Website </label>
          <input class="form-control" type="text" name="url" id="url" value="{{{ Input::old('url', isset($store) ? $store->url : null) }}}" />
          {{ $errors->first('url', '<span class="help-inline">:message</span>') }}
      </div>
  </div>
  <!-- ./ Url -->


  <!-- Notes -->
  <div class="form-group {{{ $errors->has('notes') ? 'error' : '' }}}">
      <div class="col-md-12">
          <label class="control-label" for="content">Notes</label>
          <textarea class="form-control full-width" name="notes" value="notes" rows="4">{{ Input::old('notes', isset($store) ? $store->notes : null) }}</textarea>
          {{ $errors->first('notes', '<span class="help-inline">:message</span>') }}
      </div>
  </div>
  <!-- searchable -->
  <?php $checked = (isset($store) && $store->searchable == 1) ? 'checked' : ""; ?>
  <div class="form-group {{{ $errors->has('searchable') ? 'error' : '' }}}">
      <div class="col-md-12">
          <label class="control-label" for="content">Can this store be searched?
                  <input type="checkbox" name="searchable" {{{ Input::old('searchable', isset($store) ? $checked : NULL ) }}}
                          value="{{{ Input::old('searchable', isset($store) ? $store->searchable : 0 ) }}}" id="searchable">
          </label>
          {{ $errors->first('searchable', '<span class="help-inline">:message</span>') }}
      </div>
  </div>
  <!-- ./ content -->
  <!-- Form Actions -->
  <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="reset" class="btn btn-default">Reset</button>
          <element class="btn-cancel close_popup">Cancel</element>
      </div>
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
