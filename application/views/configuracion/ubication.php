                      </td>
                    </tr>
                    <tr>
                      <td>Dirección:</td>
                      <td><input type="text" class="form-control input-sm" id="direccion" value="<?= $direccion ?>" required></td>
                    </tr>
                    <tr>
                      <td>Ciudad:</td>
                      <td><input type="text" class="form-control input-sm" id="ciudad" value="<?= $ciudad ?>" required></td>
                    </tr>
                    <tr>
                      <td>Región/Provincia:</td>
                      <td><input type="text" class="form-control input-sm" id="estado" value="<?= $estado ?>"></td>
                    </tr>
                    <tr>
                      <td>Código postal:</td>
                      <td><input type="text" class="form-control input-sm" id="codigo_postal" value="<?= $codigo_postal ?>"></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
                </div>
              </div>
              <div class="panel-footer text-center">
                <button type="submit" class="btn btn-sm btn-success" id="updatesettings"><i class="glyphicon glyphicon-refresh"></i> Actualizar datos</button>
              </div>
            </div>
          </div>
        </form>
      </div>
