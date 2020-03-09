<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Lokasi extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_lokasi'] =  $this->master_model->get_all_simple_master('m_lokasi');
			$data['title'] = 'Data Lokasi';
			$data['view'] = 'admin/lokasi/lokasi_list';
			$this->load->view('layout', $data);
		}

		function add(){
			
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('kode_lokasi', 'Kode Lokasi', 'trim|required');
				$this->form_validation->set_rules('nama_lokasi', 'Nama lokasi', 'trim|required');
				//$this->form_validation->set_rules('nama_jalan', 'Nama Jalan', 'trim|required');
				//$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
				//$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'trim|required');
				//$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/lokasi/lokasi_add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'kode_lokasi' => $this->input->post('kode_lokasi'),
						'nama_lokasi' => $this->input->post('nama_lokasi'),
						'nama_jalan' => $this->input->post('nama_jalan'),
						'provinsi' => $this->input->post('provinsi'),
						'kabupaten' => $this->input->post('kabupaten'),
						'kecamatan' => $this->input->post('kecamatan')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('m_lokasi',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Lokasi has been added successfully!');
						redirect(base_url('admin/lokasi'));
					}
				}
			}
			else{
				$data['view'] = 'admin/lokasi/lokasi_add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('kode_lokasi', 'Kode Lokasi', 'trim|required');
				$this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'trim|required');
				$this->form_validation->set_rules('nama_jalan', 'Nama Jalan', 'trim|required');
				$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
				$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'trim|required');
				$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/lokasi/lokasi_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'kode_lokasi' => $this->input->post('kode_lokasi'),
						'nama_lokasi' => $this->input->post('nama_lokasi'),
						'nama_jalan' => $this->input->post('nama_jalan'),
						'provinsi' => $this->input->post('provinsi'),
						'kabupaten' => $this->input->post('kabupaten'),
						'kecamatan' => $this->input->post('kecamatan')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_lokasi','id_lokasi',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Lokasi has been updated successfully!');
						redirect(base_url('admin/lokasi'));
					}
				}
			}
			else{
				$data['lokasi'] = $this->master_model->get_master_by_id('m_lokasi','id_lokasi',$id);
				$data['view'] = 'admin/lokasi/lokasi_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_lokasi', array('id_lokasi' => $id));
			$this->session->set_flashdata('msg', 'Lokasi has been deleted successfully!');
			redirect(base_url('admin/lokasi'));
		}

	}


?>