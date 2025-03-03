<?php

include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');
include('../../recursos/controllers/usuarios/list_user_controller.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Listado de Usuarios</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Usuarios Registrados</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="display: block;">
              <!-- /.card-header -->
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 10px">Nro</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Cargo</th>
                      <th>Tienda</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($usuarios_datos as $usuarios_datos){?>
                      <tr>
                        <td><?php echo $usuarios_datos['id'] ?></td>
                        <td><?php echo $usuarios_datos['nombre'] ?></td>
                        <td><?php echo $usuarios_datos['email'] ?></td>
                        <td><?php echo $usuarios_datos['rol'] ?></td>
                        <td><?php echo $usuarios_datos['tienda'] ?></td>
                        <td><?php echo $usuarios_datos['estado'] ?></td>
                        <td>
                          <center>
                          <a href="ver_usuario.php?id=<?php echo $usuarios_datos['id']; ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                          <a href="editar_usuario.php?id=<?php echo $usuarios_datos['id']; ?>" type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                          </center>
                        </td>
                      </tr>
                    <?php
                    };
                    ?>
                  </tbody>
                </table>
              <!-- /.card-body -->
          </div>
                    
      <!-- /.card-body -->
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

<script>
  $(function () {
    $("#example1").DataTable({
      /* cambio de idiomas de datatable */
      "pageLength": 10,
          language: {
              "emptyTable": "No hay información",
              "decimal": "",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
              "infoEmpty": "Mostrando 0 to 0 of 0 Usuarios",
              "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ ",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "Buscador:",
              "zeroRecords": "Sin resultados encontrados",
              "paginate": {
                  "first": "Primero",
                  "last": "Ultimo",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
             },
      /* fin de idiomas */
      "responsive": true, "lengthChange": true, "autoWidth": false,
      /* Ajuste de botones */
      buttons: [{
                        extend: 'collection',
                        text: 'Reportes',
                        orientation: 'landscape',
                        buttons: [{
                            text: 'Copiar',
                            extend: 'copy'
                        }, {
                            extend: 'pdf',
                        }, {
                            extend: 'csv',
                        }, {
                            extend: 'excel',
                        }, {
                            text: 'Imprimir',
                            extend: 'print'
                        }
                        ]
                    },
                        {
                            extend: 'colvis',
                            text: 'Mostrar'
                        }
                    ],
                    /*Fin de ajuste de botones*/
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>