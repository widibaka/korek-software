<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
		redirect( base_url() . "auth/login" );
	}

	public function login()
	{
		$data['title'] = "Product";
		$data['user'] = $this->KoreksoftModel->getUser('widibaka55@gmail.com');
		$data['product'] = $this->KoreksoftModel->getAllProduct();
		$this->load->view('login', $data);
	}

}
