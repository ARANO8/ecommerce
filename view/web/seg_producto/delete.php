<?php include ROOT_VIEW . "/template/headeradmin.php"; ?>
<?php
$p_idproducto = $_GET['idproducto'] ?? null;

$record = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'idproducto' => $_POST['idproducto']
    ];
    $context = stream_context_create([
        'http' => [
            'method' => 'DELETE',
            'header' => "Content-Type: application/json",
            'content' => json_encode($data),
        ]
    ]);
    $url = HTTP_BASE . '/controller/Seg_productoController.php';
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);
    if ($result["ESTADO"]) {
        echo "<script>alert('Operacion realizada con Exito.');</script>";
        echo '<script>window.location.href="'.HTTP_BASE.'/web/seg_producto/list'.'";</script>';
    } else {
        echo "<script>alert('Hubo un problema, se debe contactar con el adminsitrador.');</script>";
    }
}
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
                        <h1>Eliminar Producto</h1>
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
                                <h3 class="card-title">Eliminar Producto</h3>
                            </div>
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="idproducto">ID Producto</label>
                                        <input type="hidden" class="form-control" name="idproducto" value="<?php echo $record['idproducto']; ?>">
                                        <input type="number" class="form-control" value="<?php echo $record['idproducto']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="tipo" required value="<?php echo $record['nombre']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">Precio</label>
                                        <input type="number" class="form-control" name="precio" required value="<?php echo $record['precio']; ?> " disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" name="stock" required value="<?php echo $record['stock']; ?> " disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripcion</label>
                                        <input type="text" class="form-control" name="descripcion" required value="<?php echo $record['descripcion']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
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
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                    <a class="btn btn-default" href="<?php echo HTTP_BASE; ?>/view/web/seg_producto/list">Volver</a>
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