<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Errors extends CI_Controller
{
    public function page_missing()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('errors/404');
        $this->load->view('templates/footer');
    }
}

?>