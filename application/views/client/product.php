<style type="text/css">
  .product{
    background: #FFFFFF;
    box-shadow: 0 0 0px #333;
    margin: 5px;
    width: 345px;
    height: 202px;
    overflow: hidden;
    box-shadow: 0 0 3px #999;
    transition: box-shadow 200ms ease;
    background-size: cover;
  }
  .product:hover{
    box-shadow: 0 0 5px #333;
  }
  .judul{
    margin-top: 0px;
    margin-bottom: 0px;
    font-weight: bold;
  }
  .detail{
    width: 100%;
    padding: 5px;
    margin-top: 170px;
    height: 110px;
    background-color: rgb(256, 256, 256, 0.5);
    transition: margin-top 200ms ease;
  }
  .product:hover .detail{
    width: 100%;
    padding: 5px;
    margin-top: 110px;
    height: 110px;
    background-color: rgb(256, 256, 256, 0.8);
  }
  .product_nav_link{
    text-decoration: none;
    color: #666;
  }
  .product_nav_link:hover{
    text-decoration: none;
    color: #333;
  }
</style>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo $title ?></h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<div class="row">
  <?php foreach ($product as $key => $value): ?>
  <a class="product_nav_link" href="<?= base_url('product/detail/') . $value['id'] ?>">
    <div class="product" style="background-image: url('<?= base_url() ?>assets/dist/img/photo2.png');">
      <div class="position-relative">
        <div class="ribbon-wrapper ribbon-lg">
          <?php if ( !empty( $value['ribbon_caption'] ) ): ?>
           <div class="ribbon bg-warning text-lg">
             <?php echo $value['ribbon_caption'] ?>
           </div> 
          <?php endif ?>
        </div>
      </div>

      <div class="detail">
        <p class="judul"><?php echo $value['title'] ?></p>
        <p class="deskripsi"><?php echo $value['description'] ?></p>
      </div>
    </div>
  </a>
  <?php endforeach ?>
</div>