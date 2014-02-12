    function addRow() {
          $(template(i++)).appendTo("#orderitems tbody");
    }
    var i = 1;
    // start with one row
    addRow();
    // add more rows on click
    $("#add").click(addRow);

    // only for demo purposes
    $.validator.setDefaults({
      submitHandler: function() {
           alert("submitted!");
      }
    });
  $.validator.messages.max = jQuery.validator.format("Your totals mustn't exceed {0}!");
  //
  $.validator.addMethod("quantity", function(value, element) {
       return !this.optional(element) && !this.optional($(element).parent().prev().children("select")[0]);
  }, "Please select both the item and its amount.");

  $().ready(function() {
      $("#orderform").validate({
          errorPlacement: function(error, element) {
            error.appendTo( element.parent().next() );
          },
          highlight: function(element, errorClass) {
            $(element).addClass(errorClass).parent().prev().children("select").addClass(errorClass);
          }
      });
     var template = jQuery.validator.format($.trim($("#template").val()));
     var i = 1;
     // start with one row
     addRow();
    // add more rows on click
    $("#add").click(addRow);
    // check keyup on quantity inputs to update totals field
    $("#orderform").validateDelegate("input.quantity", "keyup", function(event) {
        var totals = 0;
        $("#orderitems input.quantity").each(function() {
             totals += +this.value;
        });
        $("#totals").attr("value", totals).valid();
    });
  });
