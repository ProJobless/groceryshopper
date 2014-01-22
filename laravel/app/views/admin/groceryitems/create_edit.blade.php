@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
	 <a href="{{{ URL::to('admin/groceryitems') }}}" title="Manage grocery items" class="tip-bottom"><i class="fa fa-user"></i>Grocery items</a>
	 <a href="{{{ URL::to('admin/groceryitems/' . (isset($groceryitem) ? $groceryitem->id.'/edit' : 'create') ) }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-edit"></i>{{{ $title }}}</a>

@stop
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop

{{-- Content --}}
@section('formcontent')
	<!-- Tabs -->
	{{-- Create User Form --}}
  <form class="form-horizontal" name="basic_validate" id="basic_validate" method="post" 
        action="@if (isset($groceryitem)){{ URL::to('admin/groceryitems/' . $groceryitem->id . '/edit') }}@endif" autocomplete="off" novalidate="novalidate">
			<!-- CSRF Token -->
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <!-- ./ csrf token -->

			<!-- product_name -->
			<div class="form-group {{{ $errors->has('product_name') ? 'has-error' : '' }}}">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="product_name">Name</label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<input class="form-control input-sm" type="text" name="product_name" id="product_name" value="{{{ Input::old('product_name', isset($groceryitem) ? $groceryitem->product_name : null) }}}" />
					{{{ $errors->first('product_name', '<span class="help-block text-left">:message</span>') }}}
				</div>
			</div>
      <!-- ./ product_name -->

			<!-- brand -->
			<div class="form-group {{{ $errors->has('brand') ? 'has-error' : '' }}}">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="product_name">Brand</label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<input class="form-control" type="text" name="brand" id="brand" value="{{{ Input::old('brand', isset($groceryitem) ? $groceryitem->brand : null) }}}" />
					{{{ $errors->first('brand', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
      <!-- ./ brand -->

			<!-- category -->
			<div class="form-group {{{ $errors->has('category') ? 'has-error' : '' }}}">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="product_name">Categories</label>
        <div class="col-sm-9 col-md-9 col-lg-10">
            <select multiple>
              <option>First option</option>
              <option selected>Second option</option>
              <option>Third option</option>
              <option>Fourth option</option>
              <option>Fifth option</option>
              <option>Sixth option</option>
              <option>Seventh option</option>
              <option>Eighth option</option>
            </select>
					<span class="help-block">
						Select categories which this item belong to.
					</span>
					{{{ $errors->first('category', '<span class="help-inline">:message</span>') }}}
        </div>
			</div>
      <!-- ./ category -->
      
			<!-- ./ unit_id -->
              <div class="form-group">
                <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">Unit Size</label>
                <div class="col-sm-9 col-md-9 col-lg-10">
                  <div class="row">
			              <!-- size -->
                    <div class="col-md-3">
                      <div class="input-icon icon-sm">
                        <i class="fa fa-tint"></i>
					              <input class="form-control input-sm" type="text" name="size" id="size" value="{{{ Input::old('size', isset($groceryitem) ? $groceryitem->size : null) }}}" />
                  			{{{ $errors->first('size', '<span class="help-inline">:message</span>') }}}
                      </div>
                    </div>
			              <!-- ./ size -->
                     <!-- unit_id -->
										<div class="col-md-3">
											<select id="unit_id" name="unit_id">
												<option>First option</option>
												<option>Second option</option>
												<option>Third option</option>
												<option>Fourth option</option>
												<option>Fifth option</option>
												<option>Sixth option</option>
												<option>Seventh option</option>
												<option>Eighth option</option>
											</select>
                  			{{{ $errors->first('size', '<span class="help-inline">:message</span>') }}}
										</div>
			              <!-- ./ unit_id -->
                  </div>
                </div>
              </div>
			<!-- upc code -->
			<div class="form-group {{{ $errors->has('upc') ? 'has-error' : '' }}}">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="upc">UPC code</label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<input class="form-control" type="text" name="upc" id="upc" value="{{{ Input::old('upc', isset($groceryitem) ? $groceryitem->upc : null) }}}" />
					{{{ $errors->first('upc', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ upc -->

			<!-- manufacturer -->
			<div class="form-group {{{ $errors->has('manufacturer') ? 'has-error' : '' }}}">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="manufacturer">Manufacturer</label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<input class="form-control" type="text" name="manufacturer" id="manufacturer" value="{{{ Input::old('manufacturer', isset($groceryitem) ? $groceryitem->manufacturer : null) }}}" />
					{{{ $errors->first('manufacturer', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ manufacturer -->

			<!-- Image URL -->
			<div class="form-group {{{ $errors->has('image_url') ? 'has-error' : '' }}}">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="image_url">Image</label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<input type="file" name="image_url" id="image_url" value="{{{ Input::old('image_url', isset($groceryitem) ? $groceryitem->image_url : null) }}}" />
					{{{ $errors->first('image_url', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ image_url -->

			<!-- List of stores -->
              <div class="form-group">
                <label for="" class="col-sm-3 col-md-3 col-lg-2 control-label">Store</label>
                <div class="col-sm-9 col-md-9 col-lg-10">
                  <div class="row">
			              <!-- size -->
                    <div class="col-md-3">
                      <div class="input-icon icon-sm">
                        <i class="fa fa-tint"></i>
					              <input class="form-control input-sm" type="text" name="size" id="size" value="{{{ Input::old('size', isset($groceryitem) ? $groceryitem->size : null) }}}" />
                  			{{{ $errors->first('size', '<span class="help-inline">:message</span>') }}}
                      </div>
                    </div>
			              <!-- ./ size -->
                     <!-- unit_id -->
										<div class="col-md-3">
											<select id="unit_id" name="unit_id">
												<option>First option</option>
												<option>Second option</option>
												<option>Third option</option>
												<option>Fourth option</option>
												<option>Fifth option</option>
												<option>Sixth option</option>
												<option>Seventh option</option>
												<option>Eighth option</option>
											</select>
                  			{{{ $errors->first('size', '<span class="help-inline">:message</span>') }}}
										</div>
			              <!-- ./ unit_id -->
                  </div>
                  <button class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Add another store and price</button>
                </div>
              </div>
      <!-- ./ stores -->


		<!-- Form Actions -->
			<div class="form-actions">
				    <button type="submit" class="btn btn-primary">Save changes</button>
				    <button type="button" class="btn">Cancel</button>
				    <button type="reset" class="btn btn-default">Reset</button>
			</div>
	</form>
    <!-- ./ form actions -->
@stop
@section('scripts')
	<script type="text/javascript">
  $(document).ready(function(){
    $('input[type=checkbox],input[type=radio]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
	  $('select').select2();
	  // Form Validation
    $("#basic_validate").validate({
      rules:{
        product_name:{
          required:true
        },
        brand:{
          required:true,
        },
        unit_id:{
          required:true,
        },
        size:{
          required:true,
				  number:true,
          date: true,
				  min:1
        },
        url:{
          required:true,
          url: true
        }
      },
      errorClass: "help-inline has-error",
      errorElement: "span",
      highlight:function(element, errorClass, validClass) {
        $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
      }
	  });
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.form-group').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.form-group').removeClass('has-error');
			$(element).parents('.form-group').addClass('has-success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			pwd2:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.form-group').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.form-group').removeClass('has-error');
			$(element).parents('.form-group').addClass('has-success');
		}
  });
  function addRow() {
        //$(template(i++)).appendTo("#orderitems tbody");
  }
  var i = 1;
  // start with one row
  addRow();
  // add more rows on click
  $("#add").click(addRow);

  // only for demo purposes
  // $.validator.setDefaults({
  //  submitHandler: function() {
  //      alert("submitted!");
  //        }
  //        });
  //        $.validator.messages.max = jQuery.validator.format("Your totals mustn't exceed {0}!");
  //
  //        $.validator.addMethod("quantity", function(value, element) {
  //          return !this.optional(element) && !this.optional($(element).parent().prev().children("select")[0]);
  //          }, "Please select both the item and its amount.");
  //
  //          $().ready(function() {
  //            $("#orderform").validate({
  //                errorPlacement: function(error, element) {
  //                      error.appendTo( element.parent().next() );
  //                          },
  //                              highlight: function(element, errorClass) {
  //                                    $(element).addClass(errorClass).parent().prev().children("select").addClass(errorClass);
  //                                        }
  //                                          });
  //
  //                                            var template = jQuery.validator.format($.trim($("#template").val()));
  //
  //                                                      var i = 1;
  //                                                        // start with one row
  //                                                          addRow();
  //                                                            // add more rows on click
  //                                                              $("#add").click(addRow);
  //
  //                                                                // check keyup on quantity inputs to update totals field
  //                                                                  $("#orderform").validateDelegate("input.quantity", "keyup", function(event) {
  //                                                                      var totals = 0;
  //                                                                          $("#orderitems input.quantity").each(function() {
  //                                                                                totals += +this.value;
  //                                                                                    });
  //                                                                                        $("#totals").attr("value", totals).valid();
  //                                                                                          });
  //
  //                                                                                          });
  //                                                                                          





});
</script>
@stop
