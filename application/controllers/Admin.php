<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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

	public function order()
	{
		$data['title'] = "Orders";
		$data['user'] = $this->KoreksoftModel->getUser('widibaka55@gmail.com');

		$user_id = $data['user']['user_id'];

		$data['orders'] = $this->KoreksoftModel->getOrder_admin();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('admin/order', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('admin/order_js', $data);
	}

	public function client($client_id)
	{
		$data['title'] = "Orders";
		$data['user'] = $this->KoreksoftModel->getUser('widibaka55@gmail.com');

		$user_id = $data['user']['user_id'];

		$data['orders'] = $this->KoreksoftModel->getOrderByUserId_admin($client_id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('admin/order', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('admin/order_js', $data);
	}
}
