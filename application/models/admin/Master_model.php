<?php
	class Master_model extends CI_Model{

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

		//-----------------------------------------------------

		function get_available_master($table1,$param,$table2){
			$query= $this->db->query('SELECT * FROM '.$table1.' WHERE '.$param.' NOT IN (SELECT '.$param.' FROM '.$table2.' ');
			return $query->result_array();
		}

		function get_available_personil_daftar(){
			$query= $this->db->query('SELECT * FROM m_personil WHERE pegnip NOT IN
				(SELECT pegnip FROM tb_personil_daftar a LEFT JOIN m_lab b ON a.idlab=b.idlab WHERE b.idlab!="")
				');
			return $query->result_array();
		}

		//---------------------------------------------------
		// get all master records for simple datatable example
		public function get_where_master($table,$where='',$param=''){
			$query = $this->db->get_where($table, array($where=>$param));
			return $result = $query->result_array();
		}

		//---------------------------------------------------
		// get all master records for simple datatable example
		public function get_where_master2($table,$where1='',$param1='',$where2='',$param2=''){
			$query = $this->db->get_where($table, array($where1=>$param1,$where2=>$param2));
			return $result = $query->result_array();
		}


		//---------------------------------------------------
		// get join table records for simple datatable example
		public function get_join_master($table1,$table2,$joins){
			$this->db->select('*');
			$this->db->from($table1);
			$this->db->join($table2,$joins);
			$query = $this->db->get();
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

		//---------------------------------------------------
		// Change pegawai status
		//-----------------------------------------------------
		function change_status_peg($table,$primary)
		{		
			$this->db->set('pegstatus', $this->input->post('status'));
			$this->db->where($primary, $this->input->post('id'));
			$this->db->update($table);
		} 

		// get all master records for simple datatable example
		function get_simple_master_by_id($table,$primary,$idlab){

			$query = $this->db->get_where($table, array($primary => $idlab));
			return $result = $query->result_array();
		}

		function get_all_penggunaan_by_lab($idlab) {
			if($this->session->userdata('priviledge')==3) {
				$where = "WHERE b.idlab='".$idlab."'";
			} else {
				$where = "WHERE b.idlab='".$idlab."' ";
			}
			$sql = "SELECT a.*,a.created_by as created_by FROM tb_layanan_lab_eks a left join tb_layanan_lab b on a.daflayid=b.daflayid ".$where." ORDER BY a.created_at DESC";
			//echo $sql;
			$query = $this->db->query($sql)->result_array();
			return $query;
		}


	}

?>