<?php include ROOT_VIEW . "/template/headeradmin.php"; ?>
<?php
$p_idproducto = $_GET['idproducto'] ?? null;

$record = null;

if ($p_idproducto) {
    $url = HTTP_BASE . '/controller/Seg_productoController.php?ope=filterId&idproducto=' . $p_idproducto;
    $reponse = file_get_contents($url);
    $reponseData = json_decode($reponse, true);
    if ($reponseData &&  $reponseData['ESTADO'] == 1 && !empty($reponseData['DATA'])) {
        $record = $reponseData['DATA'][0];
    } else {
        $record = null;
    }
}

?>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ver Detalle de Producto</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Ver Producto</h3>
                            </div>
                            <form action="" method="post">
                                <div class="card-body">
                                <div class="form-group">
                                        <label for="idproducto">ID Producto</label>
                                        <input type="hidden" class="form-control" name="idproducto" value="<?php echo $record['idproducto']; ?>">
                                        <input type="number" class="form-control" value="<?php echo $record['idproducto']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">nombre</label>
                                        <input type="text" class="form-control" name="nombre" required value="<?php echo $record['nombre']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">Precio</label>
                                        <input type="number" class="form-control" name="precio" required value="<?php echo $record['precio'];?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" name="stock" required value="<?php echo $record['stock'];?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">descripcion</label>
                                        <input type="text" class="form-control" name="descripcion" required value="<?php echo $record['descripcion']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="estado">estado</label>
                                        <input type="number" class="form-control" name="estado" required value="<?php echo $record['estado']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="idimg">idimg</label>
                                        <input type="number" class="form-control" name="idimg" required value="<?php echo $record['idimg']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="idcategoria">idcategoria</label>
                                        <input type="number" class="form-control" name="idcategoria" required value="<?php echo $record['idcategoria']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-default" href="<?php echo HTTP_BASE; ?>/web/seg_producto/list">Volver</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php include ROOT_VIEW . "/template/footeradmin.php"; ?>