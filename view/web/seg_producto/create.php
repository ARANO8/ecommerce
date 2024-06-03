<?php include ROOT_VIEW . "/template/headeradmin.php"; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
       
        'idproducto' => $_POST['idproducto'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'stock' => $_POST['stock'],
        'descripcion' => $_POST['descripcion'],
        'estado' => $_POST['estado'],
        'idimg' => $_POST['idimg'],
        'idcategoria' => $_POST['idcategoria'],
    ];
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json",
            'content' => json_encode($data),
        ]
    ]);
    $url = HTTP_BASE . '/controller/Seg_productoController.php';
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
                                        <input type="number" class="form-control" name="idproducto" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">nombre</label>
                                        <input type="text" class="form-control" name="nombre" required value="">
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
                                        <label for="descripcion">descripcion</label>
                                        <input type="text" class="form-control" name="descripcion" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="estado">estado</label>
                                        <input type="number" class="form-control" name="estado" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="idimg">idimg</label>
                                        <input type="number" class="form-control" name="idimg" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="idcategoria">idcategoria</label>
                                        <input type="number" class="form-control" name="idcategoria" required value="">
                                    </div>
                    
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">GUARDAR</button>
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

