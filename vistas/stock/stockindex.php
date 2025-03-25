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
            <h1 class="m-0">Mover Productos
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
            <h3 class="card-title">Gestion de Productos</h3>

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
                      <th>Stock Total</th>
                      <th>Tienda #202</th>
                      <th>Tienda #309</th>
                      <th>Almacén</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <script>
                    $(document).ready(function () {
                    // Cargar productos dinámicamente
                    $.ajax({
                        url: '../../recursos/controllers/stock/stock_controller.php',
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
                                <td>${producto.stock_total}</td>  // <- Aquí estaba el error en "stock"
                                <td>${producto.stock_tienda_1}</td>
                                <td>${producto.stock_tienda_2}</td>
                                <td>${producto.stock_almacen}</td>
                                <td>
                                    <button class="btn btn-primary btn-mover"
                                        data-id="${producto.id}"
                                        data-almacen="${producto.stock_almacen}"
                                        data-tienda1="${producto.stock_tienda_1}"
                                        data-tienda2="${producto.stock_tienda_2}">
                                        Mover
                                    </button>
                                </td>
                              </tr>`;
                              tbody.append(fila);  // En vez de concatenar strings, usa .append()
                          });
                        },
                        error: function (xhr, status, error) {
                            console.error("Error en AJAX:", status, error);
                        }
                    });

                    // Evento para mover productos
                    $(document).on('click', '.btn-mover', function () {
                      let idProducto = $(this).data('id');
                      let stockAlmacen = parseInt($(this).data('almacen'));
                      let stockTienda1 = parseInt($(this).data('tienda1'));
                      let stockTienda2 = parseInt($(this).data('tienda2'));

                      // Limpiar valores previos
                      $('#cantidad').val('');
                      $('#origen').val('');
                      $('#destino').val('');

                      // Pasar datos al modal
                      $('#idProducto').val(idProducto);
                      $('#origen').empty().append(`
                          <option value="">Seleccionar origen</option>
                          <option value="tienda_1" data-stock="${stockTienda1}">Tienda #202 - ${stockTienda1}</option>
                          <option value="tienda_2" data-stock="${stockTienda2}">Tienda #309 - ${stockTienda2}</option>
                          <option value="almacen" data-stock="${stockAlmacen}">Almacén - ${stockAlmacen}</option>
                      `);
                      
                      $('#destino').empty().append(`
                          <option value="">Seleccionar destino</option>
                          <option value="almacen">Almacén</option>
                          <option value="tienda_1">Tienda #202</option>
                          <option value="tienda_2">Tienda #309</option>
                      `);

                      // Mostrar el modal
                      $('#modal-move').modal('show');
                    });

                    // Validar cantidad según stock disponible en el origen seleccionado
                    $('#origen').on('change', function () {
                      let stockDisponible = $('option:selected', this).data('stock') || 0;
                      $('#cantidad').attr('max', stockDisponible);
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

<!-- Modal para mover productos -->
<div class="modal fade" id="modal-move">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mover Producto</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formMoverProducto">
                <div class="modal-body">
                    <input type="hidden" id="idProducto" name="id">
                    
                    <div class="mb-3">
                        <label for="origen" class="form-label">Origen</label>
                        <select id="origen" name="origen" class="form-control" required></select>
                    </div>

                    <div class="mb-3">
                        <label for="destino" class="form-label">Destino</label>
                        <select id="destino" name="destino" class="form-control" required>
                            <option value="">Seleccionar destino</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-move">Mover Producto</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<script>
// Enviar la solicitud AJAX al controlador
$('#formMoverProducto').submit(function (e) {
    e.preventDefault();

    let cantidad = parseInt($('#cantidad').val());
    let maxStock = parseInt($('#cantidad').attr('max'));

    if (cantidad <= 0 || cantidad > maxStock) {
      Swal.fire({
          title: "Error",
          text: "Cantidad inválida.",
          icon: "error",
          confirmButtonText: "Aceptar"
      });
      return;
    }

      $.ajax({
          url: '../../recursos/controllers/stock/move_producto_controller.php',
          type: 'POST',
          data: $(this).serialize(),
          dataType: 'json',
          success: function (response) {
            if (response.status === "success") {
              Swal.fire({
                    position: "center",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $('#modal-move').modal('hide'); // Cerrar el modal
                    location.reload(); // Recargar la página para ver la nueva categoría
                });

            } else {
                Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error",
                    confirmButtonText: "Aceptar",
                    timer: 1500
                });
            }
        },
        error: function () {
            Swal.fire({
                title: "Error",
                text: "Hubo un problema con la solicitud.",
                icon: "error",
                confirmButtonText: "Aceptar"
            });
        }
      });
  });
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      /* cambio de idiomas de datatable */
      "destroy": true,
      "pageLength": 10,
      "ajax": {
        "url": "../../recursos/controllers/stock/stock_controller.php",
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
        { "data": "stock_total" },
        { "data": "stock_tienda_1" },
        { "data": "stock_tienda_2" },
        { "data": "stock_almacen" },
        {
          "data": null,
          "render": function (data, type, row) {
            return `
              <button class="btn btn-primary btn-mover"
                      data-id="${row.id}"
                      data-almacen="${row.stock_almacen}"
                      data-tienda1="${row.stock_tienda_1}"
                      data-tienda2="${row.stock_tienda_2}">
                Mover
              </button>`;
          }
        }
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