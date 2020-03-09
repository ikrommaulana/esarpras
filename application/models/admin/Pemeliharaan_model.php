<?php
	class Pemeliharaan_model extends CI_Model{

		public function add_master($table,$data){
			$this->db->insert($table, $data);
			return true;
		}

		public function get_master($table){
			$query = $this->db->get($table);
			return $result = $query->result();
		}

		//---------------------------------------------------
		// get all master records for simple datatable example
		public function get_all_simple_master($table){

			$query = $this->db->get($table);
			return $result = $query->result_array();
		}
		//---------------------------------------------------
		// get all  for server-side datatable processing (ajax based)
		public function get_all_master($table,$where=''){
			$wh =array();
			$SQL ='SELECT * FROM '.$table;
			$wh[] = $where;
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}


		//---------------------------------------------------
		// Get master detial by ID
		public function get_master_by_id($table,$primary,$id){
			$query = $this->db->get_where($table, array($primary => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit master Record
		public function edit_master($table,$primary,$data, $id){
			$this->db->where($primary, $id);
			$this->db->update($table, $data);
			return true;
		}

		//---------------------------------------------------
		// Change master status
		//-----------------------------------------------------
		function change_status($table,$primary)
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where($primary, $this->input->post('id'));
			$this->db->update($table);
		} 

		function get_all_pemeliharaan() {
			$sql = "SELECT a.*, b.nama_jalan, b.nama_lokasi, b.kecamatan, b.kabupaten, b.provinsi,
					c.nama_pegawai, c.nip, d.nama_sarpras, d.spesifikasi, d.fungsi, 
					e.nama_mitra, f.nama_unitkerja
					FROM tb_pemeliharaan as a 
					LEFT JOIN m_lokasi as b ON (a.lokasi = b.id_lokasi)
					LEFT JOIN m_pegawai as c ON (a.id_pemohon = c.id_admin)
					LEFT JOIN tb_sarpras as d ON (a.id_sarpras = d.id)
					LEFT JOIN m_mitra as e ON (a.id_mitra = e.id_mitra)
					LEFT JOIN m_unitkerja as f ON (a.unitkerja = f.id_unitkerja)
					ORDER BY created_date DESC";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}

		function get_unitkerja_byidadmin() {
			$sql = "SELECT id_unitkerja FROM tb_lokasi_unitkerja as a
					LEFT JOIN m_pegawai as b ON (a.id_lokasi_unitkerja = b.id_lokasi_unitkerja)
					WHERE b.id_admin = '".$this->session->userdata('admin_id')."'";
			$query = $this->db->query($sql)->result();
			return $query;
		}

		function get_lokasi_byunit() {
			$id = $this->session->userdata('admin_id');
			// print_r($id);
			// die();
			$sql = "SELECT a.* FROM m_lokasi as a LEFT JOIN tb_lokasi_unitkerja as b ON (a.id_lokasi = b.id_lokasi)
					LEFT JOIN m_pegawai as c ON (b.id_lokasi_unitkerja = c.id_lokasi_unitkerja)
					WHERE c.id_admin='".$id."'";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}

	}

?>