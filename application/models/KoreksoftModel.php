<?php 

/**
 * Korek Software Model
 */
class KoreksoftModel extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

		public function getDayLeft($date)
		{
			$d1=strtotime( $date );
			$d2=ceil(($d1-time())/60/60/24);
			return $d2;
		}

		//Fungsi utk bikin waktu format database jadi lokal indo
	    public function convertTimeFormat($tgl_sumber)
	    {
	    	$tgl = explode(' ', $tgl_sumber);
	    	$tgl_depan = explode('-', $tgl[0]);
	    	if (strpos($tgl_sumber, ":")) {
	    		$jam_menit = substr($tgl[1], 0, 5); // kalo ada jam dan menitnya, dicirikan dengan tanda titik dua (:)
	    	}

	    	$tahun = $tgl_depan[0];
	    	$bulan = $tgl_depan[1];
	    	$tanggal = $tgl_depan[2];

	    	switch ($bulan) {
	    		case '01':
	    			$bulan = 'Januari';
	    			break;
	    		case '02':
	    			$bulan = 'Februari';
	    			break;
	    		case '03':
	    			$bulan = 'Maret';
	    			break;
	    		case '04':
	    			$bulan = 'April';
	    			break;
	    		case '05':
	    			$bulan = 'Mei';
	    			break;
	    		case '06':
	    			$bulan = 'Juni';
	    			break;
	    		case '07':
	    			$bulan = 'Juli';
	    			break;
	    		case '08':
	    			$bulan = 'Agustus';
	    			break;
	    		case '09':
	    			$bulan = 'September';
	    			break;
	    		case '10':
	    			$bulan = 'Oktober';
	    			break;
	    		case '11':
	    			$bulan = 'November';
	    			break;
	    		case '12':
	    			$bulan = 'Desember';
	    			break;
	    		default:
	    			$bulan = 'error';
	    			break;
	    	}
	    	if (!empty($jam_menit)) {
	    		$jam_menit = ', ' . $jam_menit;
	    		return $tanggal . ' ' . $bulan . ' ' . $tahun . $jam_menit;
	    	} else {
	    		return $tanggal . ' ' . $bulan . ' ' . $tahun;
	    	}
	    }

	    // kirim email
	    public function kirim_email($email_address_from, $sender_name, $email_address_to, $subject, $message)
	    {
	    	global $SConfig;

	    	// $config = [
	    	// 	'protocol' => $SConfig->_protocol,
	    	// 	'smtp_host' => $SConfig->_smtp_host,
	    	// 	'smtp_user' => $SConfig->_smtp_user,
	    	// 	'smtp_pass' => $SConfig->_smtp_pass,
	    	// 	'smtp_port' => $SConfig->_smtp_port,
	    	// 	'mailtype' => $SConfig->_mailtype,
	    	// 	'charset' => $SConfig->_charset_email,
	    	// 	'TLS/SSL' => $SConfig->_TLS_SSL,
	    	// 	'newline' => $SConfig->_newline
	    	// ];

	    	$this->load->library('email');
	    	// $this->email->initialize($config);

	    	$this->email->from($email_address_from, $sender_name);
	    	$this->email->to($email_address_to);

	    	$this->email->subject($subject);
	    	$this->email->message($message);

	    	$send = $this->email->send();

	    	if (!$send) {
	    		echo $this->email->print_debugger();
	    		die;
	    	}
	    }


	    public function upload_gambar($input_name, $path, $rename_to)
	    {

	    	// upload image start .widibaka
	    	$this->load->helper(array('form')); // syarat biar do_upload berfungsi
	    	$config['upload_path']          = $path;
	    	$config['allowed_types']        = 'jpg|jpeg|png';
	    	$config['max_size']             = 2000;

	    	$this->load->library('upload', $config);

	    	if (!$this->upload->do_upload($input_name)) // input name yang ada di form
	    	{
	    		$error = $this->upload->display_errors();
	    		$data = [];
	    		$data['error'] = $error;
	    		$data['status'] = false;
	    		return $data; // kalo gagal, return error
	    	} else {
	    		$upload_data = $this->upload->data();
	    		// var_dump($upload_data);
	    		// die();
	    		// rename file yang diupload

	    		$old_name = $upload_data['raw_name'] . $upload_data['file_ext'];
	    		$new_name = $rename_to . $upload_data['file_ext'];
	    		rename($path . $old_name, $path . $new_name); // ganti nama image dengan nama random
	    		$data = [];
	    		$data['status'] = true;
	    		$data['data'] = $upload_data;
	    		$data['data']['new_name'] = $new_name;
	    		return $data;
	    	}
	    	// upload image End .widibaka
	    }

	    public function set_alert($jenis, $pesan)
		{
			// jenis alert ada danger, warning, success
			$this->session->set_flashdata('alert', '<div class="alert alert-' . $jenis . ' d-none" role="alert">' . $pesan . '</div>');
		}

		public function set_image_name_in_db($order_id, $filename)
		{
			$time = time();
			$data = [
				"image" => $filename . "?" . $time,
			];
			$this->db->where("id", $order_id);
			$execute = $this->db->update('order', $data);
		}


	public function getUser($email)
	{
		$email = strtolower( $email );
		$this->db->where('email', $email);
		$this->db->limit(1);
		$result = $this->db->get('user');
		if ( $result->num_rows() > 0 ) {
			$data = $result->row_array();
			return $data;
		}else{
			return false;
		}
	}

	public function checkSession()
	{
		if ( empty( $this->session->userdata("email") ) ) {
			redirect( base_url("auth/login") );
			die();
		}
	}
	public function make_order($product_plan_id, $amount, $user_id)
	{
		$timestamp = date("Y-m-d H:i:s");
		$d=strtotime("+3 Months");
		$expire = date("Y-m-d H:i:s", $d);
		$data = [
			"product_plan_id" => $product_plan_id,
			"user_id" => $user_id,
			"amount" => $amount,
			"timestamp" => $timestamp,
			"image" => '',
			"is_active" => 0,
			"expire" => $expire,
			"cancel" => 0,
		];
		$execute = $this->db->insert('order', $data);

		if ( $execute ) {
			return true;
		}else{
			return false;
		}
	}
	public function delete_order_admin($order_id)
	{	
		// check if exists
		$this->db->where('id', $order_id);
		$this->db->limit(1);
		$result = $this->db->get('order');
		$is_active = $result->row_array()['is_active'];
		$image = $result->row_array()['image'];

		// delete if it is not active order
		if ( $is_active != 1 ) {
			// delete image first
			unlink( 'assets/koreksoft/bukti_pembayaran/' . $image );
			//then delete the row
			$this->db->where("id", $order_id);
			$this->db->delete('order');
			return true;
		}else{
			return false;
		}
	}
	public function confirm_order($order_id)
	{	
		// delete if it is not active order
		$data = ['is_active' => "1"];
		$this->db->where("id", $order_id);
		$execute = $this->db->update('order', $data);
		if ( $execute ) {
			return true;
		}else{
			return false;
		}
	}
	public function unconfirm_order($order_id)
	{	
		// delete if it is not active order
		$data = ['is_active' => "0"];
		$this->db->where("id", $order_id);
		$execute = $this->db->update('order', $data);
		if ( $execute ) {
			return true;
		}else{
			return false;
		}
	}
	public function loginUser($email, $password)
	{	
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->limit(1);
		$result = $this->db->get('user');
		if ( $result->num_rows() > 0 ) {
			$data = $result->row_array();
			return $data;
		}else{
			return false;
		}
	}
	public function refresh()
	{
		redirect( $this->uri->uri_string() );
	}
	public function delete_order($order_id)
	{	
		// check if exists
		$this->db->where('id', $order_id);
		$this->db->limit(1);
		$result = $this->db->get('order');
		$is_active = $result->row_array()['is_active'];
		// delete if it is not active order
		$data = ['cancel' => "1"];
		if ( $is_active != 1 ) {
			$this->db->where("id", $order_id);
			$this->db->update('order', $data);
			return true;
		}else{
			return false;
		}
	}
	public function getSidebarItems()
	{
		$result = $this->db->get('sidebar');
		$data = $result->result_array();
		return $data;
	}
	public function getSidebarItems_admin()
	{
		$result = $this->db->get('sidebar_admin');
		$data = $result->result_array();
		return $data;
	}
	public function getWebsiteDetail()
	{
		$this->db->limit(1);
		$result = $this->db->get('website');
		$data = $result->row_array();
		return $data;
	}
	public function getAllProduct()
	{
		$this->db->order_by('id', "DESC");
		$result = $this->db->get('product');
		$data = $result->result_array();
		return $data;
	}
	public function getProductPlan($product_id)
	{
		$this->db->where('product_id', $product_id);
		$result = $this->db->get('product_plan');
		$data = $result->result_array();
		return $data;
	}
	public function getProductPlanById($plan_id)
	{
		$this->db->where('id', $plan_id);
		$result = $this->db->get('product_plan');
		$data = $result->row_array();
		return $data;
	}
	public function getProductById($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('product');
		$data = $result->row_array();
		return $data;
	}
	public function getOrderByUserId($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('cancel !=', "1");
		$result = $this->db->get('order');
		$data = $result->result_array();
		return $data;
	}
	public function getOrder_admin()
	{
		$result = $this->db->get('order');
		$data = $result->result_array();
		return $data;
	}
	public function getOrderByUserId_admin($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('order');
		$data = $result->result_array();
		return $data;
	}
	public function getUserById($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->limit(1);
		$result = $this->db->get('user');
		if ( $result->num_rows() > 0 ) {
			$data = $result->row_array();
			return $data;
		}else{
			return false;
		}
	}
}