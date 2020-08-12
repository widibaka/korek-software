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
		$data['title'] = "Product";
		$data['user'] = $this->KoreksoftModel->getUser('widibaka55@gmail.com');
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
		
		$data['title'] = "Product";
		$data['user'] = $this->KoreksoftModel->getUser('widibaka55@gmail.com');
		$data['product'] = $this->KoreksoftModel->getProductById($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('client/product_detail', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('client/product_detail_js', $data);
	}
}