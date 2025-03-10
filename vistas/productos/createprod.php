<?php
include ('../../recursos/bd.php');
include ('../../vistas/layout/sesion.php');
include ('../../vistas/layout/parte1.php');

$email_usuario = $_SESSION['usuario_email'] ?? 'No definido';
$id_usuario = $_SESSION['usuario_id'] ?? '';

// Obtener categorías
$stmt = $pdo->prepare("SELECT id, nombre FROM categorias");
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener usuarios
$stmt = $pdo->prepare("SELECT u.id, u.nombre AS usuarios 
	FROM usuarios AS u 
	INNER JOIN roles AS r ON u.rol_id = r.id 
	WHERE r.nombre IN ('almacen', 'administrador', 'superadmin');");
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

      <div class="col-md-6">
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
                    <form action="../../recursos/controllers/productos/create_products_controller.php" method="post">
                        <label for="codigo_saco">Código Saco</label>
                        <input type="text" name="codigo_saco" class="form-control" placeholder="Ingrese el código del saco..." required>

                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del producto..." required>

                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" class="form-control" placeholder="Ingrese la descripción..." rows="3" required></textarea><br>

                        <label for="stock">Stock</label>
                        <input type="number" name="stock" class="form-control" min="0" required>

                        <label for="stock_min">Stock Mínimo</label>
                        <input type="number" name="stock_min" class="form-control" min="0" required>

                        <label for="stock_max">Stock Máximo</label>
                        <input type="number" name="stock_max" class="form-control" min="0" required>

                        <label for="precio_compra">Precio de Compra (S/.)</label>
                        <input type="number" name="precio_compra" class="form-control" min="0" step="0.01" required>

                        <label for="precio_venta">Precio de Venta (S/.)</label>
                        <input type="number" name="precio_venta" class="form-control" min="0" step="0.01" required>

                        <label for="imagen">Imagen del Producto</label>
                        <input type="file" name="imagen" class="form-control" accept="image/*">

                        <label for="id_categoria">Categoría</label>
                        <select class="form-control" name="id_categoria" required>
                            <option value=""></option>
                            <?php foreach ($categorias as $categoria): ?>                                <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Campo oculto para el ID del usuario autenticado -->
                        <input type="hidden" name="id_usuario" value="<?= $id_usuario; ?>">

                        <label for="usuario_email">Registrado por:</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($email_usuario); ?>" disabled>
                        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($id_usuario); ?>">

                        <hr>
                        <div class="form-gruop">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="" class="btn btn-secondary">Cancelar</a>
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
