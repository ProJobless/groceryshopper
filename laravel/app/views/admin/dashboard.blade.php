@extends('admin.layouts.default')
@section('content')
    <div class="row">
      <div class="col-xs-12">
        <!-- Notifications -->
        @include('notifications')
        <!-- ./ notifications -->
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="fa fa-signal"></i></span>
            <h5>Site Statistics</h5>
            <div class="buttons">
              <a href="#" class="btn"><i class="fa fa-refresh"></i> <span class="text">Update stats</span></a>
            </div>
          </div>
          <div class="widget-content">
            <div class="row">
            </div>							
          </div>
        </div>					
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="widget-box widget-calendar">
          <div class="widget-title"><span class="icon"><i class="fa fa-calendar"></i></span><h5>Calendar</h5></div>
          <div class="widget-content nopadding">
            <div class="calendar"></div>
          </div>
        </div>
      </div>
    </div>
@stop
