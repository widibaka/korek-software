<script type="text/javascript">
	
	$(".small-image").click(function() {
		var link = $(this).attr("src");
		$("#big-image").attr("src", link);
	})

	function hitung_tagihan() {
		var amount = $("#amount").val();
		if ( amount > 4 ) { alert("Sorry, 4 at max. Please input number lower than 4."); $("#amount").val("1") }
		var rupiah_price = $("#rupiah_price").html();
		var dollar_price = $("#dollar_price").html();
		var in_period = $("#in_period").html();

		//hitung
		var total_rp = rupiah_price * amount;
		var total_d = dollar_price * amount;
		var total_mo = in_period * amount;

		var text = "Rp "+total_rp+" or "+"$ "+total_d+" / "+total_mo+" month";

		$("#total").html(text);
	}

	function purchase(plan_id) {
		var in_period = $("#in_period").html();
		var amount = $("#amount").val();
		var purchase_link = '<?php echo base_url("product/make_order/") ?>'+plan_id+'/order/'+amount+'/'+in_period;
		window.location.href = purchase_link;
	}

	function purchase_free(plan_id) {
		var purchase_link = '<?php echo base_url("product/make_order/") ?>'+plan_id+'/order/0/0';
		window.location.href = purchase_link;
	}

	$(document).ready( function() {
		hitung_tagihan();
	} );
</script>