$(document).ready(function() {

  $( "#perfil" ).submit(function( event ) {

    var parametros = "nombre_empresa=" + $('#nombre_empresa').val() +
    "&telefono=" + $('#telefono').val() +
    "&email=" + $('#email').val() +
    "&impuesto=" + $('#impuesto').val() +
    "&moneda=" + $('#moneda').val() +
    "&direccion=" + $('#direccion').val() +
    "&ciudad=" + $('#ciudad').val() +
    "&estado=" + $('#estado').val() +
    "&codigo_postal=" + $('#codigo_postal').val();

  	 $.ajax({
       url: $(this).attr('action'),
  			type: "POST",
  			data: parametros,
  			 beforeSend: function(objeto){
  				$("#resultados_ajax").html("Mensaje: Cargando...");
  			  },
  			success: function(datos){
  			$("#resultados_ajax").html(datos);
  		  }
  	});
    event.preventDefault();
  });

  $('#imagefile').change(function(event) {

    event.preventDefault();

    var formData = new FormData($('#changeimg')[0]);

    $.ajax({
      url: $('#changeimg').attr('action'),
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response)
      {
        $('#imagen_logo').attr('src', response);
      }
    });

  });

});
