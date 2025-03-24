<?php
include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');
include ('../../recursos/controllers/productos/list_products_controller.php');
include ('../../recursos/controllers/categorias/list_categoria_controllers.php');
include ('../../recursos/controllers/productos/get_producto.php');

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']); // Eliminar mensaje después de mostrarlo
?>
    <script>
        Swal.fire({
            icon: "<?= $mensaje['tipo'] ?>",
            title: "<?= $mensaje['titulo'] ?>",
            text: "<?= $mensaje['texto'] ?>",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
<?php
}
?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Actualizar Producto</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      <div class="col-md-12">
        <div class="card card-success">
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
                    <form action="../../recursos/controllers/productos/update_products_controller.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="codigo_producto">Código Producto</label>
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($codigo_producto);?>" disabled>
                                            <input type="text" name="codigo_producto" value="<?php echo htmlspecialchars($codigo_producto);?>" hidden>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="codigo_saco">Código Saco</label>
                                            <input type="text" name="codigo_saco" value="<?php echo $codigo_saco;?>" class="form-control" placeholder="Ingrese el código del saco..." required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del Producto</label>
                                            <input type="text" name="nombre" value="<?php echo $nombre;?>" class="form-control" placeholder="Ingrese el nombre del producto..." required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="id_categoria">Categoría</label>
                                            <div class="" style="display: flex;">
                                            <select class="form-control" name="id_categoria" required>
                                                <?php foreach ($categorias_datos as $categoria): ?>
                                                    <option value="<?php echo $categoria['id']; ?>"
                                                        <?php if ($categoria['id'] == $id_categoria) echo 'selected'; ?>>
                                                        <?php echo htmlspecialchars($categoria['nombre']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                                <a href="<?php echo $URL;?> /vistas/categorias/catindex.php" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="number" name="stock" value="<?php echo $stock;?>" class="form-control" min="0" placeholder="0" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="stock_min">Stock Mínimo</label>
                                            <input type="number" name="stock_min" value="<?php echo $stock_min;?>" class="form-control" min="0" placeholder="0" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="stock_max">Stock Máximo</label>
                                            <input type="number" name="stock_max" value="<?php echo $stock_max;?>" class="form-control" min="0" placeholder="0" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio de Compra (S/.)</label>
                                            <input type="number" name="precio_compra" value="<?php echo $precio_compra;?>" class="form-control" min="0" step="0.01" placeholder="S/. 0.00" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio de Venta (S/.)</label>
                                            <input type="number" name="precio_venta" value="<?php echo $precio_venta;?>" class="form-control" min="0" step="0.01" placeholder="S/. 0.00" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Fecha Ingreso</label>
                                            <input type="date" name="fecha_ingreso" value="<?php echo $fecha_ingreso;?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea name="descripcion"  class="form-control" placeholder="Ingrese la descripción..." rows="1" required><?php echo $descripcion;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <!-- Campo oculto para el ID del usuario autenticado -->
                                            <input type="hidden" name="id_usuario" value="<?= $id_usuario; ?>">

                                            <label for="usuario_email">Registrado por:</label>
                                            <input type="text" class="form-control" value="<?= htmlspecialchars($email_usuario); ?>" disabled>
                                            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($id_usuario); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="imagen">Imagen del Producto</label>
                                    <input type="file" name="imagen" class="form-control" id="file"><br>
                                    <input type="hidden" name="imagen_text" value="<?php echo $imagen;?>">
                                    <output id="list">
                                        <img src="<?php echo $URL. "/public/images/img_productos/". $imagen; ?>" width="200px" alt="">
                                    </output>
                                    <script>
                                        function archivo(evt) {
                                            var files = evt.target.files; // FileList object
                                            // Obtenemos la imagen del campo "file".
                                            for (var i = 0, f; f = files[i]; i++) {
                                                //Solo admitimos imágenes.
                                                if (!f.type.match('image.*')) {
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function (theFile) {
                                                    return function (e) {
                                                        // Insertamos la imagen
                                                        document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="200px" title="', escape(theFile.name), '"/>'].join('');
                                                    };
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                                </div>
                            </div>
                        </div>
                            
                        <hr>
                        <div class="form-gruop">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                            <a href="productos_datos" class="btn btn-secondary">Cancelar</a>
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
