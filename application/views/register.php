<?php 
 $website = $this->KoreksoftModel->getWebsiteDetail();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $website['website_title'] ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?= base_url('assets/koreksoft/') ?>img/logo.png" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    body::after {
      content: "";
      background-image: url('<?php echo base_url() . "assets/landing/images/diagoona-bg-3.jpg" ?>');
      background-size: cover;
      opacity: 1;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      position: absolute;
      z-index: -1;   
    }
    .kotak{
      box-shadow: 0 0 3px #555;
      border-radius: 1px;
      background-color: rgb(255, 255, 255, 1);
    }
  </style>
</head>
<body class="hold-transition login-page">
<?php echo $this->session->flashdata("alert"); ?>
<div class="login-box" style="background-color: rgb(255, 255, 255, 0.2);">
  <div class="login-logo kotak">
    <a href="<?php echo base_url() ?>"><b><?php echo $website['website_name'] ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Register a new membership</p>

            <form action="" method="post">
              <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" placeholder="Full name" autocomplete="off" required="required" >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required="required" minlength="8">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required="required" minlength="8">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password2" class="form-control" placeholder="Retype password" autocomplete="off" required="required" minlength="8">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree" required="">
                    <label for="agreeTerms">
                     I agree to the <a href="<?php echo base_url('services/syarat_ketentuan') ?>">terms</a>
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="login" class="btn btn-block btn-default">
          <i class="fab fa-google mr-2"></i> Sign in using Google
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-0">
        <a href="login" class="text-center">login instead</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url() . 'assets/' ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() . 'assets/' ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() . 'assets/' ?>dist/js/adminlte.min.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.js"></script>

<script type="text/javascript">
    
    // membuat alert yang ada danger,warning,dan success
    
    var isi_alert = $('.alert').html()

    function alert_danger(){
        swal.fire({
            // title: "Peringatan!",
            text: isi_alert,
            buttonsStyling: false,
            confirmButtonClass: "btn btn-primary",
            icon: "error"
        });
    }

    function alert_success(){
        swal.fire({
            // title: "Bagus!",
            text: isi_alert,
            buttonsStyling: false,
            confirmButtonClass: "btn btn-primary",
            icon: "success"
        });
    }
    
    function alert_warning(){
        swal.fire({
            text: isi_alert,
            icon: 'warning',
            showCancelButton: false,
            confirmButtonClass: "btn btn-primary",
        })
    }
    
    function alert_info(){
        swal.fire({
            text: isi_alert,
            icon: 'info',
            showCancelButton: false,
            confirmButtonClass: "btn btn-primary",
        })
    }

    function alert_basic(){
        swal.fire({
            text: isi_alert,
            buttonsStyling: false,
            confirmButtonClass: "btn btn-primary"
        })
    }
    if ( $('.alert').length > 0 ) {
        // menentukan jenis alert lewat deteksi class yang ada
        if ($('.alert').hasClass('alert-danger')) {
            alert_danger();
        }
        else if ($('.alert').hasClass('alert-success')) {
            alert_success();            
        }
        else if ($('.alert').hasClass('alert-warning')) {
            alert_warning();            
        }
        else if ($('.alert').hasClass('alert-info')) {
            alert_info();            
        }
        else {
            alert_basic();
        }
    }

</script>

</body>
</html>
