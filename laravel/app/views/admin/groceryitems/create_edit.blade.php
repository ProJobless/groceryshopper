@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
<!-- Tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab">Data</a></li>
    </ul>
<!-- ./ tabs -->

{{-- Edit Grocery Item Form --}}
<form class="form-horizontal" method="post" action="@if (isset($groceryitem)){{ URL::to('admin/groceryitems/' . $groceryitem->id . '/edit') }}@endif" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <!-- ./ csrf token -->

    <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
            <!-- Store Title -->
            <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="title">Store Title</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($groceryitem) ? $groceryitem->title : null) }}}" />
                    {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <!-- ./ store title -->



            <!-- Address -->
            <div class="form-group {{{ $errors->has('line_1') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="line_1">Street</label>
                    <input class="form-control" type="text" name="line_1" id="line_1" value="{{{ Input::old('line_1', isset($groceryitem) ? $groceryitem->line_1 : null) }}}" />
                    {{ $errors->first('line_1', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
                <!-- ./ store title -->
            <div class="controls controls-row">
                <div class="form-group row {{{ $errors->has('city') ? 'error' : '' }}}">
                    <div class="col-lg-4">
                        <label class="control-label" for="store">City</label>
                        <input class="form-control" type="text" name="city" id="city" value="{{{ Input::old('city', isset($groceryitem) ? $groceryitem->city : null) }}}" />
                        {{ $errors->first('city', '<span class="help-inline">:message</span>') }}
                    </div>
                    <div class="col-lg-3">
                        <label class="control-label" for="province_state">Province</label>
                        {{ Form::select('province_state',
                                                 array('QC' => 'Quebec', 'ON' => 'Ontario'),
                                                 Input::old('province_state', isset($groceryitem) ? $groceryitem->province_state : null),
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
                                                 Input::old('country', isset($groceryitem) ? $groceryitem->country : null),
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
                        <input class="form-control" type="text" name="postal_zip" id="postal_zip" value="{{{ Input::old('postal_zip', isset($groceryitem) ? $groceryitem->postal_zip : null) }}}" />
                        {{ $errors->first('postal_zip', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>
                <div class="form-group {{{ $errors->has('line_1') ? 'error' : '' }}}">
                </div>
            </div>
            <!-- Phone -->
            <div class="form-group {{{ $errors->has('phone_1') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="phone_1">Phone number</label>
                    <input class="form-control" type="text" name="phone_1" id="phone_1" value="{{{ Input::old('phone_1', isset($groceryitem) ? $groceryitem->phone_1 : null) }}}" />
                    {{ $errors->first('phone_1', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <!-- ./ store phone -->
            <div class="form-group {{{ $errors->has('fax') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="fax">Fax</label>
                    <input class="form-control" type="text" name="fax" id="fax" value="{{{ Input::old('line_1', isset($groceryitem) ? $groceryitem->fax : null) }}}" />
                    {{ $errors->first('fax', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <!-- URL friendly slug -->
            <div class="form-group {{{ $errors->has('slug') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="slug">URL friendly name</label>
                    <input class="form-control" type="text" name="slug" id="slug" value="{{{ Input::old('slug', isset($groceryitem) ? $groceryitem->slug : null) }}}" />
                    {{ $errors->first('slug', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <!-- ./ slug -->

            <!-- Website -->
            <div class="form-group {{{ $errors->has('url') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="url">Website </label>
                    <input class="form-control" type="text" name="url" id="url" value="{{{ Input::old('url', isset($groceryitem) ? $groceryitem->url : null) }}}" />
                    {{ $errors->first('url', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <!-- ./ Url -->


            <!-- Notes -->
            <div class="form-group {{{ $errors->has('notes') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="content">Notes</label>
                    <textarea class="form-control full-width" name="notes" value="notes" rows="4">{{ Input::old('notes', isset($groceryitem) ? $groceryitem->notes : null) }}</textarea>
                    {{ $errors->first('notes', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <!-- searchable -->
            <?php $checked = (isset($groceryitem) && $groceryitem->searchable == 1) ? 'checked' : ""; ?>
            <div class="form-group {{{ $errors->has('searchable') ? 'error' : '' }}}">
                <div class="col-md-12">
                    <label class="control-label" for="content">Can this store be searched?
                            <input type="checkbox" name="searchable" {{{ Input::old('searchable', isset($groceryitem) ? $checked : NULL ) }}}
                                    value="{{{ Input::old('searchable', isset($groceryitem) ? $groceryitem->searchable : 0 ) }}}" id="searchable">
                    </label>
                    {{ $errors->first('searchable', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <!-- ./ content -->
        </div>
        <!-- ./ general tab -->
    </div>
    <!-- ./ tabs content -->

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
