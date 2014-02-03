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
      <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="brand">Brand</label>
      <div class="col-sm-9 col-md-9 col-lg-10">
        <input class="form-control" type="text" name="brand" id="brand" value="{{{ Input::old('brand', isset($groceryitem) ? $groceryitem->brand : null) }}}" />
        {{ $errors->first('brand', '<span class="help-inline">:message</span>') }}
      </div>
    </div>
    <!-- ./ brand -->

    <!-- category -->
    <div class="form-group {{{ $errors->has('category') ? 'has-error' : '' }}}">
      <label class="col-sm-3 col-md-3 col-lg-2 control-label" for="category">Categories</label>
        <div class="col-sm-9 col-md-9 col-lg-10">
              <select multiple id="categories" name="categories[]" class="from-control" >
                @foreach ($categories as $category)
                  @if ($mode == 'create')
                  <option value="{{{ $category->id }}}"{{{ ( in_array($category->id, $selectedCategories) ? ' selected="selected"' : '') }}}>{{{ $category->title }}}</option>
                  @else
                  <option value="{{{ $category->id }}}"{{{ ( array_search($category->id, $groceryitem->currentCategoryIds()) !== false && array_search($category->id, $groceryitem->currentcategoryIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $category->name }}}</option>
                  @endif
                @endforeach
              </select>
              {{ $errors->first('categories', '<span class="help-inline">:message</span>') }}
      </div>
    </div>
      <!-- ./ category -->
      
			<!-- ./ unit_id -->
              <div class="form-group">
                <label for="size" class="col-sm-3 col-md-3 col-lg-2 control-label">Unit Size</label>
                <div class="col-sm-9 col-md-9 col-lg-10">
                  <div class="row">
			              <!-- size -->
                    <div class="col-md-3">
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon">
                        <i class="fa fa-th"></i></span>
					              <input class="form-control input-sm" type="text" placeholder="Enter the quantity" name="size" id="size" value="{{{ Input::old('size', isset($groceryitem) ? $groceryitem->size : null) }}}" />
                      </div>
                    </div>
			              <!-- ./ size -->
                     <!-- unit_id -->
										<div class="col-md-3">
											<select id="unit_id" name="unit_id">
                        @foreach ($units as $unit)
                          @if ($mode == 'create')
                          <option value="{{{ $unit->id }}}"{{{ ( in_array($unit->id, $selectedUnits) ? ' selected="selected"' : '') }}}>{{{ $unit->symbol }}}</option>
                          @else
                          <option value="{{{ $unit->id }}}"{{{ ( array_search($unit->id, $groceryitem->currentunitIds()) !== false && array_search($unit->id, $groceryitem->currentunitIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $unit->name }}}</option>
                          @endif
                        @endforeach
											</select>
										</div>
                  			{{ $errors->first('unit_id', '<span class="help-inline">:message</span>') }}
                  			{{ $errors->first('size', '<span class="help-inline">:message</span>') }}
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
					{{ $errors->first('manufacturer', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- ./ manufacturer -->

			<!-- Image URL -->
			<div class="form-group {{{ $errors->has('image_url') ? 'has-error' : '' }}}">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="image_url">Image</label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<input type="file" name="image_url" id="image_url" value="{{{ Input::old('image_url', isset($groceryitem) ? $groceryitem->image_url : null) }}}" />
					{{ $errors->first('image_url', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- ./ image_url -->

    <!-- List of stores -->
              <div class="form-group clonedInput" id="entry1">
                <label for="store_id" class="label_ttl col-sm-3 col-md-3 col-lg-2 control-label">Store and price</label>
                <div class="col-sm-9 col-md-9 col-lg-10">
                  <div class="row">

                     <!-- store_id -->
                      <div class="col-md-6">
                        <select id="store_id" name="store_id" class="select_ttl form-control">
                        @foreach ($stores as $store)
                          @if ($mode == 'create')
                          <option value="{{{ $store->id }}}"{{{ ( in_array($store->id, $selectedStores) ? ' selected="selected"' : '') }}}>{{{ $store->title }}} - {{{ $store->line_1 }}}</option>
                          @else
                          <option value="{{{ $store->id }}}"{{{ ( array_search($store->id, $groceryitem->currentstoreIds()) !== false && array_search($store->id, $groceryitem->currentstoreIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $store->name }}}</option>
                          @endif
                        @endforeach
                    </select>
                      {{{ $errors->first('size', '<span class="help-inline">:message</span>') }}}
                  </div>
                  <!-- ./ store_id -->

                  <!-- quantity -->
                  <div class="col-md-3">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon">
                      <i class="fa fa-th"></i></span>
                      <input class="form-control input-sm input_quantity" placeholder="Quantity" type="text" name="quantity" id="quantity" value="{{{ Input::old('quantity', isset($quantity) ? $quantity : null) }}}" />
                      {{ $errors->first('quantity', '<span class="help-inline">:message</span>') }}
                    </div>
                  </div>
                  <!-- ./ price -->


                  <!-- price-->
                  <div class="col-md-3">
                    <div class="input-group input-group-sm">
                      <span class="input-group-addon">
                      <i class="fa fa-dollar"></i></span>
                      <input class="form-control input-sm input_price" type="text" placeholder="Price" name="price" id="price" value="{{{ Input::old('price', isset($price) ? $price : null) }}}" />
                      {{ $errors->first('price', '<span class="help-inline">:message</span>') }}
                    </div>
                  </div>
                  <!-- ./ price -->


                  </div>
                </div>
              </div>
              <div class="form-group" id="">
                <label for="buttons" class="label_ttl col-sm-3 col-md-3 col-lg-2 control-label"></label>
                <div class="col-sm-9 col-md-9 col-lg-10">
                  <div class="row">
                    <button type="button" id="btnAdd" name="btnAdd" class="btn btn-default btn-sm"><i class="fa fa-plus"></i>Add another store and price</button>
                    <button type="button" id="btnDel" name="btnDel" class="btn btn-default btn-sm"><i class="fa fa-minus"></i>Remove store and price</button>
                  </div>
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
    $("#categories").select2();
    $("#unit_id").select2();

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
        categories:{
          required:true,
        },
        store_id:{
           required:true,
        },
        manufacturer: {
          required:true,
        },
        size:{
          required:true,
          number:true,
          min:1
        },
        quantity:{
          required:true,
          number:true,
          min:0.1
        },
        ID2_quantity:{
          required:false,
          number:true,
          min:0.1
        },
        ID3_quantity:{
          required:false,
          number:true,
          min:0.1
        },
        ID4_quantity:{
          required:false,
          number:true,
          min:0.1
        },
        ID5_quantity:{
          required:false,
          number:true,
          min:0.1
        },
        ID6_quantity:{
          required:false,
          number:true,
          min:0.1
        },
        price:{
          required:true,
          number:true,
          min:0.1
        },
        ID2_price:{
          required:false,
          number:true,
          min:0.1
        },
        ID3_price:{
          required:false,
          number:true,
          min:0.1
        },
        ID4_price:{
          required:false,
          number:true,
          min:0.1
        },
        url:{
          required:true,
          url: true
        }
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


$(function () {
    $('#btnAdd').click(function () {
        var num     = $('.clonedInput').length, // Checks to see how many "duplicatable" input fields we currently have
        newNum  = new Number(num + 1),      // The numeric ID of the new input field being added, increasing by 1 each time
        newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
    /*  This is where we manipulate the name/id values of the input inside the new, cloned element
        Below are examples of what forms elements you can clone, but not the only ones.
        There are 2 basic structures below: one for an H2, and one for form elements.
        To make more, you can copy the one for form elements and simply update the classes for its label and input.
        Keep in mind that the .val() method is what clears the element when it gets cloned. Radio and checkboxes need .val([]) instead of .val('').
    */
        // H2 - section
        //newElem.find('.heading-reference').attr('id', 'ID' + newNum + '_reference').attr('name', 'ID' + newNum + '_reference').html('Entry #' + newNum);

        // Store - select
        newElem.find('.label_ttl').attr('for', 'ID' + newNum + '_store_id');
        newElem.find('.select_ttl').attr('id', 'ID' + newNum + '_store_id').attr('name', 'ID' + newNum + '_store_id').val('');

        // Price - text
        newElem.find('.label_quantity').attr('for', 'ID' + newNum + '_quantity');
        newElem.find('.input_quantity').attr('id', 'ID' + newNum + '_quantity').attr('name', 'ID' + newNum + '_quantity').val('');


        // Price - text
        newElem.find('.label_price').attr('for', 'ID' + newNum + '_price');
        newElem.find('.input_price').attr('id', 'ID' + newNum + '_price').attr('name', 'ID' + newNum + '_price').val('');


    // Insert the new element after the last "duplicatable" input field
        $('#entry' + num).after(newElem);
        $('#ID' + newNum + '_title').focus();

    // Enable the "remove" button. This only shows once you have a duplicated section.
        $('#btnDel').attr('disabled', false);

    // Right now you can only add 4 sections, for a total of 5. Change '5' below to the max number of sections you want to allow.
        if (newNum == 6)
        $('#btnAdd').attr('disabled', true).prop('value', "You've reached the limit"); // value here updates the text in the 'add' button when the limit is reached 
    });
    var num  = $('.clonedInput').length; // Checks to see how many "duplicatable" input fields we currently have
    console.log(num);
    //$('#ID' + newNum + '_store_id').select2();

    $('#btnDel').click(function () {
    // Confirmation dialog box. Works on all desktop browsers and iPhone.
        if (confirm("Are you sure you wish to remove this store and price? This cannot be undone."))
            {
                var num = $('.clonedInput').length;
                // how many "duplicatable" input fields we currently have
                $('#entry' + num).slideUp('fast', function () {$(this).remove();
                // if only one element remains, disable the "remove" button
                    if (num -1 === 1)
                $('#btnDel').attr('disabled', true);
                // enable the "add" button
                $('#btnAdd').attr('disabled', false).prop('value', "add store and price");});
            }
        return false; // Removes the last section you added
    });

    // Enable the "add" button
    $('#btnAdd').attr('disabled', false);
    // Disable the "remove" button
    $('#btnDel').attr('disabled', true);

});




</script>

@stop
