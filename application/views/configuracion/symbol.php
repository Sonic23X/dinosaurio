                           <select class='form-control input-sm' id="moneda" required>
                            <?php
                              foreach ($sym as $linea ) {
                                foreach ($linea as $clave => $value) {
                                  if($clave == "name")
                                  {
                                    $simbolo=$linea['symbol'];
                                    $moneda=$linea['name'];
                                    if ($info->moneda == $simbolo){
                                      $selected="selected";
                                    } else {
                                      $selected="";
                                    }
                                    ?>
                                    <option value="<?php echo $simbolo;?>" <?php echo $selected;?>><?php echo ($simbolo);?></option>
                                    <?php
                                  }
                                }
                              }
                            ?>
                          </select>
