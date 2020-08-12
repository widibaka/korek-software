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
    <meta property="og:image" content="<?= base_url("assets/koreksoft/img/logo.jpg?ver1") ?>" />
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
    <meta name="twitter:image" content="<?= base_url("assets/koreksoft/img/logo.jpg?ver1") ?>" />
    <!-- E:tweeter card -->

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
          <a href="<?= base_url("assets/landing/"); ?>#" class="navbar-brand"><?= $website['website_name'] ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right text-uppercase">
            <li><a href="<?= base_url("assets/landing/"); ?>#home">Home</a></li>
            <li><a href="<?= base_url("assets/landing/"); ?>#feature">Features</a></li>
            <li><a href="<?= base_url("assets/landing/"); ?>#pricing">Pricing</a></li>
            <li><a href="<?= base_url("assets/landing/"); ?>#download">Download</a></li>
            <li><a href="<?= base_url("assets/landing/"); ?>#contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navigation -->
    <!-- start home -->
    <section id="home">
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
    <!-- start divider -->
    <section id="divider">
      <div class="container">
        <div class="row">
          <div class="col-md-4 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
            <i class="fa fa-laptop"></i>
            <h3 class="text-uppercase">RESPONSIVE LAYOUT</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
          </div>
          <div class="col-md-4 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
            <i class="fa fa-twitter"></i>
            <h3 class="text-uppercase">BOOTSTRAP 3.3.4</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
          </div>
          <div class="col-md-4 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
            <i class="fa fa-font"></i>
            <h3 class="text-uppercase">GOOGLE FONT</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
          </div>
        </div>
      </div>
    </section>
    <!-- end divider -->

    <!-- start feature -->
    <section id="feature">
      <div class="container">
        <div class="row">
          <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.6s">
            <h2 class="text-uppercase">Our Software Features</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p><span><i class="fa fa-mobile"></i></span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p><i class="fa fa-code"></i>Quis autem velis reprehenderit et quis voluptate velit esse quam.</p>
          </div>
          <div class="col-md-6 wow fadeInRight" data-wow-delay="0.6s">
            <img src="<?= base_url("assets/landing/"); ?>images/software-img.png" class="img-responsive" alt="feature img">
          </div>
        </div>
      </div>
    </section>
    <!-- end feature -->

    <!-- start feature1 -->
    <section id="feature1">
      <div class="container">
        <div class="row">
          <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
            <img src="<?= base_url("assets/landing/"); ?>images/software-img.png" class="img-responsive" alt="feature img">
          </div>
          <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
            <h2 class="text-uppercase">More of Your Software</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p><span><i class="fa fa-mobile"></i></span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p><i class="fa fa-code"></i>Quis autem velis reprehenderit et quis voluptate velit esse quam.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- end feature1 -->

    <!-- start pricing -->
    <section id="pricing">
      <div class="container">
        <div class="row">
          <div class="col-md-12 wow bounceIn">
            <h2 class="text-uppercase">Our Pricing</h2>
          </div>
          <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
            <div class="pricing text-uppercase">
              <div class="pricing-title">
                <h4>Basic Plan</h4>
                <p>$11</p>
                <small class="text-lowercase">monthly</small>
              </div>
              <ul>
                <li>6 GB Space</li>
                <li>600 GB Bandwidth</li>
                <li>60 More Themes</li>
                <li>Lifetime Support</li>
              </ul>
              <button class="btn btn-primary text-uppercase">Sign up</button>
            </div>
          </div>
          <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
            <div class="pricing active text-uppercase">
              <div class="pricing-title">
                <h4>Business Plan</h4>
                <p>$22</p>
                <small class="text-lowercase">monthly</small>
              </div>
              <ul>
                <li>15 GB space</li>
                <li>1,500 GB Bandwidth</li>
                <li>150 More Themes</li>
                <li>Lifetime Support</li>
              </ul>
              <button class="btn btn-primary text-uppercase">Sign up</button>
            </div>
          </div>
          <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
            <div class="pricing text-uppercase">
              <div class="pricing-title">
                <h4>Pro Plan</h4>
                <p>$33</p>
                <small class="text-lowercase">monthly</small>
              </div>
              <ul>
                <li>35 GB space</li>
                <li>3,500 GB bandwidth</li>
                <li>350 more themes</li>
                <li>Lifetime Support</li>
              </ul>
              <button class="btn btn-primary text-uppercase">Sign Up</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end pricing -->

    <!-- start download -->
    <section id="download">
      <div class="container">
        <div class="row">
          <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.6s">
            <h2 class="text-uppercase">Download Our Software</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
            <button class="btn btn-primary text-uppercase"><i class="fa fa-download"></i> Download</button>
          </div>
          <div class="col-md-6 wow fadeInRight" data-wow-delay="0.6s">
            <img src="<?= base_url("assets/landing/"); ?>images/software-img.png" class="img-responsive" alt="feature img">
          </div>
        </div>
      </div>
    </section>
    <!-- end download -->

    <!-- start contact -->
    <section id="contact">
      <div class="overlay">
        <div class="container">
          <div class="row">
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
              <h2 class="text-uppercase">Contact Us</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
              <address>
                <p><i class="fa fa-map-marker"></i>36 Street Name, City Name, United States</p>
                <p><i class="fa fa-phone"></i> 010-010-0110 or 020-020-0220</p>
                <p><i class="fa fa-envelope-o"></i> info@company.com</p>
              </address>
            </div>
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
              <div class="contact-form">
                <form action="#" method="post">
                  <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Name">
                  </div>
                  <div class="col-md-6">
                    <input type="email" class="form-control" placeholder="Email">
                  </div>
                  <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Subject">
                  </div>
                  <div class="col-md-12">
                    <textarea class="form-control" placeholder="Message" rows="4"></textarea>
                  </div>
                  <div class="col-md-8">
                    <input type="submit" class="form-control text-uppercase" value="Send">
                  </div>
                </form>
              </div>
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
          <p>Copyright © 2084 Your Company Name</p>
        </div>
      </div>
    </footer>
    <!-- end footer -->
        
    <script src="<?= base_url("assets/landing/"); ?>js/jquery.js"></script>
    <script src="<?= base_url("assets/landing/"); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url("assets/landing/"); ?>js/wow.min.js"></script>
    <script src="<?= base_url("assets/landing/"); ?>js/jquery.singlePageNav.min.js"></script>
    <script src="<?= base_url("assets/landing/"); ?>js/custom.js"></script>
  </body>
</html>