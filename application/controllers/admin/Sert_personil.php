	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Sert_personil extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_sertifikat_personil');
			$data['title'] = 'Sertifikat Personil';
			$data['page'] = 'sert_personil';
			$data['view'] = 'admin/sert_personil/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_sertifikat_personil','idsertps');
		}

		function add($pegnip=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('SertPsNo', 'No Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsNama', 'Nama Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsPemberi', 'Pemberi Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsLingkup', 'Lingkup Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsTglSert', 'Tanggal Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsTglAkr', 'Tanggal Akhir', 'trim|required');
				$this->form_validation->set_rules('SertPsTtd', 'Ttd Sertifikat', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Sertifikat Personil';
					$data['page'] = 'sert_personil';
					$data['pegnip'] = $pegnip;
					$data['peg'] = $this->master_model->get_master('m_personil','pegnip',$pegnip);
					$data['all_peg'] = $this->master_model->get_master('m_personil');
					$data['view'] = 'admin/sert_personil/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'sertpsno' => $this->input->post('SertPsNo'),
						'sertpsnama' => $this->input->post('SertPsNama'),
						'sertpspemberi' => $this->input->post('SertPsPemberi'),
						'sertpslingkup' => $this->input->post('SertPsLingkup'),
						'sertpstglsert' => date('Y-m-d',strtotime($this->input->post('SertPsTglSert'))),
						'sertpstglakr' => date('Y-m-d',strtotime($this->input->post('SertPsTglAkr'))),
						'sertpsttd' => $this->input->post('SertPsTtd'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$uploadphoto = $this->_uploadImage($this->input->post('SertPsNo'));
					if($uploadphoto){
						$data['sertpsscan'] = $uploadphoto;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_sertifikat_personil',$data);

					$pegnip = $this->input->post('PegNIP');
					$getpeg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
					$idpeg = $getpeg['id_personil'];

					if($result){
						$this->session->set_flashdata('msg', 'New Sertifikat Personil has been added successfully!');
						redirect(base_url('admin/personil/edit/'.$idpeg));
					}
				}
			}
			else{
				$data['title'] = 'Sertifikat Personil';
				$data['page'] = 'sert_personil';
				$data['pegnip'] = $pegnip;
				$data['peg'] = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
				$data['all_peg'] = $this->master_model->get_master('m_personil');
				$data['view'] = 'admin/sert_personil/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('PegNIP', 'Pegawai', 'trim|required');
				$this->form_validation->set_rules('SertPsNo', 'No Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsNama', 'Nama Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsPemberi', 'Pemberi Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsLingkup', 'Lingkup Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsTglSert', 'Tanggal Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertPsTglAkr', 'Tanggal Akhir', 'trim|required');
				$this->form_validation->set_rules('SertPsTtd', 'Ttd Sertifikat', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['data'] = $this->master_model->get_master_by_id('tb_sertifikat_personil','idsertps',$id);
					$data['title'] = 'Sertifikat Personil';
					$data['page'] = 'sert_personil';
					$data['view'] = 'admin/sert_personil/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'sertpsno' => $this->input->post('SertPsNo'),
						'sertpsnama' => $this->input->post('SertPsNama'),
						'sertpspemberi' => $this->input->post('SertPsPemberi'),
						'sertpslingkup' => $this->input->post('SertPsLingkup'),
						'sertpstglsert' => date('Y-m-d',strtotime($this->input->post('SertPsTglSert'))),
						'sertpstglakr' => date('Y-m-d',strtotime($this->input->post('SertPsTglAkr'))),
						'sertpsttd' => $this->input->post('SertPsTtd')
					);
					$uploadphoto = $this->_uploadImage($this->input->post('SertPsNo'));
					if($uploadphoto!=""){
						$data['sertpsscan'] = $uploadphoto;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_sertifikat_personil','idsertps',$data, $id);

					$pegnip = $this->input->post('PegNIP');
					$getpeg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
					$idpeg = $getpeg['id_personil'];

					if($result){
						$this->session->set_flashdata('msg', 'Sertifikat Personil has been updated successfully!');
						redirect(base_url('admin/personil/edit/'.$idpeg));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_sertifikat_personil','idsertps',$id);
				$data['title'] = 'Sertifikat Personil';
				$data['page'] = 'sert_personil';
				$data['view'] = 'admin/sert_personil/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$pegnip)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_sertifikat_personil', array('idsertps' => $id));
			$this->session->set_flashdata('msg', 'Sertifikat Personil has been deleted successfully!');
			
			$getpeg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
			$idpeg = $getpeg['id_personil'];

			redirect(base_url('admin/personil/edit/'.$idpeg));
		}

		function view($id = 0)
		{
			$data['sert'] =  $this->master_model->get_master_by_id('tb_sertifikat_personil','idsertps',$id);
			$data['title'] = 'File Sertifikat';
			$data['view'] = 'admin/sert_personil/file_sert';
			$this->load->view('layout', $data);
		}

		private function _uploadImage($id)
		{
			$path = './uploads/images/sert_personil/';
			if(!is_dir($path)){
			  mkdir($path);
			}
		    $config['upload_path']          = $path;
		    $config['allowed_types']        = 'pdf';
		    $config['file_name']            = $id."_".time();
		    $config['overwrite']			= true;
		    $config['max_size']             = 4096; // 4MB

		    $this->load->library('upload', $config);
  			$this->upload->initialize($config);

		    if ($this->upload->do_upload('SertPsScan')) {
		        $image = $this->upload->data('file_name');
		    }else{
		    	$image = " ";
		    }
		    return $image;
		}

	}


?>