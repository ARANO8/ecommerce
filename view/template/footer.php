<!-- FOOTER -->
<footer id="footer">
  <!-- top footer -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Acerca de Nosotros</h3>
            <p>Somos el grupo "los chimpokomones" de la materia Web 3 que imparte el Ph.D. Alan Corini</p>
            <ul class="footer-links">
              <li><a href="#"><i class="fa fa-map-marker"></i>UMSA Carrera De Informatica</a></li>
              <li><a href="#"><i class="fa fa-phone"></i>+591 77255076</a></li>
              <li><a href="#"><i class="fa fa-envelope-o"></i>LaCase@gmail.com</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Categorias</h3>
            <ul class="footer-links">
              <?php foreach ($records_cat as  $rowc) : ?>
                <li><a href="#"><?php echo htmlspecialchars($rowc['nombreC']);?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>

        <div class="clearfix visible-xs"></div>

        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Informacion</h3>
            <ul class="footer-links">
              <li><a href="#">Acerca de Nosotros</a></li>
              <li><a href="#">Contactanos</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Orders and Returns</a></li>
              <li><a href="#">Terms & Conditions</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Servicios</h3>
            <ul class="footer-links">
              <li><a href="#">My Account</a></li>
              <li><a href="#">View Cart</a></li>
              <li><a href="#">Wishlist</a></li>
              <li><a href="#">Track My Order</a></li>
              <li><a href="#">Help</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /top footer -->

  <!-- bottom footer -->
  <div id="bottom-footer" class="section">
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-12 text-center">
          <ul class="footer-payments">
            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
          </ul>
          <span class="copyright">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </span>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="<?php echo URL_RESOURCES; ?>js/jquery.min.js"></script>
<script src="<?php echo URL_RESOURCES; ?>js/bootstrap.min.js"></script>
<script src="<?php echo URL_RESOURCES; ?>js/slick.min.js"></script>
<script src="<?php echo URL_RESOURCES; ?>js/nouislider.min.js"></script>
<script src="<?php echo URL_RESOURCES; ?>js/jquery.zoom.min.js"></script>
<script src="<?php echo URL_RESOURCES; ?>js/main.js"></script>

</body>

</html>