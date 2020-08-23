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
		//**
	    // Login with Google
	    //**

	    //include the google OAuth configuration
	    require("assets/plugins/google-api-php-client-2.6.0/vendor/autoload.php");
	    //Step 1: Enter you google account credentials

		$jwt = new \Firebase\JWT\JWT;
		$jwt::$leeway = 60; // adjust this value

		// we explicitly pass jwt object whose leeway is set to 60
		$g_client = new \Google_Client(['jwt' => $jwt]);


		$g_client->setClientId("91581392252-8967kib5tsjpks14vsd0scoqno5v0477.apps.googleusercontent.com");
 		$g_client->setClientSecret("HrC_h2qr6BsuLFwYOGXkeXqH");
 		$g_client->setRedirectUri( base_url('auth/login/') );
 		$g_client->addScope("email");
 		$g_client->addScope("profile");


	    //Step 2 : Create the url
	    $auth_url = $g_client->createAuthUrl();
	    $data['auth_url'] = $auth_url;

	    //Step 3 : Get the authorization  code
	    $code = isset($_GET['code']) ? $_GET['code'] : NULL;

	    //Step 4: Get access token
	    if (isset($code)) {

	      try {

	        $token = $g_client->fetchAccessTokenWithAuthCode($code);
	        $g_client->setAccessToken($token);
	      } catch (Exception $e) {
	        $e->getMessage();
	      }

	      try {
	        $pay_load = $g_client->verifyIdToken(); // ini kalo berhasil

	      } catch (Exception $e) {
	        $e->getMessage();
	        var_dump($e->getMessage()); // <-- untuk testing
	        // var_dump($pay_load); // <-- untuk testing
	        die();
	      }
	    } else {
	      $pay_load = null;
	    }

	    //**
	    // /.Login with Google
	    //**

		if ( $this->session->userdata("email") ) { // kalau session email ada, maka redirect ke dashboard
			redirect( base_url("product") );
		}
		// kalau sudah submit, masuk ke if yang atas. kalau belum, masuk ke else
		if ( !empty($this->input->post()) or !empty($pay_load) ) {


			if (  !empty( $this->input->post() ) ) {
				$email = $this->input->post("email", true);
				$password = $this->input->post("password", true);
				$login = $this->KoreksoftModel->loginUser($email, $password);
			}else if( !empty($pay_load) ){
				$email = $pay_load["email"];
				$login = $this->KoreksoftModel->getUser( $email );
				if ( $login == false ) {
					$this->KoreksoftModel->registerUser_google($pay_load["name"], $pay_load["email"]);
					$this->KoreksoftModel->set_alert("success", "Akun berhasil dibuat. Silakan login kembali memakai Google.");
					$this->KoreksoftModel->refresh();
					die();
				}
			}

			// kalau validasinya berhasil, maka masuk ke product jika client, dan masuk ke admin/order kalau admin
			if ( $login != false ) {
				$this->KoreksoftModel->login_success($login);
			}
			else{
				//  kalau validasi salah, pasang alert lalu refresh
				$this->KoreksoftModel->set_alert("danger", "Password atau email Anda salah!");
				$this->KoreksoftModel->refresh();
				die();
			}
		}
		else{
			$this->load->view('login', $data);
		}
	}

	public function register()
	{
		$data = [];
		if ( $this->session->userdata("email") ) { // kalau session email ada, maka redirect ke dashboard
			redirect( base_url("product") );
		}
		// kalau sudah submit, masuk ke if yang atas. kalau belum, masuk ke else
		if ( !empty($this->input->post()) ) {
			$username = $this->input->post("username", true);
			$email = $this->input->post("email", true);
			$password = $this->input->post("password", true);
			$password2 = $this->input->post("password2", true);

			if ( $password != $password2 ) {
				$this->KoreksoftModel->set_alert("danger", "Password yang Anda input tidak sama!");
				$this->KoreksoftModel->refresh();
				exit();
			}else{
				$register = $this->KoreksoftModel->registerUser($username, $email, $password);

				if ( $register == true ) {
					$this->KoreksoftModel->set_alert("success", "Registrasi berhasil. Silakan login.");
					redirect( base_url("auth/login") );
				}

			}
		}
		else{
			$this->load->view('register', $data);
		}
	}

	public function forgot_password()
	{
		if ( $this->session->userdata("email") ) { // kalau session email ada, maka redirect ke dashboard
			redirect( base_url("product") );
		}

		// kalau sudah submit, masuk ke if yang atas. kalau belum, masuk ke else
		if ( !empty($this->input->post()) ) {
			$email = $this->input->post("email", true);

			$password = $this->KoreksoftModel->getUser($email)["password"];

			$message = "Berikut ini adalah password Anda: <br>This is your password below: <br><strong> " . $password . "</strong><br><br><br><br><br><br><br> - Widi Baka, Koreksoft";
			$send_email = $this->KoreksoftModel->kirim_email("no_reply@koreksoft.online", "Koreksoft", $email, "Password Koreksoft", $message);
			if ( $send_email == true ) {
				$this->KoreksoftModel->set_alert("success", "Password berhasil dikirim. Silakan periksa inbox Anda.");
				$this->KoreksoftModel->refresh();

			}else{
				$this->KoreksoftModel->set_alert("danger", "Pengiriman email gagal!");
				$this->KoreksoftModel->refresh();
			}

		}
		$this->load->view('forgot_password');
	}
	public function logout()
	{
	  $this->session->unset_userdata('email');

	  redirect( base_url("home") );
	}
	public function mark_as_read($user_id, $redirect)
	{
	  $this->KoreksoftModel->mark_as_read_notif( $user_id );

	  $hapus = str_replace("http://", "", base_url());
	  $hapus = str_replace("https://", "", $hapus);

	  $redirect = str_replace("garing", "/", $redirect);
	  $redirect = str_replace( $hapus , "", $redirect);
	  redirect( $redirect );
	}

}
