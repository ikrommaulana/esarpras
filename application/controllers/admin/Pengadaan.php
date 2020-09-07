<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Pengadaan extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/pengadaan_model', 'model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			if($this->session->userdata('admin_role')=='superadmin'){
				$data['pengadaan'] =  $this->model->get_all_pengadaan();
			}else{
				$get_admin = $this->db->query('select * from ci_admin
					where admin_id='.$this->session->userdata('admin_id'))->result();
				$priviledge = (isset($get_admin[0]->priviledge))? $get_admin[0]->priviledge : set_value('priviledge');
				if($priviledge==3){
					$data['pengadaan'] =  $this->model->get_all_pengadaan();
				}else{
					$pegnip = (isset($get_admin[0]->pegnip))? $get_admin[0]->pegnip : set_value('pegnip');
					$get_lab = $this->db->query('select * from tb_personil_daftar
						where pegnip="'.$pegnip.'"')->result();
					$idlab = (isset($get_lab[0]->idlab))? $get_lab[0]->idlab : set_value('idlab');
					$data['pengadaan'] =  $this->model->get_all_pengadaan_by_lab($idlab);
				}
			}
			//$data['pengadaan'] =  $this->model->get_all_pengadaan();
			$data['title'] = 'Data Pengadaan';
			$data['view'] = 'admin/pengadaan/index';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->model->change_status('tb_pengadaan','id');
		}

		function add(){
			
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('sarpras', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'trim|required');
				$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
				$this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
				$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
				$this->form_validation->set_rules('waktu', 'Waktu', 'trim|required');
				$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required');

				// print_r($this->form_validation->run());
				// die();
				if ($this->form_validation->run() == FALSE) {
					$data['lokasi'] = $this->model->get_lokasi_byuser();
					$data['view'] = 'admin/pengadaan/add_data';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pengsarnama' => $this->input->post('sarpras'),
						'pengsarspes' => $this->input->post('spesifikasi'),
						'pengsarjum' => $this->input->post('jumlah'),
						'pengsartuj' => $this->input->post('tujuan'),
						'loklabid' => $this->input->post('lokasi'),
						'loklabwak' => date("Y-m-d", strtotime($this->input->post('waktu'))),
						'loklabbia' => $this->input->post('biaya'),
						'id_pemohon' => $this->session->userdata('admin_id'),
						'created_date' => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->model->add_master('tb_pengadaan',$data);
					if($result){
						$this->session->set_flashdata('msg', 'Pengadaan berhasil diajukan');
						redirect(base_url('admin/pengadaan'));
					}
				}
			}
			else{
				$data['lokasi'] = $this->model->get_lokasi_byuser();
				$data['view'] = 'admin/pengadaan/add_data';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('sarpras', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'trim|required');
				$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
				$this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
				$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
				$this->form_validation->set_rules('waktu', 'Waktu', 'trim|required');
				$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['lokasi'] = $this->model->get_lokasi_byuser();
					$data['pengadaan'] = $this->model->get_master_by_id('tb_pengadaan','id',$id);
					$data['view'] = 'admin/pengadaan/data_edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pengsarnama' => $this->input->post('sarpras'),
						'pengsarspes' => $this->input->post('spesifikasi'),
						'pengsarjum' => $this->input->post('jumlah'),
						'pengsartuj' => $this->input->post('tujuan'),
						'loklabid' => $this->input->post('lokasi'),
						'loklabwak' => date("Y-m-d", strtotime($this->input->post('waktu'))),
						'loklabbia' => $this->input->post('biaya'),
						'changed_by' => $this->session->userdata('username')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->model->edit_master('tb_pengadaan','id',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Pengadaan telah diperbarui!');
						redirect(base_url('admin/pengadaan'));
					}
				}
			}
			else{
				$data['lokasi'] = $this->model->get_lokasi_byuser();
				$data['pengadaan'] = $this->model->get_master_by_id('tb_pengadaan','id',$id);
				$data['view'] = 'admin/pengadaan/data_edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_pengadaan', array('id' => $id));
			$this->session->set_flashdata('msg', 'Data Pengadaan telah terhapus!');
			redirect(base_url('admin/pengadaan'));
		}

		function makeapprove(){

			//$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('p_id')) {
				if($this->session->userdata('priviledge')==2) { //approve L1
					$data = array(
						'L1' => $this->session->userdata('admin_id'),
						'respon_L1' => $this->input->post('respon'),
						'note_L1' => $this->input->post('note'),
						'date_L1' => date('Y-m-d h:i:s'),
						'changed_by' => $this->session->userdata('username')
					);
				} else {
					$data = array(
						'L2' => $this->session->userdata('admin_id'),
						'respon_L2' => $this->input->post('respon'),
						'note_L2' => $this->input->post('note'),
						'date_L2' => date('Y-m-d h:i:s'),
						'changed_by' => $this->session->userdata('username')
					);
				}
					$data = $this->security->xss_clean($data);
					$result = $this->model->edit_master('tb_pengadaan','id',$data, $this->input->post('p_id'));
					if($result){
						$this->session->set_flashdata('msg', 'Data Pengadaan telah diperbarui!');
						redirect(base_url('admin/pengadaan'));
					}
				}
		}

		function viewpengadaan($id){
			//$id = $this->input->post('id');
			$data['get_pengadaan'] = $this->model->get_master_by_id('tb_pengadaan','id',$id);
			$html = $this->load->view('admin/pengadaan/view', $data);

			return $html;
		}

		function export_data(){
			$alldata = $this->model->get_all_pengadaan();
			$data['pengadaan']=$alldata;

			$this->load->view('admin/pengadaan/data_export',$data);
		}

	}


?>