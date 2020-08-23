
<!-- DataTables -->
<script src="<?php echo base_url("assets/") ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets/") ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url("assets/") ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#order_table").DataTable();
  });

  function show_modal(plan_id, order_id) {
  	// reset image preview
  	var input_img = document.getElementById('input_img');
    var preview = $('#image-prev-in-modal');
  	input_img.value = null;
  	preview.hide();
  	// data to be sent
  	var user_id = '<?php echo $user['user_id'] ?>';
  	$("#plan_id").val(plan_id);
  	$("#user_id").val(user_id);
  	$("#order_id").val(order_id);
  }

  var loadFile = function(event) {
  	// show image preview
  	$("#image-prev-in-modal").show();
    var preview = document.getElementById('image-prev-in-modal');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.onload = function() {
      URL.revokeObjectURL(preview.src) // free memory
    }
  };

  function show_code(id) {
    var code = $("#code-"+id).html();
    var request_remains = $("#remaining-request-"+id).html();
    $("#code-modal").val(code);
    $("#request_remains").html("Request remaining: "+request_remains);
    
  }

  var loadFile = function(event) {
    // show image preview
    $("#image-prev-in-modal").show();
    var preview = document.getElementById('image-prev-in-modal');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.onload = function() {
      URL.revokeObjectURL(preview.src) // free memory
    }
  };

</script>