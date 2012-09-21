jQuery(function($) {
  setTimeout(function() {
    max = 0;
    $(".copy").each(function() {
      if ($(this).height() > max) {
        max = $(this).height();
      }
    });

    $(".copy").each(function() {
      $(this).height(max);
    });
  }, 150);
});
