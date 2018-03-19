$(document).ready(function() {

  $('#login').submit(function(event) {

    event.preventDefault();

    var nick = $('#nick').val();
    var pass = $('#pass').val();

    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: "usuario=" + nick + "&contrasena=" + pass,
      success: function(response)
      {
        location.href = response;
      }
    });

  });

});
