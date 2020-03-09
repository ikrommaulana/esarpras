<?php
	class Menu_model extends CI_Model{

		public function add_menu($data){
			$this->db->insert('module', $data);
			return true;
		}

		//---------------------------------------------------
		// get all user records for simple datatable example
		public function get_all_simple_menu(){

			$this->db->order_by('parent_name', 'desc');
			$this->db->order_by('controller_name', 'asc');
			$query = $this->db->get('module');
			return $result = $query->result_array();
		}
		//---------------------------------------------------
		// get all  for server-side datatable processing (ajax based)
		public function get_all_menu(){
			$wh =array();
			$SQL ='SELECT * FROM module';
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
		// Get menu detial by ID
		public function get_menu_by_id($id){
			$query = $this->db->get_where('module', array('module_id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit menu Record
		public function edit_menu($data, $id){
			$this->db->where('module_id', $id);
			$this->db->update('module', $data);
			return true;
		}

		//---------------------------------------------------
		// Change menu status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('module_id', $this->input->post('module_id'));
			$this->db->update('module');
		} 

	}

?>