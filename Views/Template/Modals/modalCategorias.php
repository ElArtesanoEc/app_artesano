<!-- Modal -->
<div class="modal fade" id="modalFormCategorias" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formCategorias" name="formCategorias" class="form-horizontal">
            
                      <input type="hidden" id="idCategoria" name="idCategoria" value="">
                      <input type="hidden" id="foto_actual" name="foto_actual" value="">
                      <input type="hidden" id="foto_remove" name="foto_remove" value="0">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

              <div class="row">
                <div class="col-md-6">


                    <div class="form-group">
                      <label class="control-label" >Nombre <span class="required">*</span> </label>
                      <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre de la categoria" required="">
                    </div>
                    <div class="form-group">
                      <label for="txtDescripcion">Descripción <span class="required">*</span></label>
                      <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripcion de la categoria" required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelect1">Estado <span class="required">*</span></label>
                      <select name="listStatus" id="listStatus" class="form-control" required="">
                        <option value="1" >Activo</option>
                        <option value="2" >Inactivo</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="photo">
                    <label for="foto">Inserte su foto aqui</label>
                    <div class="prevPhoto">
                      <span class="delPhoto notBlock">X</span>
                      <label for="foto"></label>
                      <div>
                        <img id="img" src="<?= media(); ?>/images/uploads/portada_categoria.jpg">
                      </div>
                    </div>
                    <div class="upimg">
                      <input type="file" name="foto" id="foto">
                    </div>
                    <div id="form_alert"></div>
                  </div>                    
                </div>
            </div> 
             
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewCategoria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>ID:</td>
              <td id="celId"></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado"></td>
            </tr>
            <tr>
              <td>Foto:</td>
              <td id="imgCategoria"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

