	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Identitas_lab extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			// print_r($this->session->userdata());
			$admin_role = $this->session->userdata('admin_role');
			$idlab = $this->session->userdata('idlab');
			if($admin_role=='Admin Balai'){
				$data['all_lab'] =  $this->master_model->get_where_master('m_lab','idlab',$idlab);
			}else{
				$data['all_lab'] =  $this->master_model->get_all_simple_master('m_lab');
			}
			$data['title'] = 'Identitas Laboratorium';
			$data['view'] = 'admin/identitas_lab/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('m_lab','idlab');
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('LabNama', 'Nama Lab', 'trim|required');
				$this->form_validation->set_rules('LabNamaSingkat', 'Nama Singkat Lab', 'trim|required');
				$this->form_validation->set_rules('LabAlamat', 'Alamat Lab', 'trim|required');
				$this->form_validation->set_rules('LabKota', 'Kota', 'trim|required');
				$this->form_validation->set_rules('LabProvinsi', 'Provinsi', 'trim|required');
				$this->form_validation->set_rules('LabTelp', 'Telp', 'trim|required');
				$this->form_validation->set_rules('LabEmail', 'Email', 'trim|required');
				$this->form_validation->set_rules('LabWeb', 'Web', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/identitas_lab/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'labnama' => $this->input->post('LabNama'),
						'labnamasingkat' => $this->input->post('LabNamaSingkat'),
						'labalamat' => $this->input->post('LabAlamat'),
						'labkota' => $this->input->post('LabKota'),
						'labprovinsi' => $this->input->post('LabProvinsi'),
						'labtelp' => $this->input->post('LabTelp'),
						'labemail' => $this->input->post('LabEmail'),
						'labweb' => $this->input->post('LabWeb'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('m_lab',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Identitas Laboratorium has been added successfully!');
						redirect(base_url('admin/identitas_lab'));
					}
				}
			}
			else{
				$data['view'] = 'admin/identitas_lab/add';
				$this->load->view('layout', $data);
			}
			
		}

		/**function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('LabNama', 'Nama Lab', 'trim|required');
				$this->form_validation->set_rules('LabNamaSingkat', 'Nama Singkat Lab', 'trim|required');
				$this->form_validation->set_rules('LabAlamat', 'Alamat Lab', 'trim|required');
				$this->form_validation->set_rules('LabKota', 'Kota', 'trim|required');
				$this->form_validation->set_rules('LabProvinsi', 'Provinsi', 'trim|required');
				$this->form_validation->set_rules('LabTelp', 'Telp', 'trim|required');
				$this->form_validation->set_rules('LabEmail', 'Email', 'trim|required');
				$this->form_validation->set_rules('LabWeb', 'Web', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/identitas_lab/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'labnama' => $this->input->post('LabNama'),
						'labnamasingkat' => $this->input->post('LabNamaSingkat'),
						'labalamat' => $this->input->post('LabAlamat'),
						'labkota' => $this->input->post('LabKota'),
						'labprovinsi' => $this->input->post('LabProvinsi'),
						'labtelp' => $this->input->post('LabTelp'),
						'labemail' => $this->input->post('LabEmail'),
						'labweb' => $this->input->post('LabWeb')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_lab','idlab',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Identitas Laboratorium has been updated successfully!');
						redirect(base_url('admin/identitas_lab'));
					}
				}
			}
			else{
				$data['identitas_lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$id);
				$data['view'] = 'admin/identitas_lab/edit';
				$this->load->view('layout', $data);
			}
		}**/

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submitLab')){
				$this->form_validation->set_rules('LabNama', 'Nama Lab', 'trim|required');
				$this->form_validation->set_rules('LabNamaSingkat', 'Nama Singkat', 'trim|required');
				$this->form_validation->set_rules('LabAlamat', 'Alamat Lab', 'trim|required');
				$this->form_validation->set_rules('LabKota', 'Kota', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['data'] = $this->master_model->get_master_by_id('m_lab','idlab',$id);
					$data['title'] = 'Data Laboratorium';
					$data['page'] = 'identitas_lab';
					$data['view'] = 'admin/identitas_lab/edit_lab';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'labnama' => $this->input->post('LabNama'),
						'labnamasingkat' => $this->input->post('LabNamaSingkat'),
						'labalamat' => $this->input->post('LabAlamat'),
						'labkota' => $this->input->post('LabKota'),
						'labprovinsi' => $this->input->post('LabProvinsi'),
						'labtelp' => $this->input->post('LabTelp'),
						'labemail' => $this->input->post('LabEmail'),
						'labweb' => $this->input->post('LabWeb')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_lab','idlab',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Identitas Lab has been updated successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$id));
					}
				}
			}


			$data['data'] = $this->master_model->get_master_by_id('m_lab','idlab',$id);
			$data['title'] = 'Data Laboratorium';
			$data['page'] = 'identitas_lab';
			$data['view'] = 'admin/identitas_lab/edit_lab';
			$this->load->view('layout', $data);
			
		}

		function view($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			$data['data'] = $this->master_model->get_master_by_id('m_lab','idlab',$id);
			$data['title'] = 'Data Laboratorium';
			$data['page'] = 'identitas_lab';
			$data['view'] = 'admin/identitas_lab/view_lab';
			$this->load->view('layout', $data);
			
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_lab', array('idlab' => $id));
			// $this->db->delete('tb_layanan_lab', array('idlab' => $id));
			// $this->db->delete('tb_personil_daftar', array('idlab' => $id));
			// $this->db->delete('tb_sarpras_lab', array('idlab' => $id));
			// $this->db->delete('tb_sertifikat_lembaga', array('idlab' => $id));
			// $this->db->delete('tb_lokasi_lab', array('idlab' => $id));
			$this->session->set_flashdata('msg', 'Identitas Laboratorium has been deleted successfully!');
			redirect(base_url('admin/identitas_lab'));
		}

	}


?>