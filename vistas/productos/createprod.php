<?php
include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');
include ('../../recursos/controllers/productos/list_products_controller.php');

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
            <h1 class="m-0">Resgistro de un nuevo Producto</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      <div class="col-md-12">
        <div class="card card-primary">
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
                    <form action="../../recursos/controllers/productos/create_products_controller.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="codigo_producto">Código Producto</label>
                                            <?php
                                            function ceros($numero){
                                                $len=0;
                                                $cantidad_ceros = 5;
                                                $aux=$numero;
                                                $pos=strlen($numero);
                                                $len=$cantidad_ceros-$pos;
                                                for ($i=0;$i<$len;$i++){
                                                    $aux="0".$aux;
                                                }
                                                return $aux;
                                            } 
                                            $contador_id_producto = 1;
                                            foreach($productos_datos as $productos){
                                                $contador_id_producto = $contador_id_producto +1;
                                            };
                                            ?>
                                            <input type="text" class="form-control" value="<?php echo "P-" .ceros($contador_id_producto);?>" disabled>
                                            <input type="text" name="codigo_producto" value="<?php echo "P-" .ceros($contador_id_producto);?>" hidden>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="codigo_saco">Código Saco</label>
                                            <input type="text" name="codigo_saco" class="form-control" placeholder="Ingrese el código del saco..." required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del Producto</label>
                                            <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del producto..." required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="id_categoria">Categoría</label>
                                            <div class="" style="display: flex;">
                                                <select class="form-control" name="id_categoria" required>
                                                    <option value="" ></option>
                                                    <?php foreach ($categorias as $categoria): ?>
                                                        <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <a href="<?php echo $URL;?> /vistas/categorias/catindex.php" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="number" name="stock" class="form-control" min="0" placeholder="0" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="stock_min">Stock Mínimo</label>
                                            <input type="number" name="stock_min" class="form-control" min="0" placeholder="0" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="stock_max">Stock Máximo</label>
                                            <input type="number" name="stock_max" class="form-control" min="0" placeholder="0" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio de Compra (S/.)</label>
                                            <input type="number" name="precio_compra" class="form-control" min="0" step="0.01" placeholder="S/. 0.00" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio de Venta (S/.)</label>
                                            <input type="number" name="precio_venta" class="form-control" min="0" step="0.01" placeholder="S/. 0.00" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Fecha Ingreso</label>
                                            <input type="date" name="fecha_ingreso" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea name="descripcion" class="form-control" placeholder="Ingrese la descripción..." rows="1" required></textarea>
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
                                    <input type="file" name="imagen" class="form-control" accept="image/*" id="file"><br>
                                    <output id="list"></output>
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
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="prodindex.php" class="btn btn-secondary">Cancelar</a>
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
