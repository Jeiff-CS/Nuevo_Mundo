<?php
include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');
include ('../../recursos/controllers/productos/list_products_controller.php');

if (isset($_SESSION['mensaje'])) {
  $tipo = $_SESSION['mensaje']['tipo'];
  $texto = $_SESSION['mensaje']['texto'];
  echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: '¡Éxito!',
              text: '$texto',
              icon: '$tipo',
              confirmButtonText: 'Aceptar'
          });
      });
  </script>";
  unset($_SESSION['mensaje']); // Borra el mensaje para que no se repita
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
                      <th>Saco</th>
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
                    $contador = 0;
                    foreach($productos_datos as $productos){
                      $id_producto = $productos['id']; ?>
                      <tr>
                        <td><?php echo $productos['id'] ?></td>
                        <td><?php echo $productos['codigo_producto'] ?></td>
                        <td><?php echo $productos['codigo_saco'] ?></td>
                        <td><?php echo $productos['categoria_nombre'] ?></td>
                        <td><?php echo $productos['nombre'] ?></td>
                        <td><?php echo $productos['descripcion'] ?></td>
                        <td><img src="<?php echo $URL. "/public/images/img_productos/" .$productos['imagen'] ?>" width="50px"></td>
                        <td><?php echo $productos['stock'] ?></td>
                        <td><?php echo $productos['stock_min'] ?></td>
                        <td><?php echo $productos['stock_max'] ?></td>
                        <td><?php echo "S/." . $productos['precio_compra'] ?></td>
                        <td><?php echo "S/." . $productos['precio_venta'] ?></td>
                        <td><?php echo $productos['fecha_ingreso'] ?></td>
                        <td><?php echo $productos['usuario_email']; ?>
                        <td>
                          <center>
                            <a href="updateprod.php?id=<?php echo $id_producto;?>" type="button" class="btn bg-success btn-sm btn-edit"><i class="fa fa-pencil-alt"></i></a>
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