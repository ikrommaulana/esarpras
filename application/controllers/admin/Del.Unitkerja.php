	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Unitkerja extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_unitkerja'] =  $this->master_model->get_all_simple_master('m_unitkerja');
			$data['title'] = 'Data Unit Kerja';
			$data['view'] = 'admin/unitkerja/unitkerja_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('m_unitkerja','kode_unitkerja');
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('kode_unitkerja', 'Kode Unit Kerja', 'trim|required');
				$this->form_validation->set_rules('nama_unitkerja', 'Nama Unit Kerja', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/unitkerja/unitkerja_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'kode_unitkerja' => $this->input->post('kode_unitkerja'),
						'nama_unitkerja' => $this->input->post('nama_unitkerja'),
						'is_active' => 1,
						'created_at' => date('Y-m-d'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('m_unitkerja',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Unit Kerja has been added successfully!');
						redirect(base_url('admin/unitkerja'));
					}
				}
			}
			else{
				$data['view'] = 'admin/unitkerja/unitkerja_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('kode_unitkerja', 'Kode Unit Kerja', 'trim|required');
				$this->form_validation->set_rules('nama_unitkerja', 'Nama Unit Kerja', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/unitkerja/unitkerja_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'kode_unitkerja' => $this->input->post('kode_unitkerja'),
						'nama_unitkerja' => $this->input->post('nama_unitkerja'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_unitkerja','kode_unitkerja',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Unit Kerja has been updated successfully!');
						redirect(base_url('admin/unitkerja'));
					}
				}
			}
			else{
				$data['unitkerja'] = $this->master_model->get_master_by_id('m_unitkerja','kode_unitkerja',$id);
				$data['view'] = 'admin/unitkerja/unitkerja_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_unitkerja', array('kode_unitkerja' => $id));
			$this->session->set_flashdata('msg', 'Unit Kerja has been deleted successfully!');
			redirect(base_url('admin/unitkerja'));
		}

	}


?>