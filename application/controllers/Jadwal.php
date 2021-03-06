<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function set_view_count()
	{
		$angka = file_get_contents("view.txt");
		$myfile = fopen("view.txt", "w") or die("Unable to open file!");
		$angka = $angka+1;

		fwrite($myfile, $angka);
		fclose($myfile);
	}

	public function index()
	{
		$this->set_view_count();
		$data['title'] = "Jadwal Kuliah Fikom UDB";
		$data['icon'] = "02.gif";
		$jadwal = $this->db->get('_jadwal')->result_array();

		$jurusan = [];

		foreach ($jadwal as $key => $value) {
			array_push($jurusan, strtoupper($value['jurusan']));
		}

		$data['jurusan'] = array_unique($jurusan);

		$this->load->view('_jadwal_index', $data);
	}
	//mahasiswa
	public function kelas($jurusan = '', $kelas = '', $jenis = '')
	{
		$this->set_view_count();
		$data['title'] = "Jadwal " . strtoupper($kelas);
		$data['icon'] = "02.gif";
		$data['jurusan'] = $jurusan;
		$data['jenis'] = $jenis;
		$data['kelas'] = $kelas;

		if ( !empty($kelas) ) {
			$this->load->view('_jadwal', $data);
		}
	}


	public function jurusan($jurusan = '')
	{
		$this->set_view_count();
		$data['title'] = "Jadwal Kuliah " . strtoupper($jurusan);
		$data['icon'] = "02.gif";
		$this->db->where("jurusan", $jurusan);
		$this->db->order_by("kelas", "DESC");
		$jadwal = $this->db->get('_jadwal')->result_array();

		$classes = [];

		foreach ($jadwal as $key => $value) {
			array_push($classes, $value['kelas']);
		}

		$data['classes'] = array_unique($classes);
		$data['jurusan'] = $jurusan;

		$this->load->view('_jadwal_jurusan', $data);
	}











	//dosen
	public function dosen_index()
	{
		$this->set_view_count();
		$data['title'] = "Jadwal Dosen";
		$data['icon'] = "miku0.gif";
		$this->db->order_by("dosen", "ASC");
		$jadwal = $this->db->get('_jadwal')->result_array();

		$dosen = [];

		foreach ($jadwal as $key => $value) {
			array_push($dosen, $value['dosen']);
		}

		$data['dosen'] = array_unique($dosen);

		$this->load->view('_jadwal_dosen_index', $data);
	}

	public function dosen($dosen = '' , $jenis = '' )
	{
		$this->set_view_count();
		$dosen_decoded = base64_decode(str_replace('garis_miring', '/', $dosen));
		$data['title'] = "Jadwal " . $dosen_decoded;
		$data['icon'] = "miku0.gif";
		$data['dosen'] = $dosen;
		$data['jenis'] = $jenis;

		if ( !empty($dosen) ) {
			$this->load->view('_jadwal_dosen', $data);
		}else{
			redirect( base_url() . 'jadwal/dosen_index' );
		}
	}






	//ruangan
	public function ruangan_index()
	{
		$this->set_view_count();
		$data['title'] = "Jadwal Ruangan";
		$data['icon'] = "tamako.gif";
		$this->db->order_by("index_hari", "ASC");
		$this->db->order_by("ruang", "ASC");
		$jadwal = $this->db->get('_jadwal')->result_array();

		$hari = [];
		$index_hari = [];
		$ruangan = [];

		foreach ($jadwal as $key => $value) {
			array_push($hari, str_replace(' ', '', $value['hari']));
			array_push($index_hari, str_replace(' ', '', $value['index_hari']));
			array_push($ruangan, $value['ruang']);
		}
		$data['ruangan'] = array_unique($ruangan);
		$data['hari'] = [ array_unique($hari), array_unique($index_hari) ];

		$this->load->view('_jadwal_ruangan_index', $data);
	}


	public function ruangan($index_hari_saat_ini = '', $ruangan_saat_ini = '')
	{
		$this->set_view_count();
		$data['title'] = "Jadwal Ruangan";
		$data['icon'] = "tamako.gif";


		if ( empty($index_hari_saat_ini) or empty($ruangan_saat_ini) ) {
			redirect( base_url() . 'jadwal/ruangan_index' );
		}


		$this->db->order_by("index_hari", "ASC");
		$this->db->order_by("ruang", "ASC");
		$jadwal = $this->db->get('_jadwal')->result_array();

		$hari = [];
		$index_hari = [];
		$ruangan = [];

		foreach ($jadwal as $key => $value) {
			array_push($hari, str_replace(' ', '', $value['hari']));
			array_push($index_hari, str_replace(' ', '', $value['index_hari']));
			array_push($ruangan, $value['ruang']);
		}

		$data['ruangan'] = array_unique($ruangan);
		$data['hari'] = [ array_unique($hari), array_unique($index_hari) ];



		$data['index_hari_saat_ini'] = $index_hari_saat_ini;

		// sip sip
		foreach ($hari as $key => $value) {
			if ( $index_hari[$key] == $index_hari_saat_ini ) {
				$data['hari_saat_ini'] = $value;
			}
		}


		$data['ruangan_saat_ini'] = $ruangan_saat_ini;

		$this->load->view( '_jadwal_ruangan', $data );
	}


















	public function get_jadwal_dosen( $dosen = '', $jenis = '' )
	{
		$dosen = base64_decode(str_replace('garis_miring', '/', $dosen));

		if ( $jenis == 'semua' ) {
			$mati = 'bg-abu-abu';
			$timer_mati = 'd-none';
		}else {
			$mati = 'bg-abu-abu d-none';
			$timer_mati = 'd-none';
		}
		$this->db->where("dosen", $dosen);

		//  Urutin berdasarkan index hari, dan jam mulai
		$this->db->order_by("index_hari", "ASC");
		$this->db->order_by("jam_mulai", "ASC");

		$jadwal = $this->db->get('_jadwal')->result_array();
		$data['jadwal'] = $this->proses_jadwal($jadwal, $mati, $timer_mati);

		$this->load->view('_jadwal_dosen_content', $data);
	}

	public function get_jadwal_ruangan( $index_hari = '', $ruangan ='' )
	{
		$ruangan = base64_decode(str_replace('garis_miring', '/', $ruangan));

		$mati = 'bg-abu-abu';
		$timer_mati = 'd-none';

		$this->db->where("index_hari", $index_hari);
		$this->db->where("ruang", $ruangan);

		//  Urutin berdasarkan index hari, dan jam mulai
		$this->db->order_by("index_hari", "ASC");
		$this->db->order_by("jam_mulai", "ASC");
		$this->db->order_by("ruang", "ASC");

		$jadwal = $this->db->get('_jadwal')->result_array();
		$data['jadwal'] = $this->proses_jadwal($jadwal, $mati, $timer_mati);

		$this->load->view('_jadwal_ruangan_content', $data);
	}
	public function get_jadwal($jurusan = '', $kelas, $jenis = '')
	{
		if ( $jenis == 'semua' ) {
			$mati = 'bg-abu-abu';
			$timer_mati = 'd-none';
		}else {
			$mati = 'bg-abu-abu d-none';
			$timer_mati = 'd-none';
		}
		//  Urutin berdasarkan index hari, dan jam mulai
		$this->db->order_by("index_hari", "ASC");
		$this->db->order_by("jam_mulai", "ASC");

		$this->db->where("jurusan", strtolower($jurusan));
		$this->db->where("kelas", strtolower($kelas));
		$jadwal = $this->db->get('_jadwal')->result_array();
		$data['jadwal'] = $this->proses_jadwal($jadwal, $mati, $timer_mati);

		$this->load->view('_jadwal_content', $data);
	}



















	public function proses_jadwal($jadwal, $mati, $timer_mati)
	{
		for ($i=0; $i < count($jadwal); $i++) { 			
			$selisih_dg_waktu_mulai = time() - strtotime($jadwal[$i]['jam_mulai']);
			$selisih_dg_waktu_selesai = strtotime($jadwal[$i]['jam_selesai']) - time();

			// masukin ke array
			$jadwal[$i]['selisih_dg_waktu_mulai'] = $selisih_dg_waktu_mulai;
			$jadwal[$i]['selisih_dg_waktu_selesai'] = $selisih_dg_waktu_selesai;
			
			// $durasi = strtotime($jadwal[$i]['jam_selesai']) - strtotime($jadwal[$i]['jam_mulai']);
			$jadwal[$i]['nyala'] = '';
			$jadwal[$i]['timer'] = '';
			
			switch ( preg_replace( "/\r|\n/", "", strtolower($jadwal[$i]['hari'])) ) {
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
				$limabelas_menit = 60*15;
				$jadwal[$i]['nyala'] .= 'text-dark border-kiri';
				if ( $selisih_dg_waktu_mulai > -$limabelas_menit &&  $selisih_dg_waktu_selesai > 0 ) {
					$jadwal[$i]['nyala'] .= ' myGlower';
				}
			}else{
				$jadwal[$i]['nyala'] .= $mati;
				$jadwal[$i]['timer'] .= $timer_mati;
			}
		}
		return $jadwal;
	}
}
