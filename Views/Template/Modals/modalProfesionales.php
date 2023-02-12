<!-- Modal -->
<div class="modal fade" id="modalFormProfesionales" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Profesional</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
          <div class="modal-body">
            <div class="container">
              <div class="form-outer">
                  <form id="formProfesional" name="formProfesional" class="form-horizontal">
                    <div class="page slide-page">
                      <input type="hidden" id="idProfesional" name="idProfesional" value="">
                      <h5 class="modal-title" id="titleModal">Información Personal</h5>
                          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
                      <!--<div class="field">  -->                                          
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <label for="txtIdentificacion">Identificación <span class="required">*</span></label>
                                  <input type="text" class="form-control " id="txtIdentificacion" name="txtIdentificacion" >
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="txtEmail">Email <span class="required">*</span></label>
                                  <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" >
                              </div>                  
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="txtPassword">Password </label>
                                <input type="password" class="form-control" id="txtPassword" name="txtPassword" >
                            </div> 
                                               
                          </div>
                          
                      <!--</div>-->
                      <!--<div class="field">-->
                        <div class="form-row">

                              <div class="form-group col-md-6">
                                  <label for="txtNombre">Nombre <span class="required">*</span></label>
                                  <input type="text" class="form-control valid validText " id="txtNombre" name="txtNombre" >
                             </div>
                              <div class="form-group col-md-6">
                                              <label for="txtApellido">Apellido <span class="required">*</span></label>
                                              <input type="text" class="form-control valid validText " id="txtApellido" name="txtApellido" >
                              </div>
                          </div>
                      <!--</div>-->
                      <!--<div class="field">-->
                        <div class="form-row">

                              <div class="form-group col-md-6">
                                <label for="listProfid">Seleciona tu profesion <span class="required">*</span></label>
                                <select class="form-control" data-live-search="true" id="listProfid" name="listProfid" >
                                  <option value="1" >Activo</option>
                                  <option value="2" >Inactivo</option>
                                </select>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="listGremid">Selecciona el gremio al que perteneces <span class="required">*</span></label>
                                <select class="form-control" data-live-search="true" id="listGremid" name="listGremid" >
                                  <option value="1" >Activo</option>
                                  <option value="2" >Inactivo</option>
                                </select>
                              </div>
                        </div>
                      <!--</div>-->

                      <!--<div class="field">-->
                        <div class="form-row">

                           <div class="form-group col-md-6">
                              <label for="txtDireccion">Direccion <span class="required">*</span></label>
                              <input type="text" class="form-control valid validText" id="txtDireccion" name="txtDireccion" >
                          </div>
                          <div class="form-group col-md-6">
                            <label for="txtTelefono">Teléfono <span class="required">*</span></label>
                            <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono"  onkeypress="return controlTag(event);">
                          </div>                
                        </div>
                      <!--</div>-->
                      <div class="field btns">
                        <button class="firstNext next">Siguiente</button>
                      </div>

                    </div>                     
                      <div class="page"> 
                          <h5 class="modal-title" id="titleModal">Información Académica</h5>
                            <!--<div class="field">-->
                              <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="listIntruccionid">Selecciona tu nivel de instrución (primaria, secundaria?) <span class="required">*</span></label>
                                    <select class="form-control" data-live-search="true" id="listIntruccionid" name="listIntruccionid" >
                                      <option value="1">Primaria</option>
                                      <option value="2">Secundaria</option>
                                      <option value="3">Universitaria</option>  
                                    </select>
                                  </div>
                                    <div class="form-group col-md-6">
                                        <label for="DateInstrucion">Fecha: mes/año <span class="required">*</span></label>
                                        <input class="form-control" id="txtDateInstrucion" name="txtDateInstrucion" type="text">
                                    </div>
                                            
                              </div>
                            <!--</div>-->                

                          <!--<div class="field">-->
                            <div class="form-row">
                                  <div class="form-group col-md-6">
                                      <label for="txtNombreInstitucion">Nombre de la institución <span class="required">*</span></label>
                                      <input type="text" class="form-control " id="txtNombreInstitucion" name="txtNombreInstitucion" >
                                  </div>                   
                            </div>
                            <div class="form-row">
                                  <div class="form-group col-md-6">
                                      <label for="txtTitulo">Titulo / Certificado adquirido <span class="required">*</span></label>
                                      <input type="text" class="form-control " id="txtTitulo" name="txtTitulo" >
                                  </div>          
                            </div>
                            <div class="form-row">
                                  <div class="form-group col-md-6">
                                      <label for="txtOtrasAct">Otras Habilidades </label>
                                      <textarea class="form-control" id="txtOtrasAct" name="txtOtrasAct" rows="3" placeholder="ingrese una descripcion de otras habilidades"></textarea>              
                                  </div>                    
                            </div>
                          <!--</div>-->

                          <div class="field btns">
                            <button class="prev-1 prev">Atrás</button>
                            <button class="next-1 next">Siguiente</button>
                          </div>
                     </div>

                    <div class="page">
                          <h5 class="modal-title" id="titleModal">Experiencia Profesional</h5>
                          <!--<div class="field">-->
                            <div class="form-row">
                                  <div class="form-group col-md-6">
                                      <label for="txtCargo">Cargo<span class="required">*</span></label>
                                      <input type="text" class="form-control " id="txtCargo" name="txtCargo" >
                                  </div>
                                  <div class="form-group col-md-6">
                                      <label for="txtEmpresa">Empresa<span class="required">*</span></label>
                                      <input type="text" class="form-control " id="txtEmpresa" name="txtEmpresa" >
                                  </div>                    
                              </div>
                            <div class="form-row">
                                  <div class="form-group col-md-6">
                                      <label for="Datecargoini">Fecha: mes/año <span class="required">*</span></label>
                                      <input class="form-control" id="txtDatecargoini" name="txtDatecargoini"type="text" placeholder="Selecciona Fecha inicio">
                                  </div>  
                                  <div class="form-group col-md-6">
                                      <label for="Datecargofin">Fecha: mes/año <span class="required">*</span></label>
                                      <input class="form-control" id="txtDatecargofin" name="txtDatecargofin" type="text" placeholder="Selecciona Fecha finalización">
                                  </div>
                            </div>
                            <div class="form-row">
                                  <div class="form-group col-md-6">
                                      <label for="txtDescripcionAct">Descripción de Actividades </label>
                                      <textarea class="form-control" id="txtDescripcionAct" name="txtDescripcionAct" rows="3"></textarea>
                                  </div>  
                            </div>
                          <!--</div>-->
                          <!--<div class="field">-->
                            <div class="form-row">
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
                                        <input type="file" class="form-control" id="fotos[]" name="fotos[]" multiple="">
                                      </div>
                                      <div id="form_alert"></div>
                                    </div>                                      
                                  </div>                         
                            </div>

                          <!--</div>-->
                          <div class="field btns">
                            <button class="prev-2 prev">Atrás</button>
                            <button class="next-2 next">Siguiente</button>
                          </div> 
                    </div>
                    <div class="page">
                          <h5 class="modal-title" id="titleModal">Referencias</h5>
                          <!--<div class="field">-->
                            <div class="form-row">
                                  <div class="form-group col-md-6">
                                      <label for="txtNombreRef">Nombre de la referencia <span class="required">*</span></label>
                                      <input type="text" class="form-control " id="txtNombreRef" name="txtNombreRef" >
                                  </div>  
                                  <div class="form-group col-md-6">
                                      <label for="txtApellidoRef">Apellido de la referencia <span class="required">*</span></label>
                                      <input type="text" class="form-control " id="txtApellidoRef" name="txtApellidoRef" >
                                  </div> 
                            </div>
                            <div class="form-row">
                                  <div class="form-group col-md-6">
                                      <label for="txtTelefonoRef">Teléfono <span class="required">*</span></label>
                                      <input type="text" class="form-control valid validNumber" id="txtTelefonoRef" name="txtTelefonoRef"  onkeypress="return controlTag(event);">
                                  </div>  
                                  <div class="form-group col-md-6">
                                      <label for="txtApellidoRef">Correo <span class="required">*</span></label>
                                      <input type="email" class="form-control valid validEmail" id="txtEmailRef" name="txtEmailRef" >
                                  </div> 
                            </div>
                          <!--</div>-->
                          <div class="field btns">
                                <button class="prev-3 prev">Atrás </button>
                                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                          </div>
                            </div>                                                                              
                          </div>

                    </div>

                  </form>
                   <div class="tile-footer">
                      <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle" aria-hidden="true"></i>Cerrar</button>
                    </div> 
                
              </div>              
            </div>
          </div>
    </div>

  </div>
</div>
