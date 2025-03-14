<?php
include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');
include ('../../recursos/controllers/productos/list_products_controller.php');

if (isset($_SESSION['mensaje'])) {
  echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: '¡Éxito!',
              text: '" . $_SESSION['mensaje'] . "',
              icon: '" . $_SESSION['mensaje_tipo'] . "',
              confirmButtonText: 'OK'
          });
      });
  </script>";
  unset($_SESSION['mensaje']); // Borra el mensaje para que no se repita
  unset($_SESSION['mensaje_tipo']);
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">  
          <div class="col-sm-12">
            <h1 class="m-0">Listado de Productos
            <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='createprod.php'">
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
        <div class="col-md-12">
          <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Productos Registrados</h3>

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
                      <th>Codigo</th>
                      <th>Categoria</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Imagen</th>
                      <th>Stock</th>
                      <th>Stock min</th>
                      <th>Stock max</th>
                      <th>Precio Compra</th>
                      <th>Precio Venta</th>
                      <th>Fecha Compra</th>
                      <th>Usuario</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($productos_datos as $productos){?>
                      <tr>
                        <td><?php echo $productos['id'] ?></td>
                        <td><?php echo $productos['codigo_saco'] ?></td>
                        <td><?php echo $productos['categoria_nombre'] ?></td>
                        <td><?php echo $productos['nombre'] ?></td>
                        <td><?php echo $productos['descripcion'] ?></td>
                        <td><img src="<?php echo $productos['imagen'] ?>" width="50px"></td>
                        <td><?php echo $productos['stock'] ?></td>
                        <td><?php echo $productos['stock_min'] ?></td>
                        <td><?php echo $productos['stock_max'] ?></td>
                        <td><?php echo "S/." . $productos['precio_compra'] ?></td>
                        <td><?php echo "S/." . $productos['precio_venta'] ?></td>
                        <td><?php echo $productos['fecha_ingreso'] ?></td>
                        <td><?php echo $productos['usuario_email']; ?>
                        <td>
                          <center>
                            <button type="button" class="btn bg-success btn-sm btn-edit" 
                              data-id="<?php echo $productos['id']; ?>" 
                              data-codigo_saco="<?php echo $productos['codigo_saco']; ?>" 
                              data-categoria="<?php echo $productos['categoria_nombre']; ?>" 
                              data-nombre="<?php echo $productos['nombre']; ?>"
                              data-descripcion="<?php echo $productos['descripcion']; ?>"
                              data-imagen="<?php echo $productos['imagen']; ?>"
                              data-stock="<?php echo $productos['stock']; ?>"
                              data-stock_min="<?php echo $productos['stock_min']; ?>"
                              data-stock_max="<?php echo $productos['stock_max']; ?>"
                              data-precio_compra="<?php echo $productos['precio_compra']; ?>"
                              data-precio_venta="<?php echo $productos['precio_venta']; ?>"
                              data-fecha_ingreso="<?php echo $productos['fecha_ingreso']; ?>"
                              data-usuario_email="<?php echo $productos['usuario_email']; ?>">
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
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
              "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
              "infoFiltered": "(Filtrado de _MAX_ total Productos)",
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


<!-- modal para update Productos-->
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