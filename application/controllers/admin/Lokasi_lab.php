	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Lokasi_lab extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_lokasi_lab','loklabid');
		}

		function add($idlab=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('LokLabAlamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('LokLabKota', 'Kota', 'trim|required');
				$this->form_validation->set_rules('LokLabProvinsi', 'Provinsi', 'trim|required');
				$this->form_validation->set_rules('LokLabTelp', 'Telp', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Lokasi Laboratorium';
					$data['page'] = 'lokasi_lab';
					$data['idlab'] = $idlab;
					$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$data['all_lab'] = $this->master_model->get_master('m_lab');
					$data['view'] = 'admin/lokasi_lab/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'idlab' => $this->input->post('IdLab'),
						'loklabalamat' => $this->input->post('LokLabAlamat'),
						'loklabkota' => $this->input->post('LokLabKota'),
						'loklabprovinsi' => $this->input->post('LokLabProvinsi'),
						'loklabtelp' => $this->input->post('LokLabTelp'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_lokasi_lab',$data);

					$idlab = $this->input->post('IdLab');
					$getlab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$id = $getlab['idlab'];

					if($result){
						$this->session->set_flashdata('msg', 'New Lokasi Laboratorium has been added successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$id));
					}
				}
			}
			else{
				$data['title'] = 'Lokasi Laboratorium';
				$data['page'] = 'lokasi_lab';
				$data['idlab'] = $idlab;
				$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
				$data['all_lab'] = $this->master_model->get_master('m_lab');
				$data['view'] = 'admin/lokasi_lab/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('LokLabAlamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('LokLabKota', 'Kota', 'trim|required');
				$this->form_validation->set_rules('LokLabProvinsi', 'Provinsi', 'trim|required');
				$this->form_validation->set_rules('LokLabTelp', 'Telp', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['all_data'] = $this->master_model->get_master_by_id('tb_lokasi_lab','loklabid',$id);
					$data['title'] = 'Lokasi Laboratorium';
					$data['page'] = 'lokasi_lab';
					$data['view'] = 'admin/lokasi_lab/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'idlab' => $this->input->post('IdLab'),
						'loklabalamat' => $this->input->post('LokLabAlamat'),
						'loklabkota' => $this->input->post('LokLabKota'),
						'loklabprovinsi' => $this->input->post('LokLabProvinsi'),
						'loklabtelp' => $this->input->post('LokLabTelp')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_lokasi_lab','loklabid',$data, $id);

					$idlab = $this->input->post('IdLab');
					$getlab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$id = $getlab['idlab'];

					if($result){
						$this->session->set_flashdata('msg', 'Lokasi Laboratorium has been updated successfully!');
						redirect(base_url('admin/lokasi_lab/edit/'.$id));
					}
				}
			}
			else{
				$data['all_data'] = $this->master_model->get_master_by_id('tb_lokasi_lab','loklabid',$id);
				$data['title'] = 'Lokasi Laboratorium';
				$data['page'] = 'lokasi_lab';
				$data['view'] = 'admin/lokasi_lab/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$idlab)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_lokasi_lab', array('loklabid' => $id));
			$this->session->set_flashdata('msg', 'Lokasi Laboratorium has been deleted successfully!');

			redirect(base_url('admin/identitas_lab/edit/'.$idlab));
		}

	}


?>