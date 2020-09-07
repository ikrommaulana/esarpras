	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Personil_daftar extends MY_Controller {

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

		function add($idlab=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('IdLab', 'Laboratorium', 'trim|required');
				$this->form_validation->set_rules('PegAsal', 'Asal', 'trim|required');
				$this->form_validation->set_rules('PegStatus', 'Status', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['page'] = 'personil_daftar';
					$data['idlab'] = $idlab;
					$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$data['all_lab'] = $this->master_model->get_master('m_lab');
					$data['view'] = 'admin/personil_daftar/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'idlab' => $this->input->post('IdLab'),
						'pegasal' => $this->input->post('PegAsal'),
						'pegstatus' => $this->input->post('PegStatus'),
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_personil_daftar',$data);

					$idlab = $this->input->post('IdLab');
					
					if($result){
						$this->session->set_flashdata('msg', 'New Personil has been added successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$idlab));
					}
				}
			}
			else{$priviledge = $this->session->userdata('priviledge');
				if($priviledge==1){
					$data['all_lab'] =  $this->master_model->get_master_where('m_lab','idlab',$idlab);
				}else{
					$data['all_lab'] =  $this->master_model->get_master('m_lab');
				}
				$data['page'] = 'personil_daftar';
				$data['idlab'] = $idlab;
				$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
				// $data['all_lab'] = $this->master_model->get_master('m_lab');
				$data['view'] = 'admin/personil_daftar/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id=0){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('IdLab', 'Laboratorium', 'trim|required');
				$this->form_validation->set_rules('PegAsal', 'Asal', 'trim|required');
				$this->form_validation->set_rules('PegStatus', 'Status', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['pegdaftar'] = $this->master_model->get_master_by_id('tb_personil_daftar','idpegdaftar',$id);
					$data['page'] = 'personil_daftar';
					$data['view'] = 'admin/personil_daftar/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'idlab' => $this->input->post('IdLab'),
						'pegasal' => $this->input->post('PegAsal'),
						'pegstatus' => $this->input->post('PegStatus')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_personil_daftar','idpegdaftar',$data, $id);

					$idlab = $this->input->post('IdLab');
					
					if($result){
						$this->session->set_flashdata('msg', 'New Personil has been updated successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$idlab));
					}
				}
			}
			else{
				$data['pegdaftar'] = $this->master_model->get_master_by_id('tb_personil_daftar','idpegdaftar',$id);
				$data['page'] = 'personil_daftar';
				$data['view'] = 'admin/personil_daftar/edit';
				$this->load->view('layout', $data);
			}
			
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$getlab = $this->master_model->get_master_by_id('tb_personil_daftar','idpegdaftar',$id);
			$idlab = $getlab['idlab'];
			
			$this->db->delete('tb_personil_daftar', array('idpegdaftar' => $id));
			$this->session->set_flashdata('msg', 'Personil has been deleted successfully!');
			redirect(base_url('admin/identitas_lab/edit/'.$idlab));
		}

	}


?>