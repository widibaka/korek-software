<?php 

/**
 * Korek Software Model
 */
class KoreksoftModel extends CI_Model
{
	
	function __construct()
	{
		# code...
	}
	public function getUser($email)
	{
		$email = strtolower( $email );
		$this->db->where('email', $email);
		$this->db->limit(1);
		$result = $this->db->get('user');
		if ( $result->num_rows() > 0 ) {
			$data = $result->row_array();
			return $data;
		}else{
			return false;
		}
	}
	public function getSidebarItems()
	{
		$result = $this->db->get('sidebar');
		$data = $result->result_array();
		return $data;
	}
	public function getWebsiteDetail()
	{
		$this->db->limit(1);
		$result = $this->db->get('website');
		$data = $result->row_array();
		return $data;
	}
	public function getAllProduct()
	{
		$result = $this->db->get('product');
		$data = $result->result_array();
		return $data;
	}
	public function getProductById($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('product');
		$data = $result->row_array();
		return $data;
	}
}