<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "Jadwal 18 TIA3";

		$this->db->order_by('id', 'DESC');
		$jadwal = $this->db->get('_jadwal')->result_array();

		for ($i=0; $i < count($jadwal); $i++) {
			$selisih_dg_waktu_mulai = time() - strtotime($jadwal[$i]['jam_mulai']);
			$selisih_dg_waktu_selesai = strtotime($jadwal[$i]['jam_selesai']) - time();
			// echo $selisih_dg_waktu_mulai.' ';
			// echo $selisih_dg_waktu_selesai;
			// die();
			// $durasi = strtotime($jadwal[$i]['jam_selesai']) - strtotime($jadwal[$i]['jam_mulai']);
			$jadwal[$i]['nyala'] = '';
			switch ( strtolower($jadwal[$i]['hari']) ) {
			  	case "senin":
			      $jadwal[$i]['day'] = 'monday';
			      break;
			  	case "selasa":
			      $jadwal[$i]['day'] = 'tuesday';
			      break;
			  	case "rabu":
			      $jadwal[$i]['day'] = 'wednesday';
			      break;
			  	case "kamis":
			      $jadwal[$i]['day'] = 'thursday';
			      break;
			  	case "jumat":
			      $jadwal[$i]['day'] = 'friday';
			      break;
			  	case "sabtu":
			      $jadwal[$i]['day'] = 'saturday';
			      break;
			    default:
			      $jadwal[$i]['day'] = '';
			}

			if ( strtolower($jadwal[$i]['day']) == strtolower( date("l") ) ) {
				$jadwal[$i]['nyala'] .= 'text-dark border-kiri';
				if ( $selisih_dg_waktu_mulai > 0 AND  $selisih_dg_waktu_selesai > 0 ) {
					$jadwal[$i]['nyala'] .= ' myGlower';
				}
			}else{
				$jadwal[$i]['nyala'] .= 'bg-abu-abu d-none';
			}
		}
		$data['jadwal'] = $jadwal;

		$this->load->view('_jadwal', $data);
	}

	public function lengkap()
	{
		$data['title'] = "Jadwal 18 TIA3";

		// $this->db->
		$jadwal = $this->db->get('_jadwal')->result_array();

		for ($i=0; $i < count($jadwal); $i++) { 
			$jadwal[$i]['nyala'] = '';
			
			$selisih_dg_waktu_mulai = time() - strtotime($jadwal[$i]['jam_mulai']);
			$selisih_dg_waktu_selesai = strtotime($jadwal[$i]['jam_selesai']) - time();

			switch ( strtolower($jadwal[$i]['hari']) ) {
			  	case "enin":
			      $jadwal[$i]['day'] = 'monday';
			      break;
			  	case "selasa":
			      $jadwal[$i]['day'] = 'tuesday';
			      break;
			  	case "rabu":
			      $jadwal[$i]['day'] = 'wednesday';
			      break;
			  	case "kamis":
			      $jadwal[$i]['day'] = 'thursday';
			      break;
			  	case "jumat":
			      $jadwal[$i]['day'] = 'friday';
			      break;
			  	case "sabtu":
			      $jadwal[$i]['day'] = 'saturday';
			      break;
			    default:
			      $jadwal[$i]['day'] = '';
			}

			if ( strtolower($jadwal[$i]['day']) == strtolower( date("l") ) ) {
				$jadwal[$i]['nyala'] .= 'text-dark border-kiri';
				if ( $selisih_dg_waktu_mulai > 0 &&  $selisih_dg_waktu_selesai > 0 ) {
					$jadwal[$i]['nyala'] .= ' myGlower';
				}
			}else{
				$jadwal[$i]['nyala'] .= 'bg-abu-abu';
			}
		}
		$data['jadwal'] = $jadwal;

		$this->load->view('_jadwal_lengkap', $data);
	}
}
