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

	    public function login_success($login)
	    {
	    	if ( $login['role_id'] == 2 ) {
	    		$this->session->set_userdata("email", $login['email']); // simpan di session
	    		redirect( base_url("product") );
	    	}
	    	else if( $login['role_id'] == 1 ) {
	    		$this->session->set_userdata("email", $login['email']); // simpan di session
	    		redirect( base_url("admin/order") );
	    	}
	    }

	    // kirim email
	    public function kirim_email($email_address_from, $sender_name, $email_address_to, $subject, $message)
	    {
	    	global $SConfig;

	    	$config = [
	    	// 	'protocol' => $SConfig->_protocol,
	    	// 	'smtp_host' => $SConfig->_smtp_host,
	    	// 	'smtp_user' => $SConfig->_smtp_user,
	    	// 	'smtp_pass' => $SConfig->_smtp_pass,
	    	// 	'smtp_port' => $SConfig->_smtp_port,
	    		'mailtype' => "html",
	    	// 	'charset' => $SConfig->_charset_email,
	    	// 	'TLS/SSL' => $SConfig->_TLS_SSL,
	    	// 	'newline' => $SConfig->_newline
	    	];

	    	$this->load->library('email', $config);
	    	// $this->email->initialize($config);

	    	$this->email->from($email_address_from, $sender_name);
	    	$this->email->to($email_address_to);

	    	$this->email->subject($subject);
	    	$this->email->message($message);

	    	$send = $this->email->send();

	    	if (!$send) {
	    		return $this->email->print_debugger();
	    	}
	    	elseif ($send) {
	    		return true;
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
	public function make_order($product_plan_id, $amount, $in_period, $user_id)
	{
		
		$timestamp = date("Y-m-d H:i:s");
		$prepare_id = $user_id . substr(time(), 5);

		$data = [
			"id" => $prepare_id,
			"product_plan_id" => $product_plan_id,
			"user_id" => $user_id,
			"amount" => $amount,
			"timestamp" => $timestamp,
			"image" => '',
			"is_active" => 0,
			"expire" => "",
			"cancel" => 0,
			"premium_code" => $amount . "@" . $in_period . "@" . $user_id,
		];
		if ( $amount == 0 ) {
			//generate free code


			$check = $this->check_if_double_free_code($user_id);
			if ( $check == false ) { // berarti dia pengen dapet free code dua kali. Itu gak boleh!
				return false;
				exit();
			}



			$email = $this->getUserById($user_id)["email"];
			$d = strtotime("+120 Months"); // 10 tahun mas aberlaku
			$expire = date("Y-m-d H:i:s", $d);

			$data['is_active'] = 1;
			$data['expire'] = $expire;
			$data['premium_code'] = null;
			$data['free_code'] = base64_encode( $email . "@saparate@" . $prepare_id );

			// membuat data di tabel link_previewer
			$data_lp = [
				"order_id" => $prepare_id,
				"email" => $email,
				"jenis" => "free",
				"request_remains" => 100,
			];

			$this->db->insert('link_previewer', $data_lp);

			$this->set_notification("Free Code telah aktif", "Anda telah mengaktifkan free code", $user_id);


		}
		$execute = $this->db->insert('order', $data);

		if ( $execute ) {
			return true;
		}else{
			return false;
		}
	}
	public function check_if_double_free_code($user_id)
	{	
		$this->db->where("user_id", $user_id);
		$this->db->where("free_code !=", null );
		$num_free_code = $this->db->get("order")->num_rows();
		
		if ( $num_free_code > 0 ) {
			return false;
		}else{
			return true;
		}
	}
	public function confirm_order($order_id, $user_id)
	{	

		// confirm
		$this->db->where("id", $order_id);
		$order = $this->db->get("order")->row_array();
		$premium_code_mentah = explode( "@", $order["premium_code"]);
		if ( strpos( $order["premium_code"], "@" ) ) {
			// memecah bahan mentah codepremium
			$amount = $premium_code_mentah[0];
			$in_period = $premium_code_mentah[1];
			$user_id = $premium_code_mentah[2];

			//generating premium code
			$email = $this->getUserById($user_id)["email"];
			$premium_code = base64_encode( $email . "@saparate@" . $order_id );

			// menghitung masa berlaku
			$total_months = $in_period * $amount;
			$d=strtotime("+" . $total_months . " Months");
			$expire = date("Y-m-d H:i:s", $d);


			$data = [
				"is_active" => 1,
				"expire" => $expire,
				"premium_code" => $premium_code,
			];

			// membuat data di tabel link_previewer
			$data_lp = [
				"order_id" => $order_id,
				"email" => $email,
				"jenis" => "premium",
				"request_remains" => 5000,
			];

			$this->db->insert('link_previewer', $data_lp);


			//set notification
			$this->set_notification( "Order telah dikonfirmasi", "Selamat! Kode premium Anda sudah aktif.", $user_id );

		}else{
			$data = [
				"is_active" => 1,
			];
		}
		$this->db->where("id", $order_id);
		$execute = $this->db->update('order', $data);
		if ( $execute ) {
			return true;
		}else{
			return false;
		}
	}












    public function validate_request_lp($reg_profile)
    {
    	$final_status = [ // dideklarasi
    		"email_valid" => true,
    		"expire_valid" => true,
    		"is_active_valid" => true,
    		"request_remains_valid" => true,

    		"ketsuron" => true,

    	];

    	$data = explode( "@saparate@", $reg_profile );
    	$email = $data[0];
    	if ( !empty($data[1]) ) {
    		$order_id = $data[1];
    	}
    	else{
    		$order_id = '';
    	}

    	$order = $this->getOrderByOrderId( $order_id );

    	$expire = $order['expire'];

    	
    	// validations
    	// jika salah satudari empat ini false, maka ketsuronnya false 
    	if ( $this->validate_email_lp( $order_id, $email ) == false ) {
    		$final_status['email_valid'] = false;
    		$final_status['ketsuron'] = false;
    	};

    	if ( $this->getDayLeft( $expire ) < 0 ) { // kalo sisa hari kurang dari 0, berarti udah habis masa berlakunya
    		$final_status['expire_valid'] = false;
    		$final_status['ketsuron'] = false;
    	};

    	if ( $order['is_active'] == 0 ) {
    		$final_status['is_active_valid'] = false;
    		$final_status['ketsuron'] = false;
    	};

    	if ( $this->check_request_remains($order_id) == false ) { // cek kesempatan requestnya habis belum

    		$final_status['request_remains_valid'] = false;
    		$final_status['ketsuron'] = false;

    	}
    	// kurangi 
    	$this->kurangi_kesempatan_request($order_id);
    	

    	return $final_status;
    }

	public function getOrderByOrderId($order_id)
	{
		$this->db->where('id', $order_id);
		$result = $this->db->get('order');
		$data = $result->row_array();
		return $data;
	}
	//Fungsi utk bikin waktu mundur buat chat dan lain-lain
	public function get_time_ago($tgl)
	{
		$tgl = strtotime($tgl);
		$time_difference = time() - $tgl;

		if ($time_difference < 1) {
			return '1 detik lalu';
		}

		$condition = array(
			12 * 30 * 24 * 60 * 60 	=>  'tahun',
			30 * 24 * 60 * 60       =>  'bulan',
			24 * 60 * 60            =>  'hari',
			60 * 60                 =>  'jam',
			60                      =>  'menit',
			1                       =>  'detik'
		);

		foreach ($condition as $secs => $str) {
			$d = $time_difference / $secs;

			if ($d >= 1) {
				$t = round($d);
				return $t . ' ' . $str . ' yang lalu';
			}
		}
	}
	public function kurangi_kesempatan_request($order_id)
	{
		// ambil data
		$this->db->where('order_id', $order_id);
		$result = $this->db->get('link_previewer');
		$request_remains = $result->row_array()['request_remains'];
		
		// kurangi kesempatan request
		$request_remains_2 = $request_remains - 1;

		// update setelah dikurangi
		$this->db->where('order_id', $order_id);
		$this->db->update("link_previewer", [ "request_remains" => $request_remains_2 ]);

	}
	public function check_request_remains($order_id)
	{
		$this->db->where('order_id', $order_id);
		$result = $this->db->get('link_previewer');
		$request_remains = $result->row_array()['request_remains'];

		if ( !empty($request_remains) && $request_remains < -1000 ) { // kalo kurang dari minus 1000, jangan tampilkan!
			die();
		}
		
		if ( $request_remains < 1 ) {
			return false;
		}else{
			return true;
		}
	}
	public function get_notification($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->order_by('id', "DESC");
		$this->db->limit(8);
		$result = $this->db->get('notification');
		$notification = $result->result_array();
		
		if ( $result ) {
			return $notification;
		}else{
			return false;
		}
	}
	public function get_unread_notification($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('read', "0");
		$result = $this->db->get('notification');
		$unread = $result->num_rows();
		return $unread;
	}
	public function set_notification( $subject, $content, $user_id )
	{
		$timestamp = date("Y-m-d H:i:s");
		$data = [
			"user_id" => $user_id,
			"subject" => $subject,
			"content" => $content,
			"timestamp" => $timestamp,
			"read" => 0,
		];
		$result = $this->db->insert('notification', $data);
	}
	public function mark_as_read_notif( $user_id )
	{
		$timestamp = date("Y-m-d H:i:s");
		$this->db->where( "user_id", $user_id );
		$data = [
			"read" => 1,
		];
		$this->db->update('notification', $data);
	}
	public function get_request_remains($order_id)
	{
		$this->db->where('order_id', $order_id);
		$result = $this->db->get('link_previewer');
		$request_remains = $result->row_array()['request_remains'];
		
		if ( $request_remains ) {
			return $request_remains;
		}else{
			return false;
		}
	}
	public function validate_email_lp($order_id, $email)
	{
		$this->db->where('order_id', $order_id);
		$result = $this->db->get('link_previewer');
		$email_2 = $result->row_array()['email'];

		if ( !empty($email) && $email_2 == $email ) {
			return true;
		}
		else{
			return false;
		}
	}















	public function hitung_tagihan($order_id)
	{	
		$this->db->where("id", $order_id);
		$order = $this->db->get("order")->row_array();
		$premium_code_mentah = explode( "@", $order["premium_code"]);
		

		// memecah bahan mentah codepremium
		$amount = $premium_code_mentah[0];
		// $in_period = $premium_code_mentah[1];
		// $user_id = $premium_code_mentah[2];

		$plan_id = $order['product_plan_id'];

		$product_plan = $this->getProductPlanById($plan_id);
		$rupiah_price = $product_plan['rupiah_price'];
		$dollar_price = $product_plan['dollar_price'];


		$total_rp = $rupiah_price * $amount;
		$total_d = $dollar_price * $amount;

		$data = [
			"total_rp" => $total_rp,
			"total_d" => $total_d,
		];
		if ( $product_plan ) {
			return $data;
		}else{
			return "";
		}
	}
	public function delete_order_admin($order_id)
	{	
		// check if exists
		$this->db->where('id', $order_id);
		$this->db->limit(1);
		$result = $this->db->get('order');
		$is_active = $result->row_array()['is_active'];
		$image = explode("?", $result->row_array()['image'])[0];

		// delete if it is not active order
		if ( $is_active != 1 ) {
			// delete image first
			if ( $image ) {
				unlink( 'assets/koreksoft/bukti_pembayaran/' . $image );
			}
			//then delete the row
			$this->db->where("id", $order_id);
			$this->db->delete('order');
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
	public function registerUser($username, $email, $password)
	{	
		$timestamp = date("Y-m-d H:i:s");
		$data = [
			"email" => $email,
			"username" => $username,
			"password" => $password,
			"role_id" => 2,
			"register_time" => $timestamp,
		];
		$execute = $this->db->insert('user', $data);
		if ( $execute ) {
			return true;
		}else{
			return false;
		}
	}
	public function registerUser_google($username, $email)
	{	
		$pass_random = mt_rand(10000, 100000);
		$timestamp = date("Y-m-d H:i:s");
		$data = [
			"email" => $email,
			"username" => $username,
			"password" => $pass_random,
			"role_id" => 2,
			"register_time" => $timestamp,
		];

		// kirim email
		$message = "Congrats! You have registered. <br>This is your password below: <br> Selamat! Anda telah terdaftar.<br>Berikut ini adalah password Anda:<br><strong> " . $pass_random . "</strong>";
		// $send_email = $this->KoreksoftModel->kirim_email("no_reply@koreksoft.online", "Widi", $email, "Password Koreksoft", $message);

		// simpan ke db
		$execute = $this->db->insert('user', $data);
		if ( $execute ) {
			return true;
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