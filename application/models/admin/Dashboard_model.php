<?php
	class Dashboard_model extends CI_Model{

		public function get_all_users(){
			return $this->db->count_all('ci_admin');
		}
		public function get_active_users(){
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('ci_admin');
		}
		public function get_deactive_users(){
			$this->db->where('is_active', 0);
			return $this->db->count_all_results('ci_admin');
		}
		public function get_all_pegawai(){
			return $this->db->count_all_results('m_personil');
		}
		public function get_all_sarpras(){
			return $this->db->count_all_results('tb_sarpras_lab');
		}
		public function get_all_lab(){
			return $this->db->count_all_results('m_lab');
		}
	}

?>
