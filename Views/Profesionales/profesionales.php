<?php 
    headerAdmin($data); 
    getModal('modalProfesionales',$data);?>
    <main class="app-content">
<?php       
    getModal('modalProfesionales',$data);
    if(empty($_SESSION['permisosMod']['r'])){
?>
    <p>No tiene Permisos -- Acceso Restringido</p>
      <?php 
      }else{
      ?>
      <div class="app-title">
        <div>
            <h1><i class="fas fa fa-briefcase"></i><?= $data['page_title']  ?>
            <?php if($_SESSION['permisosMod']['w']){?>
                <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
              <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/profesionales"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

    <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered"  id="tableprofesionales">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Cédula</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>telefono</th>
                          <th>Email</th>
                          <th>Profesion</th>
                          <th>Gremio</th>
                          <th>Status</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
      </div>
  <?php } ?>
  </main>
<?php footerAdmin($data); ?>
    