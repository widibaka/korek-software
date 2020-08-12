<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Product Detail</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">

  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3 class="d-inline-block d-sm-none"><?php echo $product['title'] ?></h3>
          <div class="col-12 product-image-thumbs">
            <div class="product-image-thumb"><img src="<?= base_url() . "assets/" ?>dist/img/prod-1.jpg" alt="Product Image"></div>
            <div class="product-image-thumb active"><img src="<?= base_url() . "assets/" ?>dist/img/prod-2.jpg" alt="Product Image"></div>
            <div class="product-image-thumb"><img src="<?= base_url() . "assets/" ?>dist/img/prod-3.jpg" alt="Product Image"></div>
            <div class="product-image-thumb"><img src="<?= base_url() . "assets/" ?>dist/img/prod-4.jpg" alt="Product Image"></div>
            <div class="product-image-thumb"><img src="<?= base_url() . "assets/" ?>dist/img/prod-5.jpg" alt="Product Image"></div>
          </div>
          <div class="col-12">
            <img src="<?= base_url() . "assets/" ?>dist/img/prod-2.jpg" class="product-image" alt="Product Image">
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <h3 class="my-3"><?php echo $product['title'] ?></h3>
          <p><?php echo $product['description'] ?></p>

          <hr>

          <h4 class="mt-3">Size <small>Please select one</small></h4>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">



            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">Nadia Carmichael</h3>
                <h5 class="widget-user-desc">Lead Developer</h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Projects <span class="float-right badge bg-primary">31</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Tasks <span class="float-right badge bg-info">5</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Completed Projects <span class="float-right badge bg-success">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Followers <span class="float-right badge bg-danger">842</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>




            <label class="btn btn-default text-center">
              <input type="radio" name="color_option" id="color_option1" autocomplete="off">
              <span class="text-xl">S</span>
              <br>
              Small
            </label>
            <label class="btn btn-default text-center active">
              <input type="radio" name="color_option" id="color_option1" autocomplete="off">
              <span class="text-xl">M</span>
              <br>
              Medium
            </label>
            <label class="btn btn-default text-center">
              <input type="radio" name="color_option" id="color_option1" autocomplete="off">
              <span class="text-xl">L</span>
              <br>
              Large
            </label>
            <label class="btn btn-default text-center">
              <input type="radio" name="color_option" id="color_option1" autocomplete="off">
              <span class="text-xl">XL</span>
              <br>
              Xtra-Large
            </label>
          </div>

          <div class="bg-gray py-2 px-3 mt-4">
            <h2 class="mb-0">
              $80.00
            </h2>
            <h4 class="mt-0">
              <small>Ex Tax: $80.00 </small>
            </h4>
          </div>

          <div class="mt-4">
            <div class="btn btn-primary btn-lg btn-flat">
              <i class="fas fa-cart-plus fa-lg mr-2"></i> 
              Add to Cart
            </div>

            <div class="btn btn-default btn-lg btn-flat">
              <i class="fas fa-heart fa-lg mr-2"></i> 
              Add to Wishlist
            </div>
          </div>

          <div class="mt-4 product-share">
            <a href="#" class="text-gray">
              <i class="fab fa-facebook-square fa-2x"></i>
            </a>
            <a href="#" class="text-gray">
              <i class="fab fa-twitter-square fa-2x"></i>
            </a>
            <a href="#" class="text-gray">
              <i class="fas fa-envelope-square fa-2x"></i>
            </a>
            <a href="#" class="text-gray">
              <i class="fas fa-rss-square fa-2x"></i>
            </a>
          </div>

        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>