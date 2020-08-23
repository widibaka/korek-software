<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->KoreksoftModel->checkSession(); // dilempar ke login page kalau session habis
	}

	public function index()
	{
		$data['title'] = "My Orders";
		$email = $this->session->userdata("email");
		$data['user'] = $this->KoreksoftModel->getUser($email);

		$user_id = $data['user']['user_id'];


		if ( !empty( $this->input->post() ) ) {
			// komponen
			$user_id = $this->input->post('user_id');
			$plan_id = $this->input->post('plan_id');
			$order_id = $this->input->post('order_id');
			// siap siap untuk upload
			$name = "image";
			$path = "assets/koreksoft/bukti_pembayaran/";
			$rename_to = $user_id . "-" . $plan_id . "-" . $order_id;
			// upload now
			$upload_gambar = $this->KoreksoftModel->upload_gambar( $name, $path, $rename_to );
			if ( $upload_gambar['status'] == true ) {
				// ubah nama image di database
				$image_name = $upload_gambar['data']['new_name'];
				$this->KoreksoftModel->set_image_name_in_db( $order_id, $image_name );
				// kirim email ke admin
				$message = '<p>Ada orderan&nbsp;<span style="font-size: 1rem;">Link Previewer&nbsp;</span><span style="font-size: 1rem;">untuk kamu min:</span></p><p>Klik <a href="http://koreksoft.online/admin/order" target="_blank"><span style="border-radius:5px; padding:3px 8px; background-color: rgb(0, 255, 255);">di sini</span></a></p>';
				$send_email = $this->KoreksoftModel->kirim_email("no_reply@koreksoft.online", "Koreksoft", "widibaka55@gmail.com", "Ada Pesanan!", $message);
				$this->KoreksoftModel->set_alert("success", "Upload gambar berhasil.");
			}elseif ( $upload_gambar['status'] == false ){
				$this->KoreksoftModel->set_alert("danger", "Gagal upload gambar!");
			}
			
			
		}

		$data['orders'] = $this->KoreksoftModel->getOrderByUserId($user_id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('client/order', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('client/order_js', $data);
	}
}
