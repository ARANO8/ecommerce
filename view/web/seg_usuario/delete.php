<?php include ROOT_VIEW . "/template/header.php"; ?>
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
    $url = HTTP_BASE . '/controller/Seg_tiendaController.php';
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);
    if ($result["ESTADO"]) {
        echo "<script>alert('Operacion realizada con Exito.');</script>";
        echo '<script>window.location.href="'.HTTP_BASE.'/web/seg_tienda/list'.'";</script>';
    } else {
        echo "<script>alert('Hubo un problema, se debe contactar con el adminsitrador.');</script>";
    }
}
if ($p_idproducto) {
    $url = HTTP_BASE . '/controller/Seg_tiendaController.php?ope=filterId&idproducto=' . $p_idproducto;
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
                        <h1>Editar Producto</h1>
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
                                <h3 class="card-title">Editar Producto</h3>
                            </div>
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="idproducto">Codigo Ropa</label>
                                        <input type="hidden" class="form-control" name="idproducto" value="<?php echo $record['idproducto']; ?>">
                                        <input type="text" class="form-control" value="<?php echo $record['idproducto']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo">Tipo</label>
                                        <input type="text" class="form-control" name="tipo" required value="<?php echo $record['tipo']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="talla">Talla</label>
                                        <input type="text" class="form-control" name="talla" required value="<?php echo $record['talla']; ?>" disabled>
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
                                        <label for="marca">Marca</label>
                                        <input type="text" class="form-control" name="marca" required value="<?php echo $record['marca']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="proveedor">Proveedor</label>
                                        <input type="text" class="form-control" name="proveedor" required value="<?php echo $record['proveedor']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <input type="text" class="form-control" name="color" required value="<?php echo $record['color']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                    <a class="btn btn-default" href="<?php echo HTTP_BASE; ?>/view/web/seg_tienda/list">Volver</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php include ROOT_VIEW . "/template/footer.php"; ?>