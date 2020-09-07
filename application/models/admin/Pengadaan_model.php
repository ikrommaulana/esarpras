<?php
	class Pengadaan_model extends CI_Model{

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

		function get_all_pengadaan() {
			if($this->session->userdata('priviledge')==3) {
				$where = "WHERE respon_L1='Y'";
			} else {
				$where = "";
			} 
				// $sql = "SELECT a.*, b.pegasal, c.labnama, d.loklabkota
				// 	FROM tb_pengadaan as a 
				// 	LEFT JOIN tb_personil_daftar as b ON (a.pegnip = b.pegnip)
				// 	LEFT JOIN m_lab as c ON (b.idlab = c.idlab)
				// 	LEFT JOIN tb_lokasi_lab as d ON (b.idlab = d.idlab)
				// 	LEFT JOIN m_personil as e ON (a.pegnip = e.pegnip)
				// 	".$where." ORDER BY created_date DESC";
			$sql = "SELECT * FROM tb_pengadaan a LEFT JOIN tb_lokasi_lab b ON a.loklabid=b.loklabid LEFT JOIN m_lab c ON b.idlab=c.idlab WHERE c.idlab!='' ORDER BY created_date DESC";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}

		function get_all_pengadaan_by_lab($idlab) {
			if($this->session->userdata('priviledge')==3) {
				$where = "WHERE b.idlab='".$idlab."' AND a.respon_L1='Y'";
			} else {
				$where = "WHERE b.idlab='".$idlab."' ";
			}
			$sql = "SELECT * FROM tb_pengadaan a left join tb_lokasi_lab b on a.loklabid=b.loklabid ".$where." ORDER BY a.created_date DESC";
			//echo $sql;
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

		function get_lokasi_byuser() {
			$id = $this->session->userdata('admin_id');
			$get_admin = $this->db->query('select * from ci_admin where admin_id='.$id)->result();
			$pegnip = $get_admin[0]->pegnip;
			$sql = "SELECT m_personil.id_personil, m_personil.pegnip, m_personil.pegnama,
					tb_personil_daftar.idpegdaftar, tb_personil_daftar.pegasal, tb_personil_daftar.idlab,
					tb_lokasi_lab.loklabid, tb_lokasi_lab.loklabkota
					FROM
					m_personil
					INNER JOIN tb_personil_daftar ON m_personil.pegnip = tb_personil_daftar.pegnip
					INNER JOIN tb_lokasi_lab ON tb_personil_daftar.idlab = tb_lokasi_lab.idlab
					WHERE
					m_personil.pegnip = '$pegnip'";
			$query = $this->db->query($sql)->result_array();
			return $query;
		}
	}


?>