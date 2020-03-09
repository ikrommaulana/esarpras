<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Pemeliharaan extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/pemeliharaan_model', 'model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			$data['pemeliharaan'] =  $this->model->get_all_pemeliharaan();
			$data['title'] = 'Data Pemeliharaan';
			$data['view'] = 'admin/pemeliharaan/index';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->model->change_status('tb_pemeliharaan','id');
		}

		function add(){
			
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				// $this->form_validation->set_rules('type', 'Type', 'trim|required');
				// $this->form_validation->set_rules('item', 'Item', 'trim|required');
				// $this->form_validation->set_rules('fungsi', 'Fungsi', 'trim|required');
				// $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
				// $this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
				// $this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
				// $this->form_validation->set_rules('waktu', 'Waktu', 'trim|required');
				// $this->form_validation->set_rules('tempo', 'Tempo', 'trim|required');
				// $this->form_validation->set_rules('biaya', 'Biaya', 'trim|required');

				// if ($this->form_validation->run() == FALSE) {
				// 	$data['view'] = 'admin/pemeliharaan/add';
				// 	$this->load->view('layout', $data);
				// }else{
				// print_r($this->session->set_userdata('admin_id'));
				// die();
				$get_unitkerja = $this->model->get_unitkerja_byidadmin();
					$data = array(
						'type' => $this->input->post('type'),
						'id_sarpras' => $this->input->post('sarpras'),
						'jumlah' => $this->input->post('jumlah'),
						'tujuan' => $this->input->post('tujuan'),
						'lokasi' => $this->input->post('lokasi'),
						'waktu' => date("Y-m-d", strtotime($this->input->post('waktu'))),
						'tempo' => $this->input->post('tempo'),
						'biaya' => $this->input->post('biaya'),
						'id_mitra' => $this->input->post('mitra'),
						'id_pemohon' => $this->session->userdata('admin_id'),
						'unitkerja' => $get_unitkerja[0]->id_unitkerja,
						'created_date' => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->model->add_master('tb_pemeliharaan',$data);
					if($result){
						$this->session->set_flashdata('msg', 'Pemeliharaan berhasil diajukan');
						redirect(base_url('admin/pemeliharaan'));
					}
				// }
			}
			else{
				$data['lokasi'] = $this->model->get_lokasi_byunit();
				$data['mitra'] = $this->model->get_all_simple_master('m_mitra');
				$data['sarpras'] = $this->model->get_all_simple_master('tb_sarpras');
				$data['view'] = 'admin/pemeliharaan/add_data';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				// $this->form_validation->set_rules('type', 'Type', 'trim|required');
				// $this->form_validation->set_rules('item', 'Item', 'trim|required');
				// $this->form_validation->set_rules('fungsi', 'Fungsi', 'trim|required');
				// $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
				// $this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
				// $this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
				// $this->form_validation->set_rules('waktu', 'Waktu', 'trim|required');
				// $this->form_validation->set_rules('tempo', 'Tempo', 'trim|required');
				// $this->form_validation->set_rules('biaya', 'Biaya', 'trim|required');

				// if ($this->form_validation->run() == FALSE) {
				// 	$data['view'] = 'prngadaan/pemeliharaan/edit';
				// 	$this->load->view('layout', $data);
				// }else{
				$get_unitkerja = $this->model->get_unitkerja_byidadmin();
					$data = array(
						'type' => $this->input->post('type'),
						'id_sarpras' => $this->input->post('sarpras'),
						'jumlah' => $this->input->post('jumlah'),
						'tujuan' => $this->input->post('tujuan'),
						'lokasi' => $this->input->post('lokasi'),
						'waktu' => $this->input->post('waktu'),
						'tempo' => $this->input->post('tempo'),
						'biaya' => $this->input->post('biaya'),
						'id_mitra' => $this->input->post('mitra'),
						'id_pemohon' => $this->session->userdata('admin_id'),
						'unitkerja' => $get_unitkerja[0]->id_unitkerja,
						'changed_by' => $this->session->userdata('username')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->model->edit_master('tb_pemeliharaan','id',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Pemeliharaan telah diperbarui!');
						redirect(base_url('admin/pemeliharaan'));
					}
				// }
			}
			else{
				$data['lokasi'] = $this->model->get_lokasi_byunit();
				$data['sarpras'] = $this->model->get_all_simple_master('tb_sarpras');
				$data['data'] = $this->model->get_master_by_id('tb_pemeliharaan','id',$id);
				$data['view'] = 'admin/pemeliharaan/data_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_pemeliharaan', array('id' => $id));
			$this->session->set_flashdata('msg', 'Data Pemeliharaan telah terhapus!');
			redirect(base_url('admin/pemeliharaan'));
		}

		function makeapprove(){

			//$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('p_id')) {
					$data = array(
						'respon' => $this->input->post('respon'),
						'note' => $this->input->post('note'),
						'changed_by' => $this->session->userdata('username')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->model->edit_master('tb_pemeliharaan','id',$data, $this->input->post('p_id'));
					if($result){
						$this->session->set_flashdata('msg', 'Data Pemeliharaan telah diperbarui!');
						redirect(base_url('admin/pemeliharaan'));
					}
				}
		}

		function export_data(){
			$alldata = $this->model->get_all_pemeliharaan();
			$data['pemeliharaan']=$alldata;

			$this->load->view('admin/pemeliharaan/data_export',$data);
		}

	}


?>