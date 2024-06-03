<?php include ROOT_VIEW . "/template/header.php"; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
       
        'idproducto' => $_POST['idproducto'],
        'tipo' => $_POST['tipo'],
        'talla' => $_POST['talla'],
        'precio' => $_POST['precio'],
        'stock' => $_POST['stock'],
        'marca' => $_POST['marca'],
        'proveedor' => $_POST['proveedor'],
        'color' => $_POST['color'],
    ];
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json",
            'content' => json_encode($data),
        ]
    ]);
    $url = HTTP_BASE . '/controller/Seg_tiendaController.php';
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);
    if ($result["ESTADO"]) {
        echo "<script>alert('Operacion realizada con Exito.');</script>";
    } else {
        echo "<script>alert('Hubo un problema, se debe contactar con el adminsitrador.');</script>";
    }
}


?>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear Producto</h1>
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
                                <h3 class="card-title">Crear Producto</h3>
                            </div>
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="idproducto">idproducto</label>
                                        <input type="text" class="form-control" name="idproducto" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo">tipo</label>
                                        <input type="text" class="form-control" name="tipo" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="talla">talla</label>
                                        <input type="text" class="form-control" name="talla" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">precio</label>
                                        <input type="number" class="form-control" name="precio" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">stock</label>
                                        <input type="number" class="form-control" name="stock" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="marca">marca</label>
                                        <input type="text" class="form-control" name="marca" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="proveedor">proveedor</label>
                                        <input type="text" class="form-control" name="proveedor" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="color">color</label>
                                        <input type="text" class="form-control" name="color" required value="">
                                    </div>
                    
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">GUARDAR</button>
                                    <a class="btn btn-default" href="<?php echo HTTP_BASE; ?>/web/seg_tienda/list">Volver</a>
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

