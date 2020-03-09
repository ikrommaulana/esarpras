	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Pegawai extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_pegawai'] =  $this->master_model->get_join_master('m_pegawai','ci_admin','m_pegawai.id_admin=ci_admin.admin_id');
			$data['title'] = 'Data Pegawai';
			$data['view'] = 'admin/pegawai/pegawai_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('m_pegawai','nip');
		}

		function add(){
			
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
				$this->form_validation->set_rules('user_admin', 'User Esarpras', 'trim|required');
				$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
				$this->form_validation->set_rules('user_name_ldap', 'Username LDAP', 'trim|required');
				$this->form_validation->set_rules('password_ldap', 'Password LDAP', 'trim|required');
				$this->form_validation->set_rules('id_jabatan', 'Jabatan', 'trim|required');
				$this->form_validation->set_rules('id_lokasi_unitkerja', 'Lokasi Unit Kerja', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/jabatan/jabatan_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'nip' => $this->input->post('nip'),
						'id_admin' => $this->input->post('user_admin'),
						'nama_pegawai' => $this->input->post('nama_pegawai'),
						'user_name_ldap' => $this->input->post('user_name_ldap'),
						'password_ldap' => md5($this->input->post('password_ldap')),
						'id_jabatan' => $this->input->post('id_jabatan'),
						'id_lab' => $this->input->post('id_lab'),
						'id_lokasi_unitkerja' => $this->input->post('id_lokasi_unitkerja'),
						'is_active' => 1
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('m_pegawai',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Pegawai has been added successfully!');
						redirect(base_url('admin/pegawai'));
					}
				}
			}
			else{
				$data['user_admin'] = $this->master_model->get_master('ci_admin');
				$data['jabatan'] = $this->master_model->get_master('m_jabatan');
				$data['lab'] = $this->master_model->get_master('m_lab');
				$data['lokasi_unitkerja'] = $this->master_model->get_master('tb_lokasi_unitkerja');
				$data['view'] = 'admin/pegawai/pegawai_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
				$this->form_validation->set_rules('user_admin', 'User Esarpras', 'trim|required');
				$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
				$this->form_validation->set_rules('user_name_ldap', 'Username LDAP', 'trim|required');
				$this->form_validation->set_rules('id_jabatan', 'Jabatan', 'trim|required');
				$this->form_validation->set_rules('id_lokasi_unitkerja', 'Lokasi Unit Kerja', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/pegawai/pegawai_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'nip' => $this->input->post('nip'),
						'id_admin' => $this->input->post('user_admin'),
						'nama_pegawai' => $this->input->post('nama_pegawai'),
						'user_name_ldap' => $this->input->post('user_name_ldap'),
						'id_jabatan' => $this->input->post('id_jabatan'),
						'id_lab' => $this->input->post('id_lab'),
						'id_lokasi_unitkerja' => $this->input->post('id_lokasi_unitkerja'),
					);
					if($this->input->post('password_ldap')){
						$data['password_ldap'] = md5($this->input->post('password_ldap'));
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_pegawai','nip',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Pegawai has been updated successfully!');
						redirect(base_url('admin/pegawai'));
					}
				}
			}
			else{
				$data['pegawai'] = $this->master_model->get_master_by_id('m_pegawai','nip',$id);
				$data['lab'] = $this->master_model->get_master('m_lab');
				$data['lokasi_unitkerja'] = $this->master_model->get_master('tb_lokasi_unitkerja');
				$data['user_admin'] = $this->master_model->get_master('ci_admin');
				$data['jabatan'] = $this->master_model->get_master('m_jabatan');
				$data['view'] = 'admin/pegawai/pegawai_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_pegawai', array('nip' => $id));
			$this->session->set_flashdata('msg', 'Jabatan has been deleted successfully!');
			redirect(base_url('admin/pegawai'));
		}

	}


?>