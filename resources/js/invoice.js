
function eliminar(id)
{
  if(confirm('¿Realmente desea eliminar esta factura?'))
  {
    $.ajax({
      url: 'http://localhost/dinosaurio/Invoice/Delete',
      type: 'post',
      data: "id=" + id,
      success: function(response)
      {
        alert(response);
        location.reload();
      }
    });

  }
}

function imprimir_factura(id_factura)
{
  var url = 'http://localhost/dinosaurio/Invoice/Imprimir/'+ id_factura;
  VentanaCentrada(url,'Factura','','1024','768','true');
}
