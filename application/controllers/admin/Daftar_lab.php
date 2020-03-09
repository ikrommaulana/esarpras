	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Daftar_lab extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_lab'] =  $this->master_model->get_all_simple_master('m_lab');
			$data['title'] = 'Daftar Laboratorium';
			$data['page'] = 'daftar_lab';
			$data['view'] = 'admin/laboratorium/daftar_lab';
			$this->load->view('layout', $data);
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submitLab')){
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/laboratorium/edit_daftar_lab';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'labnama' => $this->input->post('LabNama'),
						'labsingkat' => $this->input->post('LabSingkat'),
						'labalamat' => $this->input->post('LabAlamat'),
						'labkota' => $this->input->post('LabKota'),
						'labprovinsi' => $this->input->post('LabProvinsi'),
						'labtelp' => $this->input->post('LabTelp'),
						'labemail' => $this->input->post('LabEmail'),
						'labweb' => $this->input->post('LabWeb')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_personil','id_personil',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Profile has been updated successfully!');
						redirect(base_url('admin/daftar_pegawai'));
					}
				}
			}


			$data['data'] = $this->master_model->get_master_by_id('m_lab','idlab',$id);
			$data['title'] = 'Data Laboratorium';
			$data['page'] = 'daftar_lab';
			$data['view'] = 'admin/laboratorium/edit_daftar_lab';
			$this->load->view('layout', $data);
			
		}

		function view($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			$data['personil'] = $this->master_model->get_master_by_id('m_personil','id_personil',$id);
			$data['title'] = 'Data Pegawai';
			$data['page'] = 'daftar_pegawai';
			$data['view'] = 'admin/kepegawaian/view_daftar_pegawai';
			$this->load->view('layout', $data);
			
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_personil', array('id_personil' => $id));
			$this->session->set_flashdata('msg', 'Personil has been deleted successfully!');
			redirect(base_url('admin/personil'));
		}

		private function _uploadImage($id)
		{
		    $config['upload_path']          = './uploads/images/personil/';
		    $config['allowed_types']        = 'jpeg|jpg|png';
		    $config['file_name']            = $id."_".time();
		    $config['overwrite']			= true;
		    $config['max_size']             = 4096; // 4MB

		    $this->load->library('upload', $config);
  			$this->upload->initialize($config);

		    if ($this->upload->do_upload('PegPhoto')) {
		        $image = $this->upload->data('file_name');
		    }else{
		    	$image = " ";
		    }
		    return $image;
		}

	}


?>