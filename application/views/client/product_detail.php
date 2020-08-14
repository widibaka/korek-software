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
          <?php  $images = explode("; ", $product['image']);  ?>
          <div class="col-12 product-image-thumbs">
            <?php foreach ($images as $key0 => $value0): ?>
            <div class="product-image-thumb"><img src="<?= base_url() . "assets/" ?>koreksoft/product/<?= $value0 ?>" alt="Product Image"></div>
            <?php endforeach ?>
          </div>
          <div class="col-12">
            <img src="<?= base_url() . "assets/" ?>koreksoft/product/<?= $images[0] ?>" class="product-image" alt="Product Image">
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <h3 class="my-3"><?php echo $product['title'] ?></h3>
          <p><?php echo $product['description'] ?></p>

          <hr>

          <a href="<?= $product['link_download'] ?>" target="_blank">
            <div class="btn btn-primary btn-lg btn-flat" style="width: 100%">
              <i class="fas fa-download fa-lg mr-2"></i>
              Download
            </div>
          </a>

          <a href="<?= $product['user_docs'] ?>" target="_blank">
            <div class="mt-3 btn btn-primary btn-lg btn-flat" style="width: 100%">
              <i class="fas fa-book fa-lg mr-2"></i> 
              User Documentation
            </div>
          </a>
          <p class="mt-4 mb-0">Share:</p>
          <div class="mt-1 product-share">
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
      <hr>
      <div class="row mt-4" style="margin: auto;">
      <?php foreach ($product_plan as $key => $value): ?>
        <div class="col-md-4">
          <div class="card card-widget widget-user-2 ml-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-<?= $value['color'] ?>">
              <h5><strong><?php echo $value['plan_title'] ?></strong></h5>
            </div>
            <div class="card-footer p-0">
              <ul class="nav flex-column">
                <?php 
                  $feature = explode("; ", $value['feature']);
                ?>
                <?php foreach ($feature as $key1 => $value1): ?>
                  <li class="nav-item">
                    <span class="nav-link">
                      <?php echo $value1 ?>
                    </span>
                  </li>
                  
                <?php endforeach ?>
                <?php if ( $value['price'] != "0" ): ?>
                  <li class="nav-item">
                    <span class="nav-link">
                      <?php echo $value['price'] ?>
                    </span>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("product/make_order/") . $value['id'] . "/order/" ?>" class="nav-link btn btn-success">
                      <i class="fas fa-cart-plus mr-2"></i> Beli (Purchase)
                    </a>
                  </li>
                <?php endif ?>
              </ul>
            </div>
          </div>
        </div>
        
      <?php endforeach ?>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>