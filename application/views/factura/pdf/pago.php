<td style="width:25%;"><?php echo date("d/m/Y", strtotime($fecha_factura));?></td>
 <td style="width:40%;" >
  <?php
  if ($condiciones==1){echo "Efectivo";}
  elseif ($condiciones==2){echo "Cheque";}
  elseif ($condiciones==3){echo "Transferencia bancaria";}
  elseif ($condiciones==4){echo "Crédito";}
  ?>
 </td>
  </tr>



</table>
<br>
