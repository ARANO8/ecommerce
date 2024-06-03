<?php require(ROOT_VIEW . '/template/header.php') ?>

<!-- Conexion con el controller -->
<?php
// aqui va la conexion con la tabla de imagenes
$page_img = 1;
$ope_img = 'filterSearch';
$filter_img = '';
$items_per_page_img = 10;
$total_pages_img = 1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $page_img = isset($_POST['page']) ? $_POST['page'] : 1;
  $filter_img = urlencode(trim(isset($_POST['filter']) ? $_POST['filter'] : ''));
}
$url_img = HTTP_BASE . "/controller/Seg_imgproducController.php?ope=" . $ope_img . "&page=" . $page_img . "&filter=" . $filter_img;
$filter_img = urldecode($filter_img);
$response_img = file_get_contents($url_img);

if ($response_img === false) {
  // Handle error in getting the response
  die('Error fetching image data.');
}

// echo "<pre>";
// echo "Response from API: " . htmlspecialchars($response_img) . "\n";
// echo "</pre>";
// Remove non-JSON content if present
$json_start_pos = strpos($response_img, '{');
if ($json_start_pos !== false) {
  $response_img = substr($response_img, $json_start_pos);
}


$responseData_img = json_decode($response_img, true);

if ($responseData_img === null) {
  // Handle JSON decoding error
  die('Error decoding JSON response.' . json_last_error_msg());
}

$records_img = [];
$totalItems_img = 0;

if (isset($responseData_img['DATA'])) {
  $records_img = $responseData_img['DATA'];
}

if (isset($responseData_img['LENGTH'])) {
  $totalItems_img = $responseData_img['LENGTH'];
}

try {
  $total_pages_img = ceil($totalItems_img / $items_per_page_img);
} catch (Exception $e) {
  $total_pages_img = 1;
}
//paginacion
$max_links_img = 5;
$half_max_link_img = floor($max_links_img / 2);
$start_page_img = $page_img - $half_max_link_img;
$end_page_img = $page_img + $half_max_link_img;
if ($start_page_img < 1) {
  $end_page_img += abs($start_page_img) + 1;
  $start_page_img = 1;
}
if ($end_page_img > $total_pages_img) {
  $start_page_img -= ($end_page_img - $total_pages_img);
  $end_page_img = $total_pages_img;
  if ($start_page_img < 1) {
    $start_page_img = 1;
  }
}
// aqui va la conexion con la tabla de los productos
$page_prod = 1;
$ope_prod = 'filterSearch';
$filter_prod = '';
$items_per_page_prod = 10;
$total_pages_prod = 1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $page_prod = isset($_POST['page']) ? $_POST['page'] : 1;
  $filter_prod = urlencode(trim(isset($_POST['filter']) ? $_POST['filter'] : ''));
}
$url_prod = HTTP_BASE . "/controller/Seg_productoController.php?ope=" . $ope_prod . "&page=" . $page_prod . "&filter=" . $filter_prod;
$filter_prod = urldecode($filter_prod);
$response_prod = file_get_contents($url_prod);
$responseData_prod = json_decode($response_prod, true);
$records_prod = $responseData_prod['DATA'];
$totalItems_prod = $responseData_prod['LENGTH'];
try {
  $total_pages_prod =  ceil($totalItems_prod / $items_per_page_prod);
} catch (Exception $e) {
  $total_pages_prod = 1;
}
//paginacion
$max_links_prod = 5;
$half_max_link_prod = floor($max_links_prod / 2);
$start_page_prod = $page_prod - $half_max_link_prod;
$end_page_prod = $page_prod + $half_max_link_prod;
if ($start_page_prod < 1) {
  $end_page_prod += abs($start_page_prod) + 1;
  $start_page_prod = 1;
}
if ($end_page_prod > $total_pages_prod) {
  $start_page_prod -= ($end_page_prod - $total_pages_prod);
  $end_page_prod = $total_pages_prod;
  if ($start_page_prod < 1) {
    $start_page_prod = 1;
  }
}
?>
<!-- /Conexion con el controller -->
<!-- NAVIGATION -->
<nav id="navigation">
  <!-- container -->
  <div class="container">
    <!-- responsive-nav -->
    <div id="responsive-nav">
      <!-- NAV -->
      <ul class="main-nav nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Hot Deals</a></li>
        <li><a href="#">Categories</a></li>
        <li><a href="#">Laptops</a></li>
        <li><a href="#">Smartphones</a></li>
        <li><a href="#">Camaras</a></li>
        <li><a href="#">Accesorios</a></li>
      </ul>
      <!-- /NAV -->
    </div>
    <!-- /responsive-nav -->
  </div>
  <!-- /container -->
</nav>
<!-- /NAVIGATION -->

