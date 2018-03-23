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
  var q= $("#q").val();
  if (confirm("Realmente deseas eliminar el cliente"))
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
