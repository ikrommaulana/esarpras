	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Lab extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_lab'] =  $this->master_model->get_all_simple_master('m_lab');
			$data['title'] = 'Data Laboratorium';
			$data['view'] = 'admin/lab/lab_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('m_lab','id_lab');
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('nama_lab', 'Nama Lab', 'trim|required');
				$this->form_validation->set_rules('id_lokasi', 'Lokasi', 'trim|required');
				$this->form_validation->set_rules('id_unitkerja', 'Unit Kerja', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/lab/lab_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'nama_lab' => $this->input->post('nama_lab'),
						'id_lokasi' => $this->input->post('id_lokasi'),
						'id_unitkerja' => $this->input->post('id_unitkerja'),
						'is_active' => 1,
						'created_at' => date('Y-m-d'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('m_lab',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Laboratorium has been added successfully!');
						redirect(base_url('admin/lab'));
					}
				}
			}
			else{
				$data['lokasi'] = $this->master_model->get_master('m_lokasi');
				$data['unitkerja'] = $this->master_model->get_master('m_unitkerja');
				$data['view'] = 'admin/lab/lab_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('nama_lab', 'Nama Lab', 'trim|required');
				$this->form_validation->set_rules('id_lokasi', 'Lokasi', 'trim|required');
				$this->form_validation->set_rules('id_unitkerja', 'Unit Kerja', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/lab/lab_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'nama_lab' => $this->input->post('nama_lab'),
						'id_lokasi' => $this->input->post('id_lokasi'),
						'id_unitkerja' => $this->input->post('id_unitkerja')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_lab','id_lab',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Lab has been updated successfully!');
						redirect(base_url('admin/lab'));
					}
				}
			}
			else{
				$data['lokasi'] = $this->master_model->get_master('m_lokasi');
				$data['unitkerja'] = $this->master_model->get_master('m_unitkerja');
				$data['lab'] = $this->master_model->get_master_by_id('m_lab','id_lab',$id);
				$data['view'] = 'admin/lab/lab_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_lab', array('id_lab' => $id));
			$this->session->set_flashdata('msg', 'Laboratorium has been deleted successfully!');
			redirect(base_url('admin/sarpras'));
		}

	}


?>