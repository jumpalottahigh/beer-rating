$(document).ready(function() {
  //Vote control handlers
  $('.vote-control').on('click', function () {
    var data = {};

    if ($(this).hasClass('vote-up')) {
      data['value'] = 1;
    } else {
      data['value'] = -1;
    }

    data['beerId'] = $(this).closest('.card').data('beer-id');

    // console.log($(this).closest('.card').data('beer-id'));

    $.ajax({
     data: data,
     type: 'POST',
     url: 'vote.php',
     success: function(varX){
       console.log('DATA: ' + varX);
        // $('#testDiv').html(varX);
      }
    });
    return false;

  });

});
