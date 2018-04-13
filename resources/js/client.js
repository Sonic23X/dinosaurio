$(document).ready(function() {

  $('#guardar_cliente').submit(function(event) {

    event.preventDefault();

    var nombre =$('#nombre').val();
    var telefono =$('#telefono').val();
    var email =$('#email').val();
    var direccion =$('#direccion').val();
    var estado =$('#estado').val();

    $.ajax({
      url: 'http://localhost/dinosaurio/Client/Insert',
      type: 'post',
      data: 'nombre=' + nombre + '&telefono=' + telefono + '&email=' + email + '&direccion=' + direccion + '&estado=' + estado,
      success: function(response)
      {
        if(response == "true")
        {
          alert("registro completado!");
          $('#nuevoCliente').modal('toggle');
          location.reload();
        }
        else
        {
          alert("Error, intente de nuevo mas tarde");
          $('#nuevoCliente').modal('toggle');
        }
      }
    });

  });

  $('#editar_cliente').submit(function(event) {
    event.preventDefault();

    var nombre = $("#mod_nombre").val();
  	var telefono = $("#mod_telefono").val();
  	var email = $("#mod_email").val();
  	var direccion = $("#mod_direccion").val();
  	var estado = $("#mod_estado").val();
  	var id = $("#mod_id").val();

    $.ajax({
      url: 'http://localhost/dinosaurio/Client/Update',
      type: 'post',
      data: 'id=' + id + '&nombre=' + nombre + '&telefono=' + telefono + '&email=' + email + '&direccion=' + direccion + '&estado=' + estado,
      success: function(response)
      {
        if(response =="true")
        {
          alert("Cambios realizados con exito!");
          $('#myModal2').modal('toggle');
          location.reload();
        }
        else
        {
          alert("Error, intente más tarde");
          $('#myModal2').modal('toggle');
        }
      }
    });


  });

});

function eliminar(id)
{
  if (confirm("Realmente deseas eliminar al cliente?"))
  {
		$.ajax({
        type: "POST",
        url: "http://localhost/dinosaurio/Client/Delete",
        data: "id="+id,
        success: function(datos)
        {
          alert("Registro eliminado con exito");
          location.reload();
        }
			});
		}

}

function obtener_datos(id)
{
  var nombre_cliente = $("#nombre_cliente"+id).val();
  var telefono_cliente = $("#telefono_cliente"+id).val();
	var email_cliente = $("#email_cliente"+id).val();
	var direccion_cliente = $("#direccion_cliente"+id).val();
	var status_cliente = $("#status_cliente"+id).val();

	$("#mod_nombre").val(nombre_cliente);
	$("#mod_telefono").val(telefono_cliente);
	$("#mod_email").val(email_cliente);
	$("#mod_direccion").val(direccion_cliente);
	$("#mod_estado").val(status_cliente);
	$("#mod_id").val(id);
}
