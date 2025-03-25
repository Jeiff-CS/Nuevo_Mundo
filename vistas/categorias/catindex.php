<?php

include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');
include ('../../recursos/controllers/categorias/list_categoria_controllers.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">  
          <div class="col-sm-12">
            <h1 class="m-0">Listado de Categorías
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create">
                <i class="fa fa-plus"></i> Nuevo
              </button>
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      <div class="row">
        <div class="col-md-9">
          <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Categorías Registradas</h3>

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
                      <th>Descripcion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($categorias_datos as $categoria){?>
                      <tr>
                        <td><?php echo $categoria['id'] ?></td>
                        <td><?php echo $categoria['nombre'] ?></td>
                        <td><?php echo $categoria['descripcion'] ?></td>
                        <td>
                          <center>
                            <button type="button" class="btn bg-success btn-sm btn-edit" 
                              data-id="<?php echo $categoria['id']; ?>" 
                              data-nombre="<?php echo $categoria['nombre']; ?>" 
                              data-descripcion="<?php echo $categoria['descripcion']; ?>">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                          </center>
                        </td>
                      </tr>
                    <?php
                    };
                    ?>
                  </tbody>
                </table>
                <script>
                  $(document).on("click", ".btn-edit", function () {
                      var id = $(this).data("id");
                      var nombre = $(this).data("nombre");
                      var descripcion = $(this).data("descripcion");

                      // Llenar los campos del modal
                      $("#edit_id").val(id);
                      $("#edit_nombre").val(nombre);
                      $("#edit_descripcion").val(descripcion);

                      // Mostrar el modal
                      $("#modal-edit").modal("show");
                  });
                </script>
              <!-- /.card-body -->
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

<script>
  $(function () {
    $("#example1").DataTable({
      /* cambio de idiomas de datatable */
      "pageLength": 10,
          language: {
              "emptyTable": "No hay información",
              "decimal": "",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorías",
              "infoEmpty": "Mostrando 0 a 0 de 0 Categorías",
              "infoFiltered": "(Filtrado de _MAX_ total Categorías)",
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
  });
</script>


<!-- modal para registro categorias-->
<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear nueva Categoría</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-grup">
              <label for="">Nombre de la Categoría</label>
              <input type="text" id="categoria_name" class="form-control">
              <label for="">Descripcion de la Categoría</label>
              <input type="text" id="categoria_desc" class="form-control">
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-create">Registrar Categoría</button>
        <div id="respuesta"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>
  $('#btn-create').click(function () {
    var categoria_name = $('#categoria_name').val().trim();
    var categoria_desc = $('#categoria_desc').val().trim();

    if (categoria_name === '' || categoria_desc === '') {
      Swal.fire({
            icon: "warning",
            title: "Por favor, completa todos los campos.",
            showConfirmButton: false,
            timer: 1000
        });
        return;
    }

    $.ajax({
        url: "../../recursos/controllers/categorias/create_categoria_controller.php",
        type: "POST",
        dataType: "json",
        data: { categoria_name: categoria_name, categoria_desc: categoria_desc },
        success: function (response) {
            if (response.status === "success") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $('#modal-create').modal('hide'); // Cerrar el modal
                    location.reload(); // Recargar la página para ver la nueva categoría
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: response.message,
                    showConfirmButton: true
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: "error",
                title: "Error en el servidor",
                text: "No se pudo conectar con el servidor.",
                showConfirmButton: true
            });
        }
    });
  });

</script>

<!-- fin modal para registro categorias-->

<!-- modal para update categorias-->
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Categoría</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit_id">
        <div class="form-group">
          <label>Nombre de la Categoría</label>
          <input type="text" id="edit_nombre" class="form-control">
        </div>
        <div class="form-group">
          <label>Descripción</label>
          <input type="text" id="edit_descripcion" class="form-control">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-update">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
      // Cuando se haga clic en el botón Editar
      $('.btn-edit').click(function () {
          var id = $(this).data('id');
          var nombre = $(this).data('nombre');
          var descripcion = $(this).data('descripcion');

          // Cargar datos en el modal
          $('#edit_id').val(id);
          $('#edit_nombre').val(nombre);
          $('#edit_descripcion').val(descripcion);

          // Mostrar el modal
          $('#modal-edit').modal('show');
      });

      // Botón para actualizar la categoría
      $('#btn-update').click(function () {
          var id = $('#edit_id').val();
          var nombre = $('#edit_nombre').val().trim();
          var descripcion = $('#edit_descripcion').val().trim();

          if (nombre === '' || descripcion === '') {
              Swal.fire({
                  icon: "warning",
                  title: "Todos los campos son obligatorios.",
                  showConfirmButton: false,
                  timer: 1500
              });
              return;
          }

          $.ajax({
              url: "../../recursos/controllers/categorias/update_categoria_controller.php",
              type: "POST",
              dataType: "json",
              data: { id: id, nombre: nombre, descripcion: descripcion },
              success: function (response) {
                  if (response.status === "success") {
                      Swal.fire({
                          icon: "success",
                          title: response.message,
                          showConfirmButton: false,
                          timer: 1500
                      }).then(() => {
                          $('#modal-edit').modal('hide'); // Cerrar modal
                          location.reload(); // Recargar la página
                      });
                  } else {
                      Swal.fire({
                          icon: "error",
                          title: "Error",
                          text: response.message,
                          showConfirmButton: true
                      });
                  }
              },
              error: function () {
                  Swal.fire({
                      icon: "error",
                      title: "Error en el servidor",
                      text: "No se pudo conectar con el servidor.",
                      showConfirmButton: true
                  });
              }
          });
      });
  });
</script>
<!-- fin modal para update categorias-->