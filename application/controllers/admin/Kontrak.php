	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Kontrak extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_kontrak'] =  $this->master_model->get_all_simple_master('tb_kontrak');
			$data['title'] = 'Data Kontrak';
			$data['view'] = 'admin/kontrak/kontrak_list';
			$this->load->view('layout', $data);
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_mitra', 'Mitra', 'trim|required');
				$this->form_validation->set_rules('perihal_kontrak', 'Perihal Kontrak', 'trim|required');
				$this->form_validation->set_rules('tgl_kontrak', 'Tanggal Kontrak', 'trim|required');
				$this->form_validation->set_rules('nilai_kontrak', 'Nilai Kontrak', 'trim|required');
				$this->form_validation->set_rules('masa_berlaku', 'Masa Berlaku', 'trim|required');
				$this->form_validation->set_rules('masa_garansi', 'Masa Garansi', 'trim|required');
				$this->form_validation->set_rules('sla_kontrak', 'SLA Kontrak', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/kontrak/kontrak_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'kode_kontrak' => "KONTRAK-".$this->input->post('id_mitra')."/".
											date("Y/m/d", strtotime($this->input->post('tgl_kontrak'))),
						'id_mitra' => $this->input->post('id_mitra'),
						'perihal_kontrak' => $this->input->post('perihal_kontrak'),
						'tgl_kontrak' => date("Y-m-d", strtotime($this->input->post('tgl_kontrak'))),
						'nilai_kontrak' => $this->input->post('nilai_kontrak'),
						'masa_berlaku' => date("Y-m-d", strtotime($this->input->post('masa_berlaku'))),
						'masa_garansi' => date("Y-m-d", strtotime($this->input->post('masa_garansi'))),
						'sla_kontrak' => $this->input->post('sla_kontrak'),
						'penandatanganan' => $this->input->post('penandatanganan'),
						'file_kontrak' => $this->_uploadImage($this->input->post('id_mitra')),
						'created_at' => date('Y-m-d'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_kontrak',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Kontrak has been added successfully!');
						redirect(base_url('admin/kontrak'));
					}
				}
			}
			else{
				$data['mitra'] = $this->master_model->get_master('m_mitra');
				$data['view'] = 'admin/kontrak/kontrak_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('perihal_kontrak', 'Perihal Kontrak', 'trim|required');
				$this->form_validation->set_rules('tgl_kontrak', 'Tanggal Kontrak', 'trim|required');
				$this->form_validation->set_rules('nilai_kontrak', 'Nilai Kontrak', 'trim|required');
				$this->form_validation->set_rules('masa_berlaku', 'Masa Berlaku', 'trim|required');
				$this->form_validation->set_rules('masa_garansi', 'Masa Garansi', 'trim|required');
				$this->form_validation->set_rules('sla_kontrak', 'SLA Kontrak', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/kontrak/kontrak_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'perihal_kontrak' => $this->input->post('perihal_kontrak'),
						'tgl_kontrak' => date("Y-m-d", strtotime($this->input->post('tgl_kontrak'))),
						'nilai_kontrak' => $this->input->post('nilai_kontrak'),
						'masa_berlaku' => date("Y-m-d", strtotime($this->input->post('masa_berlaku'))),
						'masa_garansi' => date("Y-m-d", strtotime($this->input->post('masa_garansi'))),
						'sla_kontrak' => $this->input->post('sla_kontrak'),
						'penandatanganan' => $this->input->post('penandatanganan')
					);
					$uploadpdf = $this->_uploadImage($this->input->post('id_mitra'));
					if($uploadpdf){
						$data['file_kontrak'] = $uploadpdf;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_kontrak','id_kontrak',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Kontrak has been updated successfully!');
						redirect(base_url('admin/kontrak'));
					}
				}
			}
			else{
				$data['mitra'] = $this->master_model->get_master('m_mitra');
				$data['kontrak'] = $this->master_model->get_master_by_id('tb_kontrak','id_kontrak',$id);
				$data['view'] = 'admin/kontrak/kontrak_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_kontrak', array('id_kontrak' => $id));
			$this->session->set_flashdata('msg', 'Kontrak has been deleted successfully!');
			redirect(base_url('admin/kontrak'));
		}

		function view($id){
			$data['kontrak'] =  $this->master_model->get_master_by_id('tb_kontrak','id_kontrak',$id);
			$data['title'] = 'File Kontrak';
			$data['view'] = 'admin/kontrak/file_kontrak';
			$this->load->view('layout', $data);
		}

		private function _uploadImage($id_mitra)
		{
		    $config['upload_path']          = './uploads/files/';
		    $config['allowed_types']        = 'pdf|doc|docx';
		    $config['file_name']            = "kontrak_".$id_mitra."_".time();
		    $config['overwrite']			= true;
		    $config['max_size']             = 4096; // 4MB

		    $this->load->library('upload', $config);
  			$this->upload->initialize($config);

		    if ($this->upload->do_upload('file_kontrak')) {
		        $image = $this->upload->data('file_name');
		    }else{
		    	$image = " ";
		    }
		    return $image;
		}

	}


?>