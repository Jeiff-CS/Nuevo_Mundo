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
                            <!--<button type="button" class="btn bg-success btn-sm btn-edit" 
                              data-id="<?php //echo $productos['id']; ?>" 
                              data-codigo_producto="<?php //echo $productos['codigo_producto']; ?>" 
                              data-codigo_saco="<?php //echo $productos['codigo_saco']; ?>" 
                              data-categoria="<?php // $productos['categoria_nombre']; ?>" 
                              data-nombre="<?php //echo $productos['nombre']; ?>"
                              data-descripcion="<?php //echo $productos['descripcion']; ?>"
                              data-imagen="<?php //echo $productos['imagen']; ?>"
                              data-stock="<?php // echo $productos['stock']; ?>"
                              data-stock_min="<?php // echo $productos['stock_min']; ?>"
                              data-stock_max="<?php // echo $productos['stock_max']; ?>"
                              data-precio_compra="<?php //echo $productos['precio_compra']; ?>"
                              data-precio_venta="<?php //echo $productos['precio_venta']; ?>"
                              data-fecha_ingreso="<?php // echo $productos['fecha_ingreso']; ?>"
                              data-usuario_email="<?php // echo $productos['usuario_email']; ?>">
                              <i class="fa fa-pencil-alt"></i>
                            </button>-->
                          </center>
                        </td>
                      </tr>
                    <?php
                    };
                    ?>
                  </tbody>
                </table>
                <script>
                  /*
                  $(document).on("click", ".btn-edit", function () {
                      var id = $(this).data("id");
                      var codigo_producto = $(this).data("codigo_producto");
                      var codigo_saco = $(this).data("codigo_saco");
                      var categoria = $(this).data("categoria");
                      var nombre = $(this).data("nombre");
                      var descripcion = $(this).data("descripcion");
                      var imagen = $(this).data("imagen");
                      var stock = $(this).data("stock");
                      var stock_min = $(this).data("stock_min");
                      var stock_max = $(this).data("stock_max");
                      var precio_compra = $(this).data("precio_compra");
                      var precio_venta = $(this).data("precio_venta");

                      // Llenar los campos del modal
                      $("#edit_id").val(id);
                      $("#edit_codigo_producto").val(codigo_producto);
                      $("#edit_codigo_saco").val(codigo_saco);
                      //$("#edit_categoria").val(categoria);
                      $("#edit_nombre").val(nombre);
                      $("#edit_descripcion").val(descripcion);
                      $("#edit_imagen").val(imagen);
                      $("#edit_stock").val(stock);
                      $("#edit_stock_min").val(stock_min);
                      $("#edit_stock_max").val(stock_max);
                      $("#edit_precio_compra").val(precio_compra);
                      $("#edit_precio_venta").val(precio_venta);

                      $.ajax({
                          url: "../../recursos/controllers/productos/get_categoria.php",
                          type: "GET",
                          dataType: "json",
                          success: function (data) {
                              let select = $("#edit_categoria");
                              select.empty();
                              select.append('<option value="">Seleccione una categoría</option>');

                              $.each(data, function (index, cat) {
                                  let selected = (cat.nombre === categoria) ? "selected" : "";
                                  select.append(`<option value="${cat.id}" ${selected}>${cat.nombre}</option>`);
                              });
                          },
                          error: function (xhr, status, error) {
                              console.error("Error al cargar categorías:", error);
                          }
                      });

                      // Mostrar el modal
                      $("#modal-edit").modal("show");
                  });*/
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

