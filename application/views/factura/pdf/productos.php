
<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
    <tr>
        <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
        <th style="width: 60%" class='midnight-blue'>DESCRIPCION</th>
        <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
        <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>

    </tr>

<?php
$nums=1;
$sumador_total=0;
$con=@mysqli_connect('localhost', 'root', '', 'simple_invoice');
$sql=mysqli_query($con, "select * from products, detalle_factura, facturas where products.id_producto=detalle_factura.id_producto and detalle_factura.numero_factura=facturas.numero_factura and facturas.id_factura='".$id_factura."'");

while ($row=mysqli_fetch_array($sql))
{
$id_producto=$row["id_producto"];
$codigo_producto=$row['codigo_producto'];
$cantidad=$row['cantidad'];
$nombre_producto=$row['nombre_producto'];

$precio_venta=$row['precio_venta'];
$precio_venta_f=number_format($precio_venta,2);//Formateo variables
$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
$precio_total=$precio_venta_r*$cantidad;
$precio_total_f=number_format($precio_total,2);//Precio total formateado
$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
$sumador_total+=$precio_total_r;//Sumador
if ($nums%2==0){
$clase="clouds";
} else {
$clase="silver";
}
?>

    <tr>
        <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
        <td class='<?php echo $clase;?>' style="width: 60%; text-align: left"><?php echo $nombre_producto;?></td>
        <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
        <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>

    </tr>

<?php


$nums++;
}
$subtotal=number_format($sumador_total,2,'.','');
$total_iva=($subtotal * $impuesto )/100;
$total_iva=number_format($total_iva,2,'.','');
$total_factura=$subtotal+$total_iva;
?>

    <tr>
        <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL <?php echo $moneda;?> </td>
        <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
    </tr>
<tr>
        <td colspan="3" style="widtd: 85%; text-align: right;">IVA (<?php echo $impuesto;?>)% <?php echo $moneda;?> </td>
        <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
    </tr><tr>
        <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL <?php echo $moneda;?> </td>
        <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
    </tr>
</table>



<br>
<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por su compra!</div>




</page>
