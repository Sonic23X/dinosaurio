function obtener_datos(id)
{
    $('#mod_id').val(id);
    $('#firstname2').val($('#nombres' + id).val());
    $('#lastname2').val($('#apellidos' + id).val());
    $('#user_name2').val($('#usuario' + id).val());
    $('#user_email2').val($('#email' + id).val());
}

function get_user_id(id)
{
  $("#user_id_mod").val(id);
}

function eliminar(id)
{
  if (confirm("Realmente deseas eliminar al usuario?"))
  {
		$.ajax({
        type: "POST",
        url: "http://localhost/dinosaurio/User/Delete",
        data: "id="+id,
        beforeSend: function(objeto)
        {
          $("#resultados").html("Mensaje: Cargando...");
		    },
        success: function(datos)
        {
          $("#resultados").html(datos);
        }
			});
		}

}

$(document).ready(function() {

  $('#guardar_datos').click(function(event) {
    event.preventDefault();

    var nombre = $('#firstname').val();
    var apellido = $('#lastname').val();
    var usuario = $('#user_name').val();
    var email = $('#user_email').val();
    var pass = $('#user_password_new').val();
    var r_pass = $('#user_password_repeat').val();

    if(pass == r_pass)
    {
      $.ajax({
        url: 'http://localhost/dinosaurio/User/Insert',
        type: 'post',
        data: "nombre=" + nombre + "&apellido=" + apellido + "&usuario=" + usuario + "&email=" + email + "&pass=" + pass,
        success: function(response)
        {
          if(response == "true")
          {
            alert("Registro completado!");
            $('#myModal').modal('toggle');
            location.reload();
          }
          else
          {
            alert("Error, intentelo mas tarde");
            $('#myModal').modal('toggle');
          }
        }
      });
    }
    else
    {
      alert("Las contraseñas no coinciden, por favor, verifiquelas");
    }
  });

});
