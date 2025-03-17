
<!--
va despues del ultimo script line 253
modal para update Productos-->
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Productos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit_id">
          <div class="form-group">
            <label>Saco</label>
            <input type="text" id="edit_codigo_saco" class="form-control">
          </div>
          <div class="form-group">
            <label>Categoria</label>
            <select type="text" id="edit_categoria" name="id_categoria" class="form-control" ></select>
          </div>
          <div class="form-group">
            <label>Nombre del Producto</label>
            <input type="text" id="edit_nombre" class="form-control">
          </div>
          <div class="form-group">
            <label>Descripción</label>
            <textarea type="text" id="edit_descripcion" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Imagen</label>
            <input type="text" id="edit_imagen" class="form-control">
          </div>
          <div class="form-group">
            <label>Stock</label>
            <input type="text" id="edit_stock" class="form-control">
          </div>
          <div class="form-group">
            <label>Stock minimo</label>
            <input type="text" id="edit_stock_min" class="form-control">
          </div>
          <div class="form-group">
            <label>Stock Maximo</label>
            <input type="text" id="edit_stock_max" class="form-control">
          </div>
          <div class="form-group">
            <label>Precio de Compra</label>
            <input type="text" id="edit_precio_compra" class="form-control">
          </div>
          <div class="form-group">
            <label>Precio de Venta</label>
            <input type="text" id="edit_precio_venta" class="form-control">
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
          var codigo_saco = $(this).data("codigo_saco");
          var categoria = $(this).data("categoria_nombre");
          var nombre = $(this).data("nombre");
          var descripcion = $(this).data("descripcion");
          var imagen = $(this).data("imagen");
          var stock = $(this).data("stock");
          var stock_min = $(this).data("stock_min");
          var stock_max = $(this).data("stock_max");
          var precio_compra = $(this).data("precio_compra");
          var precio_venta = $(this).data("precio_venta");

          // Cargar datos en el modal
          $('#edit_id').val(id);
          $("#edit_codigo_saco").val(codigo_saco);
          $("#edit_categoria").val(categoria_nombre);
          $("#edit_nombre").val(nombre);
          $("#edit_descripcion").val(descripcion);
          $("#edit_imagen").val(imagen);
          $("#edit_stock").val(stock);
          $("#edit_stock_min").val(stock_min);
          $("#edit_stock_max").val(stock_max);
          $("#edit_precio_compra").val(precio_compra);
          $("#edit_precio_venta").val(precio_venta);

          // Mostrar el modal
          $('#modal-edit').modal('show');
      });

      // Botón para actualizar el producto
      $('#btn-update').click(function () {
          var id = $('#edit_id').val();
          var codigo_saco = $("#edit_codigo_saco").val().trim();
          var categoria = $("#edit_categoria").val().trim();
          var nombre = $("#edit_nombre").val().trim();
          var descripcion = $("#edit_descripcion").val().trim();
          var imagen = $("#edit_imagen").val().trim();
          var stock = $("#edit_stock").val().trim();
          var stock_min = $("#edit_stock_min").val().trim();
          var stock_max = $("#edit_stock_max").val().trim();
          var precio_compra = $("#edit_precio_compra").val().trim();
          var precio_venta = $("#edit_precio_venta").val().trim();

          if (nombre === '' || descripcion === '' || codigo_saco === ''|| categoria === '' || stock === ''|| stock_min === ''|| stock_max === ''|| 
              precio_compra === ''|| precio_venta === '') {
              Swal.fire({
                  icon: "warning",
                  title: "Todos los campos son obligatorios.",
                  showConfirmButton: false,
                  timer: 1500
              });
              return;
          }

          $.ajax({
              url: "../../recursos/controllers/productos/update_products_controller.php",
              type: "POST",
              dataType: "json",
              data: { id: id, 
                      codigo_saco: codigo_saco, 
                      categoria: categoria, 
                      nombre: nombre, 
                      descripcion: descripcion, 
                      imagen: imagen, 
                      stock: stock, 
                      stock_min: stock_min, 
                      stock_max: stock_max, 
                      precio_compra: precio_compra, 
                      precio_venta: precio_venta},

              success: function (response) {
                console.log("Respuesta del servidor:", response);
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
                      showConfirmButton: true,
                      timer: 1500
                  });
              }
          });
      });
  });
</script>
<!-- fin modal para update categorias-->