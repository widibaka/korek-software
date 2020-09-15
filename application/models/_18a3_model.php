<?php 

/**
 * Korek Software Model
 */
class _18a3_model extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function get_jadwal($jam, $hari)
	{
		$this->db->where('jam', $jam);
		$this->db->where('hari', $hari);

		$jadwal = $this->db->get('_jadwal_18a3')->row_array();

		if ( $jadwal ) {
			$this->db->where('id', $jadwal['id_mata_kuliah']);
			$this->db->select('mata_kuliah, inisial, sifat, dosen, ruang');
			$jadwal_detail = $this->db->get('_jadwal_18a3_matakul')->row_array();
			return array_merge( $jadwal, $jadwal_detail );
		}
	}

	public function set_jadwal($jadwal_id, $matakul_id, $jenis, $jam, $hari)
	{
		if ( $matakul_id == 'hapus' ) {
			$this->db->where('id', $jadwal_id);
			$this->db->delete('_jadwal_18a3');
		}
		elseif ( !empty($jadwal_id) ) {
			$this->db->where('id', $jadwal_id);
			$data = [
				'id_mata_kuliah' => $matakul_id,
				'jenis' => $jenis
			];
			$this->db->update('_jadwal_18a3', $data);
		}else{
			$data = [
				'hari' => $hari,
				'jam' => $jam,
				'id_mata_kuliah' => $matakul_id,
				'jenis' => $jenis,
			];
			$this->db->insert('_jadwal_18a3', $data);
		}

		
	}

}