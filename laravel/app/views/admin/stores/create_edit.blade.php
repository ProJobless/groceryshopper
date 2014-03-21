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
  <div class="form-group {{{ $errors->has('chain_id') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="chain_id">Store chain</label>
      <div class="col-sm-9 col-md-9 col-lg-10">
            <select id="chains" name="chain_id" class="from-control" >
              @foreach ($chains as $chain)
                @if ($mode == 'create')
                <option value="{{{ $chain->id }}}"{{{ ( in_array($chain->id, $selectedChains) ? ' selected="selected"' : '') }}}>{{{ $chain->chain_name }}}</option>
                @else
                <option value="{{{ $chain->id }}}"{{{ ( array_search($chain->id, $selectedChains) !== false && array_search($chain->id, $selectedChains) >= 0 ? ' selected="selected"' : '') }}}>
                  {{{ $chain->chain_name }}}
                </option>
                @endif
              @endforeach
            </select>
            {{ $errors->first('chains', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ chain id -->


  <!-- Address -->
  <div class="form-group {{{ $errors->has('line_1') ? 'error' : '' }}}">
    <label for="store_id" class="label_ttl col-sm-3 col-md-3 col-lg-2 control-label">Address</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
      <div class="row">
        <input class="form-control" type="text" name="line_1" placeholder="Street" id="line_1" value="{{{ Input::old('line_1', isset($store) ? $store->line_1 : null) }}}" />
        {{ $errors->first('line_1', '<span class="help-inline">:message</span>') }}
      </div>
      <div class="row">
        <!-- city -->
        <div class="col-md-4">
          <input class="form-control" type="text" name="city" placeholder="City"id="city" value="{{{ Input::old('city', isset($store) ? $store->city : null) }}}" />
          {{ $errors->first('city', '<span class="help-inline">:message</span>') }}
        </div>
        <!-- ./city  -->

        <!-- province -->
        <div class="col-md-4">
          <select placeholder=" Province or state" id="province_state" name="province_state" class="rm-control" >
            @foreach ($provinces as $province_id => $province_name)
              @if ($mode == 'create')
              <option value="{{{ $province_id }}}"{{{ ( in_array($province_id, $selectedProvinces) ? ' selected="selected"' : '') }}}>
                {{{ $province_name }}}
              </option>
              @else
                <text>{{ $province_id }} </text>
                <text>{{ $province_state = Input::old('province_state', isset($store) ? $store->province_state : null); }}</text>
              <option value="{{{ $province_id }}}"{{{ ($province_id === $province_state)  ? ' selected="selected"' : '' }}}>
                {{{ $province_name }}}
              </option>
              @endif
            @endforeach
          </select>
          {{ $errors->first('province_state', '<span class="help-inline">:message</span>') }}
        </div>
        <!-- ./province  -->

        <!-- country -->
        <div class="col-md-4">
          <select id="country" name="country" class="rm-control" >
            @foreach ($countries as $country_id => $country_name)
              @if ($mode == 'create')
              <option value="{{{ $country_id }}}"{{{ ( in_array($country_id, $selectedCountries) ? ' selected="selected"' : '') }}}>
                {{{ $country_name }}}
              </option>
              @else
                <text>{{ $country = Input::old('country', isset($store) ? $store->country : null); }}</text>
              <option value="{{{ $country_id }}}"{{{ ($country_id === $country)  ? ' selected="selected"' : '' }}}>
                {{{ $country_name }}}
              </option>
              @endif
            @endforeach
          </select>
          {{ $errors->first('country', '<span class="help-inline">:message</span>') }}
        </div>
        <!-- ./country  -->
      </div>
      <div class="row">
        <!-- postal_zip -->
        <div class="col-md-3">
          <input class="form-control" placeholder=" Postal code" type="text" name="postal_zip" id="postal_zip" value="{{{ Input::old('postal_zip', isset($store) ? $store->postal_zip : null) }}}" />
          {{ $errors->first('postal_zip', '<span class="help-inline">:message</span>') }}
        </div>
        <!-- ./postal_zip  -->
      </div>
    </div>
  </div>
  <!-- /address -->

  <!-- phone -->
  <div class="form-group {{{ $errors->has('phone_1') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="phone_1">Phone</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
      <input class="form-control" type="text" name="phone_1" id="phone_1" value="{{{ Input::old('phone_1', isset($store) ? $store->phone_1 : null) }}}" />
      {{ $errors->first('phone_1', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ phone_1 -->

  <!-- fax -->
  <div class="form-group {{{ $errors->has('fax') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="fax">Fax</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
      <input class="form-control" type="text" name="fax" id="fax" value="{{{ Input::old('fax', isset($store) ? $store->fax : null) }}}" />
      {{ $errors->first('fax', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ fax  -->

  <!-- slug -->
  <div class="form-group {{{ $errors->has('slug') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="slug">Url friendly name</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
      <input class="form-control" type="text" name="slug" id="slug" value="{{{ Input::old('slug', isset($store) ? $store->slug : null) }}}" />
      {{ $errors->first('slug', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ slug  -->

  <!-- Website -->
  <div class="form-group {{{ $errors->has('url') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="url">Website</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
      <input class="form-control" type="text" name="url" id="url" value="{{{ Input::old('url', isset($store) ? $store->url : null) }}}" />
      {{ $errors->first('url', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ Url -->


  <!-- Notes -->
  <div class="form-group {{{ $errors->has('notes') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="notes">Notes</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
          <textarea class="form-control full-width" name="notes" value="notes" rows="4">{{ Input::old('notes', isset($store) ? $store->notes : null) }}</textarea>
          {{ $errors->first('notes', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- /Notes -->



  <!-- searchable -->
  <?php $checked = (isset($store) && $store->searchable == 1) ? 'checked' : ""; ?>
  <div class="form-group {{{ $errors->has('manufacturer') ? 'has-error' : '' }}}">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="manufacturer"></label>
    <div class="col-sm-9 col-md-9 col-lg-10">
          <input type="checkbox" name="searchable" {{{ Input::old('searchable', isset($store) ? $checked : NULL ) }}}
                  value="{{{ Input::old('searchable', isset($store) ? $store->searchable : 0 ) }}}" id="searchable">
          <label class="" for="manufacturer">Can this store be searchable?</label>
          {{ $errors->first('searchable', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ content -->

  <!-- Form Actions -->
  <div class="form-actions">
        <button type="submit" class="btn btn-success">Save changes</button>
        <button type="button" class="btn">Cancel</button>
        <button type="reset" class="btn btn-default">Reset</button>
  </div>

</form>
@stop
@section('scripts')
  <script type="text/javascript">
  $(document).ready(function(){
    $('input[type=checkbox],input[type=radio]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
    $("#chains").select2();
    $("#province_state").select2();
    $("#country").select2();

    // Form Validation
    $("#basic_validate").validate({
      rules:{
        title:{
          required:true
        },
        name:{
           required:false,
        },
        line_1:{
           required:true,
        },
        phone_1:{
           required:true,
        },
        city:{
           required:true,
        },
        province_state:{
           required:true,
        },
        country:{
           required:true,
        },
        chain_id:{
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
