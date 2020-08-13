
<!-- DataTables -->
<script src="<?php echo base_url("assets/") ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets/") ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url("assets/") ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#order_table").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>