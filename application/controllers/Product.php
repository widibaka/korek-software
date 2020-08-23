<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
		
	}

	public function index()
	{
		$email = $this->session->userdata("email");
		$data['user'] = $this->KoreksoftModel->getUser($email);
		$data['title'] = "Products";
		$data['product'] = $this->KoreksoftModel->getAllProduct();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('client/product', $data);
		$this->load->view('templates/footer', $data);
	}

	public function detail($id)
	{
		$data = array();
		$email = $this->session->userdata("email");
		
		$data['title'] = "Products";
		$data['user'] = $this->KoreksoftModel->getUser( $email  );
		$data['product'] = $this->KoreksoftModel->getProductById($id);
		$data['product_plan'] = $this->KoreksoftModel->getProductPlan($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('client/product_detail', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('client/product_detail_js', $data);
	}

	public function make_order($product_plan_id, $redirect, $amount = 1, $in_period)
	{
		$this->KoreksoftModel->checkSession(); // dilempar ke login page kalau session habis
		$email = $this->session->userdata("email");
		$user_id = $this->KoreksoftModel->getUser( $email  )['user_id'];
		$make_order =  $this->KoreksoftModel->make_order($product_plan_id, $amount, $in_period, $user_id);
		if ( $make_order == false ) {
			$this->KoreksoftModel->set_alert("danger", "Order gagal dibuat! Mohon coba lagi.");
		}else{
			if ( $amount == 0 ) {
				$this->KoreksoftModel->set_alert("success", "Free Code berhasil diaktifkan.");
			}else{
				$this->KoreksoftModel->set_alert("success", "Order berhasil dibuat. Silakan upload bukti pembayaran dan tunggu konfirmasi dari admin 1 x 24 jam.");
			}
		}
		$redirect = str_replace("-", "/", $redirect);
		redirect( base_url( $redirect ) );
	}

	public function delete_order($order_id, $redirect)
	{
		$this->KoreksoftModel->checkSession(); // dilempar ke login page kalau session habis
		$del_order = $this->KoreksoftModel->delete_order($order_id);
		if ( $del_order == false ) {
			$this->KoreksoftModel->set_alert("danger", "Order gagal dibatalkan karena masih aktif!");
		}else{
			$this->KoreksoftModel->set_alert("success", "Order berhasil dihapus.");
		}
		$redirect = str_replace("-", "/", $redirect);
		redirect( base_url( $redirect ) );
	}

	public function delete_order_admin($order_id, $redirect)
	{
		$this->KoreksoftModel->checkSession(); // dilempar ke login page kalau session habis
		$del_order = $this->KoreksoftModel->delete_order_admin($order_id);
		if ( $del_order == false ) {
			$this->KoreksoftModel->set_alert("danger", "Order gagal dihapus karena masih aktif!");
		}else{
			$this->KoreksoftModel->set_alert("success", "Order berhasil dihapus.");
		}
		$redirect = str_replace("-", "/", $redirect);
		redirect( base_url( $redirect ) );
	}

	public function confirm_order($order_id, $user_id, $redirect)
	{
		$this->KoreksoftModel->checkSession(); // dilempar ke login page kalau session habis

		$email = $this->KoreksoftModel->getUserById($user_id)["email"];

		$message = "Selamat Kode Premium Anda kini telah aktif! <br>Congratulation, your premium code is now active! <br>Order ID: <strong><br><a href='http://koreksoft.online/order'>Check di sini</a>".$order_id."</strong><br><br><br><br><br><br> - Widi Baka, Koreksoft";
		$send_email = $this->KoreksoftModel->kirim_email("no_reply@koreksoft.online", "Koreksoft", $email, "Premium Code", $message);

		$confirm_order = $this->KoreksoftModel->confirm_order($order_id, $user_id);
		if ( $confirm_order == false ) {
			$this->KoreksoftModel->set_alert("danger", "Order gagal dikonfirmasi!");
		}else{
			$this->KoreksoftModel->set_alert("success", "Order berhasil dikonfirmasi.");
		}
		$redirect = str_replace("-", "/", $redirect);
		redirect( base_url( $redirect ) );
	}

	public function unconfirm_order($order_id, $redirect)
	{
		$this->KoreksoftModel->checkSession(); // dilempar ke login page kalau session habis
		$confirm_order = $this->KoreksoftModel->unconfirm_order($order_id);
		if ( $confirm_order == false ) {
			$this->KoreksoftModel->set_alert("danger", "Konfirmasi gagal dihapus!");
		}else{
			$this->KoreksoftModel->set_alert("success", "Konfirmasi berhasil dihapus.");
		}
		$redirect = str_replace("-", "/", $redirect);
		redirect( base_url( $redirect ) );
	}
}
