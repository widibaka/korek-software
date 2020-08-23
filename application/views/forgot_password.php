
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Korek Software - Forgot Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="<?= base_url('assets/koreksoft/') ?>img/logo.png" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/' ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<?php echo $this->session->flashdata("alert"); ?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url()?>">Korek Software</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve your password.</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Send password to my email</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login">Login</a>
      </p>
      <p class="mb-0">
        <a href="register" class="text-center">Register a new membership</a>
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
