@extends('site.user.default')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.settings') }}} ::
@parent
@stop

@section('user-account-title')
		My Account <small></small></h2>
@parent
@stop

{{-- Content --}}
@section('user-content')
                  <h3><i class="icon-user color"></i> &nbsp;My Account</h3>
                  <!-- Your details -->
                   <div class="address">
                     <address>
                       <!-- Your name -->
                       <strong>{{{ $user->username}}} </strong><br>

                       <!-- Phone number -->
                       <abbr title="Id">ID:</abbr> {{{ $user->username}}}<br />
                       <abbr title="Joined">Joined:</abbr> {{{ $user->joined() }}}.<br />
                       <a href="mailto:{{{ $user->email }}}">{{{ $user->email }}}</a>
                     </address>
                   </div>
                   <hr />
                   
                   <h4>My Recent Purchases</h4>

                     <table class="table table-striped tcart">
                       <thead>
                         <tr>
                           <th>Date</th>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Price</th>
                           <th>Status</th>
                         </tr>
                       </thead>
                       <tbody>
                         <tr>
                           <td>25-08-12</td>
                           <td>4423</td>
                           <td>HTC One</td>
                           <td>$530</td>
                           <td>Completed</td>
                         </tr>
                         <tr>
                           <td>15-02-12</td>
                           <td>6643</td>
                           <td>Sony Xperia</td>
                           <td>$330</td>
                           <td>Shipped</td>
                         </tr>
                         <tr>
                           <td>14-08-12</td>
                           <td>1283</td>
                           <td>Nokia Asha</td>
                           <td>$230</td>
                           <td>Processing</td>
                         </tr>                                               
                       </tbody>
                     </table>
     
@stop
