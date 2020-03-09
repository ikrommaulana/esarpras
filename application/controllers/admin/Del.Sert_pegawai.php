	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Sert_pegawai extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_sertifikat'] =  $this->master_model->get_where_master('tb_sertifikat_detail','param','pegawai');
			$data['title'] = 'Sertifikat Pegawai';
			$data['view'] = 'admin/sert_pegawai/sert_pegawai_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_sertifikat_detail','id_sert_detail');
		}

		function add(){
			
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('nip', 'Nama Pegawai', 'trim|required');
				$this->form_validation->set_rules('id_sertifikat', 'Kode Sertifikat', 'trim|required');
				$this->form_validation->set_rules('masa_berlaku', 'Masa Berlaku', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/sert_pegawai/sert_pegawai_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'param' => 'pegawai',
						'sertifikat_user' => $this->input->post('nip'),
						'id_sertifikat' => $this->input->post('id_sertifikat'),
						'masa_berlaku' => date("Y-m-d", strtotime($this->input->post('masa_berlaku'))),
						'is_active' => 1,
						'created_at' => date('Y-m-d'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$uploadpdf = $this->_uploadSert("pegawai_".$this->input->post('nip')."_".$this->input->post('id_sertifikat'));
					if($uploadpdf){
						$data['file_sert'] = $uploadpdf;
					}

					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_sertifikat_detail',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Sertifikat Pegawai has been added successfully!');
						redirect(base_url('admin/sert_pegawai'));
					}
				}
			}
			else{
				$data['pegawai'] = $this->master_model->get_master('m_pegawai');
				$data['sertifikat'] = $this->master_model->get_master('m_sertifikat');
				$data['view'] = 'admin/sert_pegawai/sert_pegawai_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('nip', 'Nama Pegawai', 'trim|required');
				$this->form_validation->set_rules('id_sertifikat', 'Kode Sertifikat', 'trim|required');
				$this->form_validation->set_rules('masa_berlaku', 'Masa Berlaku', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/sert_pegawai/sert_pegawai_edit';
					$this->load->view('layout', $data);
				}else{
					$nip = $this->input->post('nip');
					$id_sert = $this->input->post('id_sertifikat');
					$data = array(
						'sertifikat_user' => $nip,
						'id_sertifikat' => $id_sert,
						'masa_berlaku' => date("Y-m-d", strtotime($this->input->post('masa_berlaku')))
					);
					$uploadpdf = $this->_uploadSert("pegawai_".$this->input->post('nip')."_".$this->input->post('id_sertifikat'));
					if($uploadpdf){
						$data['file_sert'] = $uploadpdf;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_sertifikat_detail','id_sert_detail',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Sertifikat has been updated successfully!');
						redirect(base_url('admin/sert_pegawai'));
					}
				}
			}
			else{
				$data['pegawai'] = $this->master_model->get_master('m_pegawai');
				$data['sertifikat'] = $this->master_model->get_master('m_sertifikat');
				$data['sert_pegawai'] = $this->master_model->get_master_by_id('tb_sertifikat_detail','id_sert_detail',$id);
				$data['view'] = 'admin/sert_pegawai/sert_pegawai_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_sertifikat_detail', array('id_sert_detail' => $id));
			$this->session->set_flashdata('msg', 'Sertifikat has been deleted successfully!');
			redirect(base_url('admin/sert_pegawai'));
		}

		function view($id){
			$data['sert'] =  $this->master_model->get_master_by_id('tb_sertifikat_detail','id_sert_detail',$id);
			$data['title'] = 'File Sertifikat';
			$data['view'] = 'admin/sert_pegawai/file_sert';
			$this->load->view('layout', $data);
		}

		private function _uploadSert($sert_name)
		{
		    $config['upload_path']          = './uploads/files/';
		    $config['allowed_types']        = 'pdf|doc|docx';
		    $config['file_name']            = $sert_name;
		    $config['overwrite']			= true;
		    $config['max_size']             = 4096; // 4MB

		    $this->load->library('upload', $config);
  			$this->upload->initialize($config);

		    if ($this->upload->do_upload('file_sert')) {
		        $image = $this->upload->data('file_name');
		    }else{
		    	$image = " ";
		    }
		    return $image;
		}

	}


?>