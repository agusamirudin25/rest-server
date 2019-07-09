<?php 
	/**
	* 
	*/
	class m_mahasiswa extends CI_Model
	{
		
		public function getAllData(){
			return $this->db->get('mahasiswa')->result_array();
		}

		public function getDataBynpm($npm){
			return $this->db->get_where('mahasiswa', ['npm' => $npm])->result();
		}


		public function deleteData($npm){
			$this->db->delete('mahasiswa', ['npm' => $npm]);
			return $this->db->affected_rows();
		}

		public function addData($data){
			$this->db->insert('mahasiswa', $data);
			return $this->db->affected_rows();
		}

		public function editData($data, $npm){
			$this->db->where(['NPM' => $npm]);
			$this->db->update('mahasiswa', $data);
			return $this->db->affected_rows();
		}
	}
?>