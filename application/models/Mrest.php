<?php 
	class Mrest extends CI_Model{
		public function get_mhs($id=null){
			if($id!=null){
				$this->db->where('nim', $id);
			}
			return $this->db->get('mahasiswa');
		}
		public function del_mhs($id){
			$this->db->where('nim', $id);
			$this->db->delete('mahasiswa');
			return $this->db->affected_rows();
		}
	}
 ?>