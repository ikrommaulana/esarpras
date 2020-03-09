<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Menu extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/menu_model', 'menu_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		public function index(){
			$data['all_menu'] =  $this->menu_model->get_all_simple_menu();
			$data['title'] = 'Menu List';
			$data['view'] = 'admin/menu/menu_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->menu_model->change_status();
		}

		public function add(){
			
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|required');
				$this->form_validation->set_rules('parent', 'Parent', 'trim|required');
				$this->form_validation->set_rules('controller', 'Controller', 'trim|required');
				$this->form_validation->set_rules('sort_order', 'Order', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/menu/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'module_name' => $this->input->post('menu_name'),
						'parent_name' => $this->input->post('parent'),
						'controller_name' => $this->input->post('controller'),
						'fa_icon' => $this->input->post('fa_icon'),
						'operation' => implode('|', $this->input->post('operation')),
						'sort_order' => $this->input->post('sort_order')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->menu_model->add_menu($data);
					if($result){
						$this->session->set_flashdata('msg', 'Menu has been added successfully!');
						redirect(base_url('admin/menu'));
					}
				}
			}
			else{
				$data['view'] = 'admin/menu/menu_add';
				$this->load->view('layout', $data);
			}
			
		}

		public function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|required');
				$this->form_validation->set_rules('parent', 'Parent', 'trim|required');
				$this->form_validation->set_rules('controller', 'Controller', 'trim|required');
				$this->form_validation->set_rules('sort_order', 'Order', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/menu/menu_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'module_name' => $this->input->post('menu_name'),
						'parent_name' => $this->input->post('parent'),
						'controller_name' => $this->input->post('controller'),
						'fa_icon' => $this->input->post('fa_icon'),
						'operation' => implode('|', $this->input->post('operation')),
						'sort_order' => $this->input->post('sort_order')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->menu_model->edit_menu($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Menu has been updated successfully!');
						redirect(base_url('admin/menu'));
					}
				}
			}
			else{
				$data['menu'] = $this->menu_model->get_menu_by_id($id);
				$data['view'] = 'admin/menu/menu_edit';
				$this->load->view('layout', $data);
			}
		}

		public function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('module', array('module_id' => $id));
			$this->session->set_flashdata('msg', 'Menu has been deleted successfully!');
			redirect(base_url('admin/menu'));
		}

	}


?>