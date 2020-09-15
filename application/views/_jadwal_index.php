<!DOCTYPE html>
<!-- saved from url=(0053) -->
<html lang="en"><link type="text/css" rel="stylesheet" id="dark-mode-general-link"><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"><style type="text/css" id="dark-mode-custom-style"></style><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=0.8, shrink-to-fit=no">
    <meta name="description" content="Jadwal yang enggak bikin mata pedih">
    <meta name="author" content="widibaka">
    <link rel="icon" href="<?= base_url("assets/_jadwal/Offcanvas_files/icon.png?ver1.1") ?>">
    <!-- S:fb meta -->
    <meta property="og:type" content="software" />
    <meta property="og:image" content="<?= base_url('assets/_jadwal/Offcanvas_files/'.$icon) ?>" />
    <meta property="og:title" content="<?php echo $title ?>" />
    <meta property="og:description" content="Jadwal yang enggak bikin mata pedih">
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:site_name" content="Koreksoft" />
    <!-- e:fb meta -->

    <title><?php echo $title ?></title>

    <link rel="canonical" href="">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/offcanvas.css" rel="stylesheet">

    <style type="text/css">
      @-webkit-keyframes glow {
          to {
          background-color: #ffdbe0;
          border-left: 5px solid #456dff;
          border-right: 2px solid #32a840;
          }
      }

      .myGlower {
          z-index: -1;
          -webkit-animation: glow 500ms infinite alternate;  
           -webkit-transition: border 1.0s linear, box-shadow 1.0s linear;
             -moz-transition: border 1.0s linear, box-shadow 1.0s linear;
                  transition: border 1.0s linear, box-shadow 1.0s linear;
      }

      .border-kiri {
          border-left: 5px solid #ff7083;
      }
      .bg-z2 {
          background-color: #ff7083;
      }
      .bg-abu-abu{
          background-color: #eee;
      }
      .loader{
          padding-top: 2px;
          padding-bottom: 5px;
      }
    </style>
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
      <a class="navbar-brand" href="<?= base_url('jadwal') ?>"><?php echo $title ?></a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="offcanvas">Pilih jurusan dulu!</a>
          </li>
          <li class="nav-item">
            
          </li>
        </ul>
      </div>
    </nav>

    <div class="nav-scroller bg-white box-shadow">
      <nav class="nav nav-underline">
      </nav>
    </div>

    <main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-z2 rounded box-shadow">
        <img class="mr-3" src="<?= base_url('assets/_jadwal/Offcanvas_files/'.$icon) ?>" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">Pilih jurusan kamu</h6>
          <small></small>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">

        <ul class="list-group" id="daftar_kelas">
          <?php foreach ($jurusan as $key => $value): ?>
            
            <a class="mb-2" href="<?php echo base_url('jadwal/jurusan/') . $value ?>"><li class="font-weight-bold text-center btn btn-success" style="width: 100%"><?php echo $value ?></li></a>

          <?php endforeach ?>
          <p class="text-center text-muted">atau</p>
            <a class="mb-2" href="<?php echo base_url('jadwal/dosen_index') ?>"><li class="font-weight-bold text-center btn btn-success" style="width: 100%">DOSEN</li></a>
            <a class="mb-2" href="<?php echo base_url('jadwal/ruangan_index') ?>"><li class="font-weight-bold text-center btn btn-success" style="width: 100%">RUANGAN</li></a>
            <a class="mb-2" href="<?php echo base_url() . 'jadwal_18a3' ?>"><li class="font-weight-bold text-center btn btn-success" style="width: 100%">[ Khusus TI18A3 ]</li></a>
            <a class="mt-5 text-right" href="https://github.com/widibaka/jadwal-fikom-udb"><i>Github</i></a>
            <a class="text-right" href="https://wa.me/+6281226203761"><i>WA Admin 081226203761</i></a>
        </ul>



      </div>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/holder.min.js.download"></script>
    <script src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/offcanvas.js.download"></script>

    <script type="text/javascript">
      function myFunction() {
          var input, filter, ul, a, li, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          ul = document.getElementById("daftar_kelas");
          a = ul.getElementsByTagName("a");
          for (i = 0; i < a.length; i++) {
              li = a[i].getElementsByTagName("li")[0];
              txtValue = li.textContent || li.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  a[i].style.display = "";
              } else {
                  a[i].style.display = "none";
              }
          }
      }
    </script>
  

<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="2" style="font-weight:bold;font-size:2pt;font-family:Arial, Helvetica, Open Sans, sans-serif">32x32</text></svg></body></html>