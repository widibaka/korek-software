<?php $website = $this->KoreksoftModel->getWebsiteDetail() ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <!-- 
      Boxer Template
      http://www.templatemo.com/tm-446-boxer
      -->
    <meta charset="utf-8">
    <title><?= $website['website_title'] ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Snippet, Plugin, Source-code">
    <meta name="description" content="<?= $website['website_description'] ?>">


    <!-- S:fb meta -->
    <meta property="og:type" content="software" />
    <meta property="og:image" content="<?= base_url("assets/koreksoft/img/logo.jpg?ver1.1") ?>" />
    <meta property="og:title" content="<?= $website['website_title'] ?>" />
    <meta property="og:description" content="<?= $website['website_description'] ?>">
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:site_name" content="<?= $website['website_name'] ?>" />
    <!-- e:fb meta -->

    <!-- S:tweeter card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@korek_software" />
    <meta name="twitter:creator" content="@korek_software">
    <meta name="twitter:title" content="<?= $website['website_title'] ?>" />
    <meta name="twitter:description" content="<?= $website['website_description'] ?>" />
    <meta name="twitter:image" content="<?= base_url("assets/koreksoft/img/logo.png?ver1") ?>" />
    <!-- E:tweeter card -->

    <link rel="icon" type="image/png" href="<?= base_url('assets/koreksoft/') ?>img/logo.png" />
    <!-- animate css -->
    <link rel="stylesheet" href="<?= base_url("assets/landing/"); ?>css/animate.min.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?= base_url("assets/landing/"); ?>css/bootstrap.min.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="<?= base_url("assets/landing/"); ?>css/font-awesome.min.css">
    <!-- google font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,800' rel='stylesheet' type='text/css'>

    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url("assets/landing/"); ?>css/templatemo-style.css">

  </head>
  <body>
    <!-- start preloader -->
    <div class="preloader"style="display: none;">
      <div class="sk-spinner sk-spinner-rotating-plane"></div>
    </div>
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon icon-bar"></span>
            <span class="icon icon-bar"></span>
            <span class="icon icon-bar"></span>
          </button>
          <a href="<?= base_url(); ?>#" class="navbar-brand"><?= $website['website_name'] ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right text-uppercase">
            <li><a href="<?= base_url("assets/landing/"); ?>#home">Home</a></li>
            <li><a href="<?= base_url("assets/landing/"); ?>#download">Products</a></li>
            <li><a href="<?= base_url("assets/landing/"); ?>#contact">Contact</a></li>
            <?php if ( $this->session->userdata("email") ): ?>
              <li><a class="link" href="<?= base_url("order"); ?>"><?php 

              echo substr($user['username'], 0, 5) ?><?php if ( strlen($user['username']) > 5 ) {
                echo "...";
              } ?></a></li>
            <?php else: ?>
              <li><a class="link" href="<?= base_url("auth/login"); ?>">Login</a></li>
              <li><a class="link" href="<?= base_url("auth/register"); ?>">Register</a></li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navigation -->
    <!-- start home -->
    <section id="home" style="background: url('<?php echo base_url() . "assets/landing/" ?>images/new-bg.jpg') no-repeat; background-size: cover;">
      <div class="overlay">
        <div class="container">
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 wow fadeIn" data-wow-delay="0.3s">
              <h1 class="text-upper"><?= $website['website_name'] ?></h1>
              <p class="tm-white"><?= $website['website_description'] ?></p>
              <img src="<?= base_url("assets/landing/"); ?>images/software-img.png" class="img-responsive" alt="home img">
            </div>
            <div class="col-md-1"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- end home -->

    <?php foreach ($product as $key => $pd): ?>
      
    <!-- start download -->
    <section id="download">
      <div class="container">
        <div class="row">
          <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.6s">
            <h2 class="text-uppercase"><?php echo $pd['title'] ?></h2>
            <p><?php echo $pd['description'] ?> </p>
            <a href="<?php echo base_url("product/detail/" . $pd['id']) ?>" class="btn btn-primary text-uppercase">Download</a>
          </div>
          <div class="col-md-6 wow fadeInRight" data-wow-delay="0.6s">
            <img src="<?= base_url("assets/"); ?>koreksoft/product/<?php echo explode("; ", $pd['image'])[0] ?>" class="img-responsive" alt="feature img">
          </div>
        </div>
      </div>
    </section>
    <!-- end download -->

    <?php endforeach ?>

    <!-- start contact -->
    <section id="contact">
      <div class="overlay">
        <div class="container">
          <div class="row">
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
              <h2 class="text-uppercase">Kontak</h2>
              <address>
                <p><i class="fa fa-envelope-o"></i> widibaka55@gmail.com</p>
              </address>
            </div>
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
              <h2 class="text-uppercase">About</h2>
              <address>
                <p><i class="fa fa-book"></i> <a href="<?php echo base_url('services/syarat_ketentuan') ?>" style="color: #FFFFFF; ">Syarat & Ketentuan</a></p>
              </address>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end contact -->

    <!-- start footer -->
    <footer>
      <div class="container">
        <div class="row">
          <p>© 2020 - <?php echo date("Y") . " " . $website['website_name']; ?></p>
        </div>
      </div>
    </footer>
    <!-- end footer -->
        
    <script src="<?= base_url("assets/landing/"); ?>js/jquery.js"></script>
    <script src="<?= base_url("assets/landing/"); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url("assets/landing/"); ?>js/wow.min.js"></script>
    <script src="<?= base_url("assets/landing/"); ?>js/jquery.singlePageNav.min.js"></script>
    <script src="<?= base_url("assets/landing/"); ?>js/custom.js"></script>

    <script type="text/javascript">
      $(".link").click(function() {
        window.location.href = $(this).attr("href");
      });
    </script>
  </body>
</html>