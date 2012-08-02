jQuery(function($) {
  $(".delete_confirm").click(function(event) {
    var confirmation = confirm("Are you sure you want to delete this record?");
    if (!confirmation) {
      event.preventDefault();
      event.stopPropagation();
    }
  });
});
