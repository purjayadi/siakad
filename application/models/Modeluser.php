<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Modeluser extends CI_Model {

		public function cek_user($data) {
		$query = $this->db->get_where('user', $data);
		return $query;
		}

		public function get_detail($id)
	    {
	        $query = $this->db->get_where('user', array('id' => $id));
	        return $query->row();
	    }

	}

?>
