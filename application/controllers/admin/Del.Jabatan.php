	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Jabatan extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_jabatan'] =  $this->master_model->get_all_simple_master('m_jabatan');
			$data['title'] = 'Data Jabatan';
			$data['view'] = 'admin/jabatan/jabatan_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('m_jabatan','id_jabatan');
		}

		function add(){
			
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('kode_jabatan', 'Kode Jabatan', 'trim|required');
				$this->form_validation->set_rules('kode_kewenangan', 'Kode Kewenangan', 'trim|required');
				$this->form_validation->set_rules('fungsi_kewenangan', 'Fungsi Kewenangan', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/jabatan/jabatan_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'kode_jabatan' => $this->input->post('kode_jabatan'),
						'kode_kewenangan' => $this->input->post('kode_kewenangan'),
						'fungsi_kewenangan' => $this->input->post('fungsi_kewenangan'),
						'is_active' => 1
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('m_jabatan',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Jabatan has been added successfully!');
						redirect(base_url('admin/jabatan'));
					}
				}
			}
			else{
				$data['view'] = 'admin/jabatan/jabatan_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('kode_jabatan', 'Kode Jabatan', 'trim|required');
				$this->form_validation->set_rules('kode_kewenangan', 'Kode Kewenangan', 'trim|required');
				$this->form_validation->set_rules('fungsi_kewenangan', 'Fungsi Kewenangan', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/jabatan/jabatan_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'kode_jabatan' => $this->input->post('kode_jabatan'),
						'kode_kewenangan' => $this->input->post('kode_kewenangan'),
						'fungsi_kewenangan' => $this->input->post('fungsi_kewenangan')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_jabatan','id_jabatan',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Jabatan has been updated successfully!');
						redirect(base_url('admin/jabatan'));
					}
				}
			}
			else{
				$data['jabatan'] = $this->master_model->get_master_by_id('m_jabatan','id_jabatan',$id);
				$data['view'] = 'admin/jabatan/jabatan_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_jabatan', array('id_jabatan' => $id));
			$this->session->set_flashdata('msg', 'Jabatan has been deleted successfully!');
			redirect(base_url('admin/jabatan'));
		}

	}


?>