<?php
include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');

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
            <h1 class="m-0">Tienda #307 
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
            <h3 class="card-title">Lista de Productos</h3>

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
                      <th>Nombre</th>
                      <th>Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <script>
                    $(document).ready(function () {
                        // Cargar productos dinámicamente
                        $.ajax({
                            url: '../../recursos/controllers/stock/stock_controller_tienda2.php',
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                              console.log("Datos cargados:", data);
                              let tbody = $('#example1 tbody');
                              tbody.empty();
                              $.each(data, function (index, producto) {
                                let fila = `<tr>
                                    <td>${index + 1}</td>
                                    <td>${producto.codigo_producto}</td>
                                    <td>${producto.codigo_saco}</td>
                                    <td>${producto.nombre}</td>
                                    <td>${producto.stock_tienda_2}</td>
                                  </tr>`;
                                  tbody.append(fila);  // En vez de concatenar strings, usa .append()
                              });
                            },
                            error: function (xhr, status, error) {
                                console.error("Error en AJAX:", status, error);
                            }
                        });
                    });
                  </script>
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
      "destroy": true,
      "pageLength": 10,
      "ajax": {
        "url": "../../recursos/controllers/stock/stock_controller_tienda2.php",
        "type": "GET",
        "dataSrc": ""
      },
      "columns": [
        { "data": null, // Nro
          "render": function (data, type, row, meta) {
            return meta.row + 1; 
          }
        },
        { "data": "codigo_producto" },
        { "data": "codigo_saco" },
        { "data": "nombre" },
        { "data": "stock_tienda_2" }
      ],
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