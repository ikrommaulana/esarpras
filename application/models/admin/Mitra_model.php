<?php
	class Mitra_model extends CI_Model{

		public function add_mitra($data){
			$this->db->insert('tb_mitra', $data);
			return true;
		}

		//---------------------------------------------------
		// get all user records for simple datatable example
		public function get_all_simple_mitra(){

			$query = $this->db->get('tb_mitra');
			return $result = $query->result_array();
		}
		//---------------------------------------------------
		// get all  for server-side datatable processing (ajax based)
		public function get_all_mitra(){
			$wh =array();
			$SQL ='SELECT * FROM tb_mitra';
			$wh[] = " ";
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
		// Get mitra detial by ID
		public function get_mitra_by_id($id){
			$query = $this->db->get_where('tb_mitra', array('id_mitra' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit mitra Record
		public function edit_mitra($data, $id){
			$this->db->where('id_mitra', $id);
			$this->db->update('tb_mitra', $data);
			return true;
		}

		//---------------------------------------------------
		// Change mitra status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id_mitra', $this->input->post('id'));
			$this->db->update('tb_mitra');
		} 

	}

?>