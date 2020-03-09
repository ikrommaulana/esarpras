	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Mitra extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_data'] =  $this->master_model->get_all_simple_master('m_mitra');
			$data['title'] = 'Mitra';
			$data['page'] = 'mitra';
			$data['view'] = 'admin/mitra/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('m_mitra','mitra_id');
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('MitraInst', 'Institusi', 'trim|required');
				$this->form_validation->set_rules('MitraKat[]', 'Kategori', 'trim|required');
				$this->form_validation->set_rules('MitraBid', 'Bidang', 'trim|required');
				$this->form_validation->set_rules('MitraPIC', 'PIC', 'trim|required');
				$this->form_validation->set_rules('MitraAlamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('MitraTelp', 'Telp', 'trim|required');
				$this->form_validation->set_rules('MitraEmail', 'Email', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Mitra';
					$data['page'] = 'mitra';
					$data['view'] = 'admin/mitra/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'mitrainst'	=> $this->input->post('MitraInst'),
						'mitrakat' 	=> implode(',',$this->input->post('MitraKat')),
						'mitrabid' 	=> $this->input->post('MitraBid'),
						'mitrapic' 	=> $this->input->post('MitraPIC'),
						'mitraalmt' => $this->input->post('MitraAlamat'),
						'mitratelp' => $this->input->post('MitraTelp'),
						'mitraemail'=> $this->input->post('MitraEmail'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					// print_r($data);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('m_mitra',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Mitra has been added successfully!');
						redirect(base_url('admin/mitra'));
					}
				}
			}
			else{
			$data['title'] = 'Mitra';
			$data['page'] = 'mitra';
			$data['view'] = 'admin/mitra/add';
			$this->load->view('layout', $data);
			}
			
		}

		/**function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('MitraInst', 'Institusi', 'trim|required');
				$this->form_validation->set_rules('MitraKat', 'Kategori', 'trim|required');
				$this->form_validation->set_rules('MitraBid', 'Bidang', 'trim|required');
				$this->form_validation->set_rules('MitraPIC', 'PIC', 'trim|required');
				$this->form_validation->set_rules('MitraAlamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('MitraTelp', 'Telp', 'trim|required');
				$this->form_validation->set_rules('MitraEmail', 'Email', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/mitra/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'mitrainst'	=> $this->input->post('MitraInst'),
						'mitrakat' 	=> $this->input->post('MitraKat'),
						'mitrabid' 	=> $this->input->post('MitraBid'),
						'mitrapic' 	=> $this->input->post('MitraPIC'),
						'mitraalmt' => $this->input->post('MitraAlamat'),
						'mitratelp' => $this->input->post('MitraTelp'),
						'mitraemail'=> $this->input->post('MitraEmail')
					);
					//print_r($data);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_mitra','mitra_id',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Mitra has been updated successfully!');
						redirect(base_url('admin/mitra'));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('m_mitra','mitra_id',$id);
				$data['title'] = 'Mitra';
				$data['page'] = 'mitra';
				$data['view'] = 'admin/mitra/edit';
				$this->load->view('layout', $data);
			}
		}**/

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submitMitra')){
				$this->form_validation->set_rules('MitraInst', 'Institusi', 'trim|required');
				$this->form_validation->set_rules('MitraKat[]', 'Kategori', 'trim|required');
				$this->form_validation->set_rules('MitraBid', 'Bidang', 'trim|required');
				$this->form_validation->set_rules('MitraPIC', 'PIC', 'trim|required');
				$this->form_validation->set_rules('MitraAlamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('MitraTelp', 'Telp', 'trim|required');
				$this->form_validation->set_rules('MitraEmail', 'Email', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['data'] = $this->master_model->get_master_by_id('m_mitra','mitra_id',$id);
					$data['title'] = 'Mitra';
					$data['page'] = 'mitra';
					$data['view'] = 'admin/mitra/edit_mitra';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'mitrainst'	=> $this->input->post('MitraInst'),
						'mitrakat' 	=> implode(',',$this->input->post('MitraKat')),
						'mitrabid' 	=> $this->input->post('MitraBid'),
						'mitrapic' 	=> $this->input->post('MitraPIC'),
						'mitraalmt' => $this->input->post('MitraAlamat'),
						'mitratelp' => $this->input->post('MitraTelp'),
						'mitraemail'=> $this->input->post('MitraEmail')
					);
					//print_r($data);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_mitra','mitra_id',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Mitra has been updated successfully!');
						redirect(base_url('admin/mitra'));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('m_mitra','mitra_id',$id);
				$data['title'] = 'Mitra';
				$data['page'] = 'mitra';
				$data['view'] = 'admin/mitra/edit_mitra';
				$this->load->view('layout', $data);
			}
		}

		function view($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			$data['data'] = $this->master_model->get_master_by_id('m_mitra','mitra_id',$id);
			$data['title'] = 'Data Mitra';
			$data['page'] = 'mitra';
			$data['view'] = 'admin/mitra/view_mitra';
			$this->load->view('layout', $data);
			
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_mitra', array('mitra_id' => $id));
			$this->session->set_flashdata('msg', 'Mitra has been deleted successfully!');
			redirect(base_url('admin/mitra'));
		}

	}


?>