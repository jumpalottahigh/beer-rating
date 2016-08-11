$(document).ready(function() {
  //Init

  // TODO: FACTOR OUT
  //Hide card comments
  // $('.card-comments').hide();
  // Comments click handler
  // $('.btn-card-comments').on('click', function (e) {
  //   e.preventDefault();
  //   // Show the comments
  //   $(this).parents('.card').find('.card-comments').toggle();
  //
  //   //Show comment box and button to comment
  // });

  //Vote control handlers
  $('.vote-control').on('click', function () {
    var currentCount = $(this).siblings('.vote-count').data('count');
    console.log(currentCount);
    if ($(this).hasClass('vote-up')) {
      currentCount++;
      console.log('Up');
    } else {
      currentCount--;
      console.log('Down');
    }

    // Update the data attributes
    $(this).siblings('.vote-count').data('count', currentCount);
    // Update the card
    $(this).siblings('.vote-count').text(currentCount);
  });

});
