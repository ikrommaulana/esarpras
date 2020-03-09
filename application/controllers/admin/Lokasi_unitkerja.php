	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Lokasi_unitkerja extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_lokasi_unitkerja'] =  $this->master_model->get_all_simple_master('tb_lokasi_unitkerja');
			$data['title'] = 'Lokasi Unit Kerja';
			$data['view'] = 'admin/lokasi_unitkerja/lokasi_unitkerja_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_lokasi_unitkerja','id_lokasi_unitkerja');
		}

		function add(){
			
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_unitkerja', 'Unit Kerja', 'trim|required');
				$this->form_validation->set_rules('id_lokasi', 'Lokasi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/lokasi_unitkerja/lokasi_unitkerja_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'id_unitkerja' => $this->input->post('id_unitkerja'),
						'id_lokasi' => $this->input->post('id_lokasi'),
						'telp' => $this->input->post('telp'),
						'is_active' => 1,
						'created_at' => date('Y-m-d'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_lokasi_unitkerja',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Lokasi Unit Kerja has been added successfully!');
						redirect(base_url('admin/lokasi_unitkerja'));
					}
				}
			}
			else{
				$data['lokasi'] = $this->master_model->get_master('m_lokasi');
				$data['unitkerja'] = $this->master_model->get_master('m_unitkerja');
				$data['view'] = 'admin/lokasi_unitkerja/lokasi_unitkerja_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_unitkerja', 'Unit Kerja', 'trim|required');
				$this->form_validation->set_rules('id_lokasi', 'Lokasi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/lokasi_unitkerja/lokasi_unitkerja_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'id_unitkerja' => $this->input->post('id_unitkerja'),
						'id_lokasi' => $this->input->post('id_lokasi'),
						'telp' => $this->input->post('telp'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_lokasi_unitkerja','id_lokasi_unitkerja',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Lokasi Unit Kerja has been updated successfully!');
						redirect(base_url('admin/lokasi_unitkerja'));
					}
				}
			}
			else{
				$data['lokasi'] = $this->master_model->get_master('m_lokasi');
				$data['unitkerja'] = $this->master_model->get_master('m_unitkerja');
				$data['lokasi_unitkerja'] = $this->master_model->get_master_by_id('tb_lokasi_unitkerja','id_lokasi_unitkerja',$id);
				$data['view'] = 'admin/lokasi_unitkerja/lokasi_unitkerja_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_lokasi_unitkerja', array('id_lokasi_unitkerja' => $id));
			$this->session->set_flashdata('msg', 'Lokasi Unit Kerja has been deleted successfully!');
			redirect(base_url('admin/lokasi_unitkerja'));
		}

	}


?>