<?php

include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');
include ('../../recursos/controllers/categorias/categorias_controllers.php');?>
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Listado de Categorias</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

            <div class="row">
              <div class="col-md-6">
                <div class="card card-outline card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Categorias Agregadas</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="callpse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped"></table>
                      <thead>
                        <tr>
                          <th><center>Nro</center></th>
                          <th><center>Nombre</center></th>
                          <th><center>Acciones</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $contador = 0;
                        foreach($categorias_datos as $categorias_datos){
                          $id_categoria = $categorias_datos['id_categoria'];?>
                          <tr>
                            <td><center><?php echo $contador = $contador + 1;?></center></td>
                            <td>
                              <center>
                                <div class="btn-gruop">
                                  <a href=""></a>1
                                </div>
                              </center>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                  </div>
                </div>
              </div>
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

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                  Launch Default Modal
                </button>
