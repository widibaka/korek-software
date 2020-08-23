
      </div><!-- /.container-fluid -->
    </section>


    



  </div>
    <!-- /.content -->
  <footer class="main-footer">
   <!--  <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div> -->
    <strong>Korek Software 2020 - <?php echo date("Y") ?> 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url() ?>assets/dist/js/demo.js"></script> -->
<!-- Sweet Alert 2 plugin -->
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.js"></script>
<script type="text/javascript">
    
    function mark_as_read() {
        <?php 
            $host = $_SERVER['HTTP_HOST'];
            $redirect = str_replace("/", "garing", $host . $_SERVER['PHP_SELF']);
        ?>
        window.location.href = "<?= base_url() . "auth/mark_as_read/" . $user['user_id'] . "/" . $redirect ?>"
    }

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
