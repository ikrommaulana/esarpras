	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Kontrak_mitra extends MY_Controller {

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
			$this->master_model->change_status('tb_kontrak_mitra','konmitid');
		}

		function add($mitra_id=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('KonMitKode', 'Kode Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitPerihal', 'Perihal Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitTgl', 'Tanggal Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitNilai', 'Nilai Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitValid', 'Masa Berlaku', 'trim|required');
				$this->form_validation->set_rules('KonMitGaransi', 'Masa Garansi', 'trim|required');
				$this->form_validation->set_rules('KonMitSLA', 'SLA Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitTtd', 'Ttd Kontrak', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Kontrak Mitra';
					$data['page'] = 'kontrak_mitra';
					$data['mitra_id'] = $mitra_id;
					$data['mitra'] = $this->master_model->get_master_by_id('m_mitra','mitra_id',$mitra_id);
					$data['all_mitra'] = $this->master_model->get_master('m_mitra');
					$data['view'] = 'admin/kontrak_mitra/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'mitra_id' => $this->input->post('MitraId'),
						'konmitkode' => $this->input->post('KonMitKode'),
						'konmitperihal' => $this->input->post('KonMitPerihal'),
						'konmittgl' => date('Y-m-d',strtotime($this->input->post('KonMitTgl'))),
						'konmitnilai' => $this->input->post('KonMitNilai'),
						'konmitvalid' => date('Y-m-d',strtotime($this->input->post('KonMitValid'))),
						'konmitgaransi' => date('Y-m-d',strtotime($this->input->post('KonMitGaransi'))),
						'konmitsla' => $this->input->post('KonMitSLA'),
						'konmitttd' => $this->input->post('KonMitTtd'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$uploadfile = $this->_uploadImage($this->input->post('KonMitKode'));
					if($uploadfile!=""){
						$data['konmitfile'] = $uploadfile;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_kontrak_mitra',$data);

					$id = $this->input->post('MitraId');

					if($result){
						$this->session->set_flashdata('msg', 'New Kontrak Mitra has been added successfully!');
						redirect(base_url('admin/mitra/edit/'.$id));
					}
				}
			}
			else{
				$data['title'] = 'Kontrak Mitra';
				$data['page'] = 'kontrak_mitra';
				$data['mitra_id'] = $mitra_id;
				$data['mitra'] = $this->master_model->get_master_by_id('m_mitra','mitra_id',$mitra_id);
				$data['all_mitra'] = $this->master_model->get_master('m_mitra');
				$data['view'] = 'admin/kontrak_mitra/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('KonMitKode', 'Kode Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitPerihal', 'Perihal Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitTgl', 'Tanggal Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitNilai', 'Nilai Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitValid', 'Masa Berlaku', 'trim|required');
				$this->form_validation->set_rules('KonMitGaransi', 'Masa Garansi', 'trim|required');
				$this->form_validation->set_rules('KonMitSLA', 'SLA Kontrak', 'trim|required');
				$this->form_validation->set_rules('KonMitTtd', 'Ttd Kontrak', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['all_data'] = $this->master_model->get_master_by_id('tb_kontrak_mitra','konmitid',$id);
					$data['title'] = 'Kontrak Mitra';
					$data['page'] = 'kontrak_mitra';
					$data['view'] = 'admin/kontrak_mitra/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'mitra_id' => $this->input->post('MitraId'),
						'konmitkode' => $this->input->post('KonMitKode'),
						'konmitperihal' => $this->input->post('KonMitPerihal'),
						'konmittgl' => date('Y-m-d',strtotime($this->input->post('KonMitTgl'))),
						'konmitnilai' => $this->input->post('KonMitNilai'),
						'konmitvalid' => date('Y-m-d',strtotime($this->input->post('KonMitValid'))),
						'konmitgaransi' => date('Y-m-d',strtotime($this->input->post('KonMitGaransi'))),
						'konmitsla' => $this->input->post('KonMitSLA'),
						'konmitttd' => $this->input->post('KonMitTtd')
					);
					$uploadfile = $this->_uploadImage($this->input->post('KonMitKode'));
					if($uploadfile!=""){
						$data['konmitfile'] = $uploadfile;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_kontrak_mitra','konmitid',$data, $id);

					$id = $this->input->post('MitraId');

					if($result){
						$this->session->set_flashdata('msg', 'Kontrak Mitra has been updated successfully!');
						redirect(base_url('admin/mitra/edit/'.$id));
					}
				}
			}
			else{
				$data['all_data'] = $this->master_model->get_master_by_id('tb_kontrak_mitra','konmitid',$id);
				$data['title'] = 'Kontrak Mitra';
				$data['page'] = 'kontrak_mitra';
				$data['view'] = 'admin/kontrak_mitra/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$mitraid)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_kontrak_mitra', array('konmitid' => $id));
			$this->session->set_flashdata('msg', 'Kontrak Mitra has been deleted successfully!');

			redirect(base_url('admin/mitra/edit/'.$mitraid));
		}

		function view($id = 0)
		{
			$data['file'] =  $this->master_model->get_master_by_id('tb_kontrak_mitra','konmitid',$id);
			$data['title'] = 'File Kontrak Mitra';
			$data['view'] = 'admin/kontrak_mitra/file';
			$this->load->view('layout', $data);
		}

		private function _uploadImage($id)
		{
			$path = './uploads/files/kontrak_mitra/';
			if(!is_dir($path)){
			  mkdir($path);
			}
		    $config['upload_path']          = $path;
		    $config['allowed_types']        = 'jpeg|jpg|png|pdf';
		    $config['file_name']            = $id."_".time();
		    $config['overwrite']			= true;
		    $config['max_size']             = 4096;

		    $this->load->library('upload', $config);
  			$this->upload->initialize($config);

		    if ($this->upload->do_upload('KonMitFile')) {
		        $image = $this->upload->data('file_name');
		    }else{
		    	$image = " ";
		    }
		    return $image;
		}

	}


?>