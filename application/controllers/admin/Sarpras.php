	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Sarpras extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_sarpras'] =  $this->master_model->get_all_simple_master('tb_sarpras');
			$data['title'] = 'Data Sarpras';
			$data['view'] = 'admin/sarpras/sarpras_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_sarpras','nup_sarpras');
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('nup_sarpras', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('nama_sarpras', 'Nama Sarpras', 'trim|required');
				$this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'trim|required');
				$this->form_validation->set_rules('fungsi', 'Fungsi', 'trim|required');
				$this->form_validation->set_rules('id_kontrak', 'Kontrak', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/sarpras/sarpras_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'nup_sarpras' => $this->input->post('nup_sarpras'),
						'nama_sarpras' => $this->input->post('nama_sarpras'),
						'spesifikasi' => $this->input->post('spesifikasi'),
						'fungsi' => $this->input->post('fungsi'),
						'id_kontrak' => $this->input->post('id_kontrak'),
						'foto_sarpras' => $this->_uploadImage($this->input->post('nup_sarpras')),
						'is_active' => 1,
						'created_at' => date('Y-m-d'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_sarpras',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Sarpras has been added successfully!');
						redirect(base_url('admin/sarpras'));
					}
				}
			}
			else{
				$data['kontrak'] = $this->master_model->get_master('tb_kontrak');
				$data['view'] = 'admin/sarpras/sarpras_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('nama_sarpras', 'Nama Sarpras', 'trim|required');
				$this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'trim|required');
				$this->form_validation->set_rules('fungsi', 'Fungsi', 'trim|required');
				$this->form_validation->set_rules('id_kontrak', 'Kontrak', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/sarpras/sarpras_edit';
					$this->load->view('layout', $data);
				}else{
					if($this->input->post('image_sarpras')){
						$data = array(
							'nama_sarpras' => $this->input->post('nama_sarpras'),
							'spesifikasi' => $this->input->post('spesifikasi'),
							'fungsi' => $this->input->post('fungsi'),
							'id_kontrak' => $this->input->post('id_kontrak'),
							'foto_sarpras' => $this->_uploadImage($this->input->post('nup_sarpras'))
						);
					}else{
						$data = array(
							'nama_sarpras' => $this->input->post('nama_sarpras'),
							'spesifikasi' => $this->input->post('spesifikasi'),
							'fungsi' => $this->input->post('fungsi'),
							'id_kontrak' => $this->input->post('id_kontrak')
						);
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_sarpras','nup_sarpras',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Sarpras has been updated successfully!');
						redirect(base_url('admin/sarpras'));
					}
				}
			}
			else{
				$data['kontrak'] = $this->master_model->get_master('tb_kontrak');
				$data['sarpras'] = $this->master_model->get_master_by_id('tb_sarpras','nup_sarpras',$id);
				$data['view'] = 'admin/sarpras/sarpras_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_sarpras', array('nup_sarpras' => $id));
			$this->session->set_flashdata('msg', 'Sarpras has been deleted successfully!');
			redirect(base_url('admin/sarpras'));
		}

		private function _uploadImage($nup_sarpras)
		{
		    $config['upload_path']          = './uploads/images/sarpras';
		    $config['allowed_types']        = 'jpg|jpeg|gif|png';
		    $config['file_name']            = "sarpras_".$nup_sarpras."_".time();
		    $config['overwrite']			= true;
		    $config['max_size']             = 4096; // 4MB

		    $this->load->library('upload', $config);
  			$this->upload->initialize($config);

		    if ($this->upload->do_upload('image_sarpras')) {
		        $image = $this->upload->data('file_name');
		    }else{
		    	$image = " ";
		    }
		    return $image;
		}

	}


?>