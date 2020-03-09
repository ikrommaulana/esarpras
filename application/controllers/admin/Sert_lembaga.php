	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Sert_lembaga extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_sertifikat_lembaga');
			$data['title'] = 'Sertifikat Lembaga';
			$data['page'] = 'sert_lembaga';
			$data['view'] = 'admin/sert_lembaga/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_sertifikat_lembaga','idsertlb');
		}

		function add($idlab=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('SertLbNo', 'No Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbNama', 'Nama Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbPemberi', 'Pemberi Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbLingkup', 'Lingkup Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbTglSert', 'Tanggal Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbTglAkr', 'Tanggal Akhir', 'trim|required');
				$this->form_validation->set_rules('SertLbTtd', 'Ttd Sertifikat', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Sertifikat Lembaga';
					$data['page'] = 'sert_lembaga';
					$data['idlab'] = $idlab;
					$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$data['all_lab'] = $this->master_model->get_master('m_lab');
					$data['view'] = 'admin/sert_lembaga/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'idlab' => $this->input->post('IdLab'),
						'sertlbno' => $this->input->post('SertLbNo'),
						'sertlbnama' => $this->input->post('SertLbNama'),
						'sertlbpemberi' => $this->input->post('SertLbPemberi'),
						'sertlblingkup' => $this->input->post('SertLbLingkup'),
						'sertlbtglsert' => date('Y-m-d',strtotime($this->input->post('SertLbTglSert'))),
						'sertlbtglakr' => date('Y-m-d',strtotime($this->input->post('SertLbTglAkr'))),
						'sertlbttd' => $this->input->post('SertLbTtd'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$uploadphoto = $this->_uploadImage($this->input->post('SertLbNo'));
					if($uploadphoto != ""){
						$data['sertlbscan'] = $uploadphoto;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_sertifikat_lembaga',$data);

					$idlab = $this->input->post('IdLab');
					$getlab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$id = $getlab['idlab'];

					if($result){
						$this->session->set_flashdata('msg', 'New Sertifikat Lembaga has been added successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$id));
					}
				}
			}
			else{
				$data['title'] = 'Sertifikat Lembaga';
				$data['page'] = 'sert_lembaga';
				$data['idlab'] = $idlab;
				$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
				$data['all_lab'] = $this->master_model->get_master('m_lab');
				$data['view'] = 'admin/sert_lembaga/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('SertLbNo', 'No Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbNama', 'Nama Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbPemberi', 'Pemberi Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbLingkup', 'Lingkup Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbTglSert', 'Tanggal Sertifikat', 'trim|required');
				$this->form_validation->set_rules('SertLbTglAkr', 'Tanggal Akhir', 'trim|required');
				$this->form_validation->set_rules('SertLbTtd', 'Ttd Sertifikat', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['data'] = $this->master_model->get_master_by_id('tb_sertifikat_lembaga','idsertlb',$id);
					$data['title'] = 'Sertifikat Lembaga';
					$data['page'] = 'sert_lembaga';
					$data['view'] = 'admin/sert_lembaga/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'idlab' => $this->input->post('IdLab'),
						'sertlbno' => $this->input->post('SertLbNo'),
						'sertlbnama' => $this->input->post('SertLbNama'),
						'sertlbpemberi' => $this->input->post('SertLbPemberi'),
						'sertlblingkup' => $this->input->post('SertLbLingkup'),
						'sertlbtglsert' => date('Y-m-d',strtotime($this->input->post('SertLbTglSert'))),
						'sertlbtglakr' => date('Y-m-d',strtotime($this->input->post('SertLbTglAkr'))),
						'sertlbttd' => $this->input->post('SertLbTtd')
					);
					$uploadphoto = $this->_uploadImage($this->input->post('SertLbNo'));
					if($uploadphoto!=""){
						$data['sertlbscan'] = $uploadphoto;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_sertifikat_lembaga','idsertlb',$data, $id);

					$idlab = $this->input->post('IdLab');
					$getlab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$id = $getlab['idlab'];

					if($result){
						$this->session->set_flashdata('msg', 'Sertifikat Lembaga has been updated successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$id));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_sertifikat_lembaga','idsertlb',$id);
				$data['title'] = 'Sertifikat Lembaga';
				$data['page'] = 'sert_lembaga';
				$data['view'] = 'admin/sert_lembaga/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$idlab)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_sertifikat_lembaga', array('idsertlb' => $id));
			$this->session->set_flashdata('msg', 'Sertifikat Lembaga has been deleted successfully!');

			redirect(base_url('admin/identitas_lab/edit/'.$idlab));
		}

		function view($id = 0)
		{
			$data['sert'] =  $this->master_model->get_master_by_id('tb_sertifikat_lembaga','idsertlb',$id);
			$data['title'] = 'File Sertifikat';
			$data['view'] = 'admin/sert_lembaga/file_sert';
			$this->load->view('layout', $data);
		}

		private function _uploadImage($id)
		{
			$path = './uploads/images/sert_lembaga/';
			if(!is_dir($path)){
			  mkdir($path);
			}
		    $config['upload_path']          = $path;
		    $config['allowed_types']        = 'jpeg|jpg|png|pdf';
		    $config['file_name']            = $id."_".time();
		    $config['overwrite']			= true;
		    $config['max_size']             = 4096; // 4MB

		    $this->load->library('upload', $config);
  			$this->upload->initialize($config);

		    if ($this->upload->do_upload('SertLbScan')) {
		        $image = $this->upload->data('file_name');
		    }else{
		    	$image = " ";
		    }
		    return $image;
		}

	}


?>