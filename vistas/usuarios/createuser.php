<?php

include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Resgistro de un nuevo Usuario</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Completar datos</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="display: block;">
              <div class="row">
                <div class="col-md-12">
                  <form action="../../recursos/controllers/usuarios/create_user_controller.php" method="post">
                    <label for="">Nombres</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Escribir nombre y apellidos..." required>
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Escribir correo electronico..." required>
                    <label for="">Contraseña</label>
                    <input type="password" name="pass" class="form-control" placeholder="Escribir contraseña" required>
                    <label for="">Verificar Contraseña</label>
                    <input type="password" name="repass" class="form-control" placeholder="Escribir contraseña" required>
                    <label for="estado">Estado</label>
                    <select class="form-control" name="estado" name="estado" id="estado" required>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                    <hr>
                    <div class="form-gruop">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                      <a href="" class="btn btn-secondary">Cancelar</a>
                    </div>
                  </form>
                </div>
              </div>
          </div>
        </div>
        <!-- /.card -->
      </div>

      
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include ('../../vistas/layout/parte2.php');
?>
