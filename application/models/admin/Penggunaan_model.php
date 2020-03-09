<?php
	class Penggunaan_model extends CI_Model{

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

		public function get_all_simple_master($table){

			$query = $this->db->get($table);
			return $result = $query->result_array();
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

		function get_all_pemeliharaan($id) {
			$sql = "SELECT a.*, b.nama_sarpras, b.spesifikasi, b.fungsi FROM tb_pemeliharaan as a LEFT JOIN tb_sarpras as b ON (a.id_sarpras = b.id)
				LEFT JOIN m_lokasi as c ON (a.lokasi = c.id_lokasi)
				LEFT JOIN m_unitkerja as d ON (a.unitkerja = d.id_unitkerja) 
				LEFT JOIN m_lab as e ON (e.id_lokasi = c.id_lokasi AND e.id_unitkerja = d.id_unitkerja)
				WHERE e.id_lab='".$id."' AND a.respon='Y'";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}

		function get_unitkerja_byidadmin() {
			$sql = "SELECT kode_unitkerja FROM tb_unitkerja as a
					LEFT JOIN m_pegawai as b ON (a.nip = b.nip)
					WHERE b.id_admin = '".$this->session->userdata('admin_id')."'";
			$query = $this->db->query($sql)->result();
			return $query;
		}

		function get_all_lab() {
			$sql = "SELECT * FROM m_lab as a LEFT JOIN m_lokasi as b ON (a.id_lokasi = b.id_lokasi)
					LEFT JOIN m_unitkerja as c ON (a.id_unitkerja = c.id_unitkerja)
					ORDER BY nama_lab ASC";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}

		function get_all_pegawai($id) {
			$sql = "SELECT a.*, d.fungsi_kewenangan FROM m_pegawai as a 
					LEFT JOIN tb_lokasi_unitkerja as b ON (a.id_lokasi_unitkerja = b.id_lokasi_unitkerja) 
					LEFT JOIN m_lab as c ON (c.id_lokasi = b.id_lokasi AND c.id_unitkerja = b.id_unitkerja)
					LEFT JOIN m_jabatan as d ON (a.id_jabatan = d.id_jabatan)
					WHERE c.id_lab='".$id."'";
			$query = $this->db->query($sql)->result_array();
			return $query;
		} 

		function get_lab_byid($id) {
			$sql = "SELECT a.*, b.nama_lokasi, c.nama_unitkerja FROM m_lab as a 
					LEFT JOIN m_lokasi as b ON (a.id_lokasi = b.id_lokasi) 
					LEFT JOIN m_unitkerja as c ON (a.id_unitkerja = c.id_unitkerja)
					WHERE a.id_lab='".$id."'";
			$query = $this->db->query($sql)->row_array();
			return $query;
		}

		function get_all_penggunaan_by_id($id) {
			$sql = "SELECT a.*, b.nama_pegawai as nama_pemohon, b.nip as nip_pemohon, c.nama_layanan,
					d.nama_pegawai as nama_pelaksana, d.nip as nip_pelaksana
					FROM tb_penggunaan as a 
					LEFT JOIN m_pegawai as b ON (a.id_pemohon = b.id_admin)
					LEFT JOIn tb_layanan_lab as c ON (a.id_layanan = c.id_layanan_lab)
					LEFT JOIN m_pegawai as d ON (a.id_pelaksana = d.id_admin)
					WHERE a.id_lab='".$id."'
					ORDER BY a.tgl_pengguna DESC";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}

		function get_all_penggunaan() {
			$sql = "SELECT a.*, b.nama_pegawai as nama_pemohon, b.nip as nip_pemohon, b.nama_unitkerja as unit_pemohon, 
					c.nama_layanan, c.nama_lab, c.nama_lokasi, c.kabupaten, d.nama_pegawai as nama_pelaksana, 
					d.nip as nip_pelaksana, d.nama_unitkerja as unit_pelaksana
					FROM tb_penggunaan as a 
					LEFT JOIN (SELECT d.id_admin, d.nama_pegawai, d.nip, f.nama_unitkerja 
							  FROM m_pegawai as d
                              LEFT JOIN tb_lokasi_unitkerja as e ON (d.id_lokasi_unitkerja = e.id_lokasi_unitkerja)
                              LEFT JOIN m_unitkerja as f ON (e.id_unitkerja = f.id_unitkerja)) 
                              as b ON (a.id_pemohon = b.id_admin) 
					LEFT JOIN (SELECT g.id_layanan_lab, g.nama_layanan, h.nama_lab, i.nama_lokasi, i.kabupaten 
							  FROM tb_layanan_lab as g 
                              LEFT JOIN m_lab as h ON (g.id_lab = h.id_lab)
                              LEFT JOIN m_lokasi as i ON (h.id_lokasi = i.id_lokasi)) 
                              as c ON (a.id_layanan = c.id_layanan_lab)
					LEFT JOIN (SELECT d.id_admin, d.nama_pegawai, d.nip, f.nama_unitkerja 
							  FROM m_pegawai as d
                              LEFT JOIN tb_lokasi_unitkerja as e ON (d.id_lokasi_unitkerja = e.id_lokasi_unitkerja)
                              LEFT JOIN m_unitkerja as f ON (e.id_unitkerja = f.id_unitkerja)) 
                              as d ON (a.id_pelaksana = d.id_admin)
					ORDER BY a.tgl_pengguna DESC";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}
	}

?>