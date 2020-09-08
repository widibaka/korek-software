<!DOCTYPE html>
<!-- saved from url=(0053) -->
<html lang="en"><link type="text/css" rel="stylesheet" id="dark-mode-general-link"><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"><style type="text/css" id="dark-mode-custom-style"></style><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title><?php echo $title ?></title>

    <link rel="canonical" href="">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/offcanvas.css" rel="stylesheet">

    <style type="text/css">
      @-webkit-keyframes glow {
          to {
          -webkit-box-shadow: 0 0 15px #eb4034;
             -moz-box-shadow: 0 0 15px #eb4034;
                  box-shadow: 0 0 15px #eb4034;
          }
      }

      .myGlower {
          z-index: 999;
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
    </style>
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
      <a class="navbar-brand" href="#"><?php echo $title ?></a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url('jadwal/') ?>">Ringkas</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Lengkap</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search makul" aria-label="Search" id="myInput" onkeyup="myFunction()">
        </form>
      </div>
    </nav>

    <div class="nav-scroller bg-white box-shadow">
      <nav class="nav nav-underline">
      </nav>
    </div>

    <main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-z2 rounded box-shadow">
        <img class="mr-3" src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/icon.png" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">18 TIA3</h6>
          <small>Since 2018</small>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Jadwal lengkap</h6>



        <table class="table table-bordered text-secondary">
          <thead>
            <tr>
              <th scope="col">Hari</th>
              <th scope="col">Jam</th>
              <th scope="col">Mata Kuliah</th>
              <th scope="col">SKS</th>
              <th scope="col">Sifat</th>
              <th scope="col">Dosen</th>
              <th scope="col">Ruang</th>
            </tr>
          </thead>
          <tbody id="myTB">
            <?php foreach ($jadwal as $key => $value): ?>
              
              <tr class="<?php echo $value['nyala'] ?>">
                <td><?php echo $value['hari'] ?></td>
                <td><?php echo substr($value['jam_mulai'], 0, -3) . ' s.d ' . substr($value['jam_selesai'], 0, -3) ?></td>
                <td><?php echo $value['mata_kuliah'] ?></td>
                <td><?php echo $value['sks'] ?></td>
                <td><?php echo $value['sifat'] ?></td>
                <td><?php echo $value['dosen'] ?></td>
                <td><?php echo $value['ruang'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <div class="text-muted">
          <small>Makul akan menyala saat memasuki jam kuliah</small>
        </div>



      </div>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/jquery-3.2.1.slim.min.js.download" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/popper.min.js.download"></script>
    <script src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/bootstrap.min.js.download"></script>
    <script src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/holder.min.js.download"></script>
    <script src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/offcanvas.js.download"></script>
  
    <script type="text/javascript">
      function myFunction() {
          var input, filter, tb, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          tb = document.getElementById("myTB");
          tr = tb.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
              td = tr[i].getElementsByTagName("td")[2];
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
              } else {
                  tr[i].style.display = "none";
              }
          }
      }
    </script>
<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="2" style="font-weight:bold;font-size:2pt;font-family:Arial, Helvetica, Open Sans, sans-serif">32x32</text></svg></body></html>