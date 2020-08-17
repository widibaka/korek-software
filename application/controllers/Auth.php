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
		if ( $this->session->userdata("email") ) { // kalau session email ada, maka redirect ke dashboard
			redirect( base_url("product") );
		}
		// kalau sudah submit, masuk ke if yang atas. kalau belum, masuk ke else
		if ( !empty($this->input->post()) ) {
			$email = $this->input->post("email", true);
			$password = $this->input->post("password", true);
			$login = $this->KoreksoftModel->loginUser($email, $password);
			// kalau validasinya berhasil, maka masuk ke product jika client, dan masuk ke admin/order kalau admin
			if ( $login != false ) {
				if ( $login['role_id'] == 2 ) {
					$this->session->set_userdata("email", $email); // simpan di session
					redirect( base_url("product") );
				}
				else if( $login['role_id'] == 1 ) {
					$this->session->set_userdata("email", $email); // simpan di session
					redirect( base_url("admin/order") );
				}
			}
			else{
				//  kalau validasi salah, pasang alert lalu refresh
				$this->KoreksoftModel->set_alert("danger", "Password atau email Anda salah!");
				$this->KoreksoftModel->refresh();
				die();
			}
		}
		else{
			$this->load->view('login');
		}
	}
	public function logout()
	{
	  $this->session->unset_userdata('email');

	  redirect( base_url("home") );
	}

}
