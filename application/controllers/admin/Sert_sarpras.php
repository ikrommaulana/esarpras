	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Sert_sarpras extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_sertifikat'] =  $this->master_model->get_where_master('tb_sertifikat_detail','param','sarpras');
			$data['title'] = 'Sertifikat Sarpras';
			$data['view'] = 'admin/sert_sarpras/sert_sarpras_list';
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
				$this->form_validation->set_rules('nup_sarpras', 'Nama Sarpras', 'trim|required');
				$this->form_validation->set_rules('id_sertifikat', 'Kode Sertifikat', 'trim|required');
				$this->form_validation->set_rules('masa_berlaku', 'Masa Berlaku', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/sert_sarpras/sert_sarpras_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'param' => 'sarpras',
						'sertifikat_user' => $this->input->post('nup_sarpras'),
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
						$this->session->set_flashdata('msg', 'New Sertifikat has been added successfully!');
						redirect(base_url('admin/sert_sarpras'));
					}
				}
			}
			else{
				$data['sarpras'] = $this->master_model->get_master('tb_sarpras');
				$data['sertifikat'] = $this->master_model->get_master('m_sertifikat');
				$data['view'] = 'admin/sert_sarpras/sert_sarpras_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('nup_sarpras', 'Nama Sarpras', 'trim|required');
				$this->form_validation->set_rules('id_sertifikat', 'Kode Sertifikat', 'trim|required');
				$this->form_validation->set_rules('masa_berlaku', 'Masa Berlaku', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/sert_sapras/sert_sapras_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'sertifikat_user' => $this->input->post('nup_sarpras'),
						'id_sertifikat' => $this->input->post('id_sertifikat'),
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
						redirect(base_url('admin/sert_sarpras'));
					}
				}
			}
			else{
				$data['sarpras'] = $this->master_model->get_master('tb_sarpras');
				$data['sertifikat'] = $this->master_model->get_master('m_sertifikat');
				$data['sert_sarpras'] = $this->master_model->get_master_by_id('tb_sertifikat_detail','id_sert_detail',$id);
				$data['view'] = 'admin/sert_sapras/sert_sapras_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_sertifikat_detail', array('id_sert_detail' => $id));
			$this->session->set_flashdata('msg', 'Sertifikat has been deleted successfully!');
			redirect(base_url('admin/sert_sapras'));
		}

		function view($id){
			$data['sert'] =  $this->master_model->get_master_by_id('tb_sertifikat_detail','id_sert_detail',$id);
			$data['title'] = 'File Sertifikat';
			$data['view'] = 'admin/sert_sarpras/file_sert';
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