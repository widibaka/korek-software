<!DOCTYPE html>
<!-- saved from url=(0053) -->
<html lang="en"><link type="text/css" rel="stylesheet" id="dark-mode-general-link"><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"><style type="text/css" id="dark-mode-custom-style"></style><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=0.8, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url('assets/_jadwal/Offcanvas_files/'.$icon) ?>">

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
            <a class="nav-link" href="<?php echo base_url('jadwal/') ?>">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $hari_saat_ini ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php foreach ($hari[0] as $key => $value): ?>
                <a class="dropdown-item" href="<?php echo base_url('jadwal/ruangan/') . $hari[1][$key] . '/' . $ruangan_saat_ini ?>"><?php echo $value ?></a>
              <?php endforeach ?>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo base64_decode(str_replace('garis_miring', '/', $ruangan_saat_ini)); ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php foreach ($ruangan as $key => $value): ?>
                <a class="dropdown-item" href="<?php echo base_url('jadwal/ruangan/') . $index_hari_saat_ini . '/' . str_replace('/', 'garis_miring', base64_encode($value)) ?>"><?php echo $value ?></a>
              <?php endforeach ?>
            </div>
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
          <h6 class="mb-0 text-white lh-100"><?php 
                echo "Ganti hari dan ruang pakai menu dropdown di atas ya.";
           ?></h6>
          <small></small>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">



        <table class="table table-bordered text-secondary" id="tabel-jadwal">
          <div class="text-center loader bg-abu-abu">
            <img src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/ajax-loader.gif">
          </div>
        </table>
        <div class="text-muted">
          <small>Makul akan menyala 15 menit sebelum memasuki jam kuliah</small>
        </div>



      </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Detail </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>
                <th>Hari </th>
                <td id="mo_hari"></td>
              </tr>
              <tr>
                <th>Jam </th>
                <td id="mo_jam"></td>
              </tr>
              <tr>
                <th>Mata kuliah </th>
                <td id="mo_mata_kuliah"></td>
              </tr>
              <tr>
                <th>SKS </th>
                <td id="mo_sks"></td>
              </tr>
              <tr>
                <th>Sifat </th>
                <td id="mo_sifat"></td>
              </tr>
              <tr>
                <th>Kelas </th>
                <td id="mo_kelas"></td>
              </tr>
              <tr>
                <th>Dosen </th>
                <td id="mo_dosen"></td>
              </tr>
              <tr>
                <th>Ruang </th>
                <td id="mo_ruang"></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/holder.min.js.download"></script>
    <script src="<?= base_url('assets/_jadwal') ?>/Offcanvas_files/offcanvas.js.download"></script>

    <script type="text/javascript">
      var index_hari_saat_ini = '<?php echo $index_hari_saat_ini ?>';
      var ruangan_saat_ini = '<?php echo $ruangan_saat_ini ?>';
      function load_data() {
        $.get("<?= base_url() ?>jadwal/get_jadwal_ruangan/"+index_hari_saat_ini+"/"+ruangan_saat_ini, function(data) {
          $("#tabel-jadwal").html(data);
          $(".loader").hide();
        });
      }
      function show_modal(id) {
        let hari = $('#tr-'+id+' .hari').html();
        let jam = $('#tr-'+id+' .jam').html();
        let dosen = $('#tr-'+id+' .dosen').html();
        let mata_kuliah = $('#tr-'+id+' .mata_kuliah').html();
        let sks = $('#tr-'+id+' .sks').html();
        let sifat = $('#tr-'+id+' .sifat').html();
        let kelas = $('#tr-'+id+' .kelas').html();
        let ruang = $('#tr-'+id+' .ruang').html();
        $("#mo_hari").html(hari);
        $("#mo_jam").html(jam);
        $("#mo_mata_kuliah").html(mata_kuliah);
        $("#mo_dosen").html(dosen);
        $("#mo_sks").html(sks);
        $("#mo_sifat").html(sifat);
        $("#mo_kelas").html(kelas);
        $("#mo_ruang").html(ruang);
      }
      setInterval(function() {
        load_data();
      }, 2000)
    </script>
  

<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="2" style="font-weight:bold;font-size:2pt;font-family:Arial, Helvetica, Open Sans, sans-serif">32x32</text></svg></body></html>