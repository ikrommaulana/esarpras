	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Personil_training extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
			$data['all_personil_training'] =  $this->master_model->get_all_simple_master('tb_personil_training');
			$data['title'] = 'Personil Training';
			$data['view'] = 'admin/personil_training/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_personil_training','idtra');
		}

		function add($pegnip=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('TraSelesai', 'Training Selesai', 'trim|required');
				$this->form_validation->set_rules('TraLembaga', 'Lembaga Training', 'trim|required');
				$this->form_validation->set_rules('TraKota', 'Kota', 'trim|required');
				$this->form_validation->set_rules('TraNegara', 'Negara', 'trim|required');
				$this->form_validation->set_rules('TraNmTraining', 'Nama Training', 'trim|required');
				$this->form_validation->set_rules('TraNoSertKesertaan', 'No Sertifikat Kesertaan', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['pegnip'] = $pegnip;
					$data['peg'] = $this->master_model->get_master('m_personil','pegnip',$pegnip);
					$data['all_peg'] = $this->master_model->get_master('m_personil');
					$data['view'] = 'admin/personil_training/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'traselesai' => date('Y-m-d',strtotime($this->input->post('TraSelesai'))),
						'tralembaga' => $this->input->post('TraLembaga'),
						'trakota' => $this->input->post('TraKota'),
						'tranegara' => $this->input->post('TraNegara'),
						'tranmtraining' => $this->input->post('TraNmTraining'),
						'tranosertkesertaan' => $this->input->post('TraNoSertKesertaan'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_personil_training',$data);

					$pegnip = $this->input->post('PegNIP');
					$getpeg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
					$idpeg = $getpeg['id_personil'];
					
					if($result){
						$this->session->set_flashdata('msg', 'New Personil Training has been added successfully!');
						redirect(base_url('admin/personil/edit/'.$idpeg));
					}
				}
			}
			else{
				$data['pegnip'] = $pegnip;
				$data['peg'] = $this->master_model->get_master('m_personil','pegnip',$pegnip);
				$data['all_peg'] = $this->master_model->get_master('m_personil');
				$data['view'] = 'admin/personil_training/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('TraSelesai', 'Training Selesai', 'trim|required');
				$this->form_validation->set_rules('TraLembaga', 'Lembaga Training', 'trim|required');
				$this->form_validation->set_rules('TraKota', 'Kota', 'trim|required');
				$this->form_validation->set_rules('TraNegara', 'Negara', 'trim|required');
				$this->form_validation->set_rules('TraNmTraining', 'Nama Training', 'trim|required');
				$this->form_validation->set_rules('TraNoSertKesertaan', 'No Sertifikat Kesertaan', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/personil_training/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'traselesai' => date('Y-m-d',strtotime($this->input->post('TraSelesai'))),
						'tralembaga' => $this->input->post('TraLembaga'),
						'trakota' => $this->input->post('TraKota'),
						'tranegara' => $this->input->post('TraNegara'),
						'tranmtraining' => $this->input->post('TraNmTraining'),
						'tranosertkesertaan' => $this->input->post('TraNoSertKesertaan')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_personil_training','idtra',$data, $id);

					$pegnip = $this->input->post('PegNIP');
					$getpeg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
					$idpeg = $getpeg['id_personil'];

					if($result){
						$this->session->set_flashdata('msg', 'Personil Training has been updated successfully!');
						redirect(base_url('admin/personil/edit/'.$idpeg));
					}
				}
			}
			else{
				$data['personil_training'] = $this->master_model->get_master_by_id('tb_personil_training','idtra',$id);
				$data['view'] = 'admin/personil_training/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$pegnip)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_personil_training', array('idtra' => $id));
			$this->session->set_flashdata('msg', 'Personil Training has been deleted successfully!');
			
			$getpeg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
			$idpeg = $getpeg['id_personil'];

			redirect(base_url('admin/personil/edit/'.$idpeg));
		}

	}


?>