<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <!-- shop -->
      <div class="col-md-4 col-xs-6">
        <div class="shop">
          <div class="shop-img">
            <img src="<?php echo URL_RESOURCES; ?>img/shop01.png" alt="">
          </div>
          <div class="shop-body">
            <h3>Laptop<br>Coleccion</h3>
            <a href="#" class="cta-btn">Comprar Ahora <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /shop -->

      <!-- shop -->
      <div class="col-md-4 col-xs-6">
        <div class="shop">
          <div class="shop-img">
            <img src="<?php echo URL_RESOURCES; ?>img/shop03.png" alt="">
          </div>
          <div class="shop-body">
            <h3>Accesorios<br>Coleccion</h3>
            <a href="#" class="cta-btn">Comprar Ahora <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /shop -->

      <!-- shop -->
      <div class="col-md-4 col-xs-6">
        <div class="shop">
          <div class="shop-img">
            <img src="<?php echo URL_RESOURCES; ?>img/shop02.png" alt="">
          </div>
          <div class="shop-body">
            <h3>Camaras<br>Coleccion</h3>
            <a href="#" class="cta-btn">Comprar Ahora <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /shop -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <!-- section title -->
      <div class="col-md-12">
        <div class="section-title">
          <h3 class="title">Nuevos</h3>
          <div class="section-nav">
            <ul class="section-tab-nav tab-nav">
              <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
              <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
              <li><a data-toggle="tab" href="#tab1">Camaras</a></li>
              <li><a data-toggle="tab" href="#tab1">Accesorios</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /section title -->

      <!-- Products tab & slick -->
      <div class="col-md-12">
        <div class="row">
          <div class="products-tabs">
            <!-- tab -->
            <div id="tab1" class="tab-pane active">
              <div class="products-slick" data-nav="#slick-nav-1">
                <?php foreach ($records_prod as  $row) : ?>

                  <?php //if(htmlspecialchars($row['new'])=='true'){
                  ?>
                  <!-- product -->
                  <div class="product">
                    <div class="product-img">
                      <?php foreach ($records_img as  $row1) : ?>
                        <?php if (htmlspecialchars($row1['idimg']) == htmlspecialchars($row['idimg'])) { ?>
                          <img src="<?php echo HTTP_BASE . "/" . $row1['rutaimagen']; ?>" alt="">
                        <?php } ?>

                        <div class="product-label">
                          <span class="new">NUEVO</span>
                        </div>

                      <?php endforeach; ?>
                    </div>
                    <div class="product-body">
                      <p class="product-Categoria">Categoria</p>
                      <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($row['nombre']); ?></a></h3>
                      <h4 class="product-price">$<?php echo htmlspecialchars($row['precio']); ?></h4>

                      <div class="product-btns">
                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                      </div>
                    </div>
                    <div class="add-to-cart">
                      <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Agregar</button>
                    </div>
                  </div>
                  <!-- /product -->
                  <?php //}
                  ?>
                <?php endforeach; ?>
              </div>
              <div id="slick-nav-1" class="products-slick-nav"></div>
            </div>
            <!-- /tab -->
          </div>
        </div>
      </div>
      <!-- Products tab & slick -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-md-12">
        <div class="hot-deal">
          <ul class="hot-deal-countdown">
            <li>
              <div>
                <h3>02</h3>
                <span>Days</span>
              </div>
            </li>
            <li>
              <div>
                <h3>10</h3>
                <span>Hours</span>
              </div>
            </li>
            <li>
              <div>
                <h3>34</h3>
                <span>Mins</span>
              </div>
            </li>
            <li>
              <div>
                <h3>60</h3>
                <span>Secs</span>
              </div>
            </li>
          </ul>
          <h2 class="text-uppercase">Productos de la Semana</h2>
          <p>Hasta con 50 % de Descuento</p>
          <a class="primary-btn cta-btn" href="#">Comprar Ahora</a>
        </div>
      </div>
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">

      <!-- section title -->
      <div class="col-md-12">
        <div class="section-title">
          <h3 class="title">Mas Vendidos</h3>
          <div class="section-nav">
            <ul class="section-tab-nav tab-nav">
              <li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
              <li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
              <li><a data-toggle="tab" href="#tab2">Camaras</a></li>
              <li><a data-toggle="tab" href="#tab2">Accesorios</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /section title -->

      <!-- Products tab & slick -->
      <div class="col-md-12">
        <div class="row">
          <div class="products-tabs">
            <!-- tab -->
            <div id="tab2" class="tab-pane fade in active">
              <div class="products-slick" data-nav="#slick-nav-2">
                <!-- aqui va los productos nuevamente
 -->

                <?php foreach ($records_prod as  $row) : ?>

                  <?php //if(htmlspecialchars($row['new'])=='true'){
                  ?>
                  <!-- product -->
                  <div class="product">
                    <div class="product-img">
                      <?php foreach ($records_img as  $row1) : ?>
                        <?php if (htmlspecialchars($row1['idimg']) == htmlspecialchars($row['idimg'])) { ?>
                          <img src="<?php echo HTTP_BASE . "/" . $row1['rutaimagen']; ?>" alt="">
                        <?php } ?>

                        <div class="product-label">
                          <span class="new">NUEVO</span>
                        </div>

                      <?php endforeach; ?>
                    </div>
                    <div class="product-body">
                      <p class="product-Categoria">Categoria</p>
                      <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($row['nombre']); ?></a></h3>
                      <h4 class="product-price">$<?php echo htmlspecialchars($row['precio']); ?></h4>

                      <div class="product-btns">
                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                      </div>
                    </div>
                    <div class="add-to-cart">
                      <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Agregar</button>
                    </div>
                  </div>
                  <!-- /product -->
                  <?php //}
                  ?>
                <?php endforeach; ?>
              </div>
              <div id="slick-nav-2" class="products-slick-nav"></div>
            </div>
            <!-- /tab -->
          </div>
        </div>
      </div>
      <!-- /Products tab & slick -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->



<!-- NEWSLETTER -->
<div id="newsletter" class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-md-12">
        <div class="newsletter">
          <p>Registrate para recibir <strong>NOVEDADES</strong></p>
          <form>
            <input class="input" type="email" placeholder="Correo Electronico">
            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Suscribirse</button>
          </form>
          <ul class="newsletter-follow">
            <li>
              <a href="#"><i class="fa fa-facebook"></i></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-instagram"></i></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-pinterest"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /NEWSLETTER -->
<?php require(ROOT_VIEW . '/template/footer.php') ?>