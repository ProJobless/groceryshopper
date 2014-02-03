      <!-- Shopping cart Modal -->
     <div class="modal fade" id="shoppingcart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title">Your shopping list</h4>
           </div>
           <div class="modal-body">
              <div class="simpleCart_items"></div>

              <!-- show the cart -->
              <div class="simpleCart_items"></div>
            <!-- grand total, including tax and shipping (ex. $28.49) -->
            <div class="simpleCart_grandTotal"></div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Continue Shopping</button>
             <button type="button" class="btn btn-info simpleCart_checkout">View items</button>
           </div>
         </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
     </div><!-- /.modal -->


      <!-- Store locator Modal -->
     <div class="modal fade" id="storefinder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title">Locate a store nearby you</h4>
           </div>
           <div class="modal-body">
              {{ Form::open( array( 
                                'url' => '/shoppinglist/findstore',
                                'method' => 'get',
                                'role' => 'search', 
                                'class' => 'form-inline widget-search'
                             )
                  ) 
              }}
              {{ Form::token(); }}
              <input type="hidden" id="mylatitude" name="mylatitude" value="" />
              <input type="hidden" id="mylongitude" name="mylongitude" value="" />

                  <div class="form-group">
                      <div class="input-group custom-search-form">
                        {{ Former::text('')->class('form-control')->placeholder('Enter your address, postal code or city')->require()->name('location') }}
                        
                        <span class="input-group-btn">
                          <button class="btn btn-info" id="locate_store" type="submit"><span class="glyphicon glyphicon-search"></span>  Find store</button>
                        </span>
                      </div><!-- /input-group -->
                  </div>
              {{ Former::close() }} 
              </form>

           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           </div>
         </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
     </div><!-- /.modal -->
