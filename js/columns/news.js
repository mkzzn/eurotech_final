jQuery(function($) {
  setTimeout(function() {
    max = 0;
    $(".body").each(function() {
      if ($(this).height() > max) {
        max = $(this).height();
      }
    });

    $(".body").each(function() {
      $(this).height(max);
    });
  }, 150);
});
