	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Sertifikat extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_sertifikat'] =  $this->master_model->get_all_simple_master('m_sertifikat');
			$data['title'] = 'Data Sertifikat';
			$data['view'] = 'admin/sertifikat/sertifikat_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('m_sertifikat','id_sertifikat');
		}

		function add(){
			
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('kode_sertifikat', 'Kode Sertifikat', 'trim|required');
				$this->form_validation->set_rules('fungsi_sertifikat', 'Fungsi Sertifikat', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/sertifikat/sertifikat_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'kode_sertifikat' => $this->input->post('kode_sertifikat'),
						'fungsi_sertifikat' => $this->input->post('fungsi_sertifikat'),
						'penerbit' => $this->input->post('penerbit'),
						'is_active' => 1
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('m_sertifikat',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Sertifikat has been added successfully!');
						redirect(base_url('admin/sertifikat'));
					}
				}
			}
			else{
				$data['view'] = 'admin/sertifikat/sertifikat_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('kode_sertifikat', 'Kode Sertifikat', 'trim|required');
				$this->form_validation->set_rules('fungsi_sertifikat', 'Fungsi Sertifikat', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/sertifikat/sertifikat_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'kode_sertifikat' => $this->input->post('kode_sertifikat'),
						'fungsi_sertifikat' => $this->input->post('fungsi_sertifikat'),
						'penerbit' => $this->input->post('penerbit'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_sertifikat','id_sertifikat',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Sertifikat has been updated successfully!');
						redirect(base_url('admin/sertifikat'));
					}
				}
			}
			else{
				$data['sertifikat'] = $this->master_model->get_master_by_id('m_sertifikat','id_sertifikat',$id);
				$data['view'] = 'admin/sertifikat/sertifikat_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_sertifikat', array('id_sertifikat' => $id));
			$this->session->set_flashdata('msg', 'Sertifikat has been deleted successfully!');
			redirect(base_url('admin/sertifikat'));
		}

	}


?>