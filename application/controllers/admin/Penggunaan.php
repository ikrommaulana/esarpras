<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Penggunaan extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/penggunaan_model', 'model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library

			$this->rbac->check_module_access();
		}

		function index(){
			$data['lab'] = $this->model->get_all_lab();
			$data['title'] = 'Data Penggunaan';
			$data['view'] = 'admin/penggunaan/index';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->model->change_status('tb_pemeliharaan','id');
		}

		function add($id=0){
			
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
				$get_unitkerja = $this->model->get_unitkerja_byidadmin();
					$data = array(
						'id_pemohon' => $this->session->userdata('admin_id'),
						'unitkerja' => $get_unitkerja[0]->kode_unitkerja,
						'id_sarpras' => $this->input->post('id_pm'),
						'tgl_pengguna' => $this->input->post('tanggal'),
						'id_pelaksana' => $this->session->userdata('admin_id'),
						'lokasi' => $this->input->post('lokasi'),
						'tujuan' => $this->input->post('tujuan'),
						'created_date' => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->model->add_master('tb_penggunaan',$data);
					if($result){
						$this->session->set_flashdata('msg', 'Data Penggunaan berhasil diajukan');
						redirect(base_url('admin/penggunaan'));
					}
				// }
			}
			else{
				$data['all_lokasi'] = $this->model->get_all_simple_master('m_lokasi');
				$data['layanan'] = $this->model->get_all_simple_master('tb_layanan_lab');
				$data['data'] = $this->model->get_all_pemeliharaan($id);
				$data['pegawai'] = $this->model->get_all_pegawai($id);
				$data['lab'] = $this->model->get_master_by_id('m_lab','id',$id); 
				$data['view'] = 'admin/penggunaan/add_data';
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
				$id = $this->input->post('id_pm');
				$cek = $this->model->get_master_by_id('tb_pemeliharaan','id',$id);
					$data = array(
						'pemohon' => $cek['pemohon'],
						'nip' => $cek['nip'],
						'unitkerja' => $cek['unitkerja'],
						'type' => $cek['type'],
						'item' => $cek['item'],
						'biaya' => $cek['biaya'],
						'tgl_pengguna' => $this->input->post('tanggal'),
						'pelaksana' => $this->input->post('pemohon'),
						'nip' => $this->input->post('nip'),
						'lokasi' => $this->input->post('lokasi'),
						'tujuan' => $this->input->post('tujuan')
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
				$data['lokasi'] = $this->model->get_all_simple_master('tb_lokasi');
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

	}


?>