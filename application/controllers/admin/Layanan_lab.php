	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Layanan_lab extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_layanan_lab');
			$data['title'] = 'Layanan Laboratorium';
			$data['page'] = 'layanan_lab';
			$data['view'] = 'admin/layanan_lab/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_layanan_lab','daflayid');
		}

		function add($idlab=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('DaflayNama', 'Nama Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflayKapas', 'Kapasitas Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflayDesk', 'Deskripsi Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflayTarif', 'Tarif Dsar', 'trim|required');
				$this->form_validation->set_rules('DaflayDittpkn', 'Tanggal Ditetapkan', 'trim|required');
				$this->form_validation->set_rules('DaflayHarga', 'Harga Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflayDurasi', 'Durasi Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflaySyaPddk', 'Syarat Pendidikan', 'trim|required');
				$this->form_validation->set_rules('DaflaySyaSert', 'Syarat Sertifikat', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Layanan Laboratorium';
					$data['page'] = 'layanan_lab';
					$data['idlab'] = $idlab;
					$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$data['all_lab'] = $this->master_model->get_master('m_lab');
					$data['view'] = 'admin/layanan_lab/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'idlab' => $this->input->post('IdLab'),
						'daflaynama' => $this->input->post('DaflayNama'),
						'daflaykapas' => $this->input->post('DaflayKapas'),
						'daflaydesk' => $this->input->post('DaflayDesk'),
						'daflaytarif' => $this->input->post('DaflayTarif'),
						'daflaydittpkn' => date('Y-m-d',strtotime($this->input->post('DaflayDittpkn'))),
						'daflayharga' => $this->input->post('DaflayHarga'),
						'daflaydurasi' => $this->input->post('DaflayDurasi'),
						'daflaydurasiwkt' => $this->input->post('DaflayDurasiWaktu'),
						'daflaysyapddk' => $this->input->post('DaflaySyaPddk'),
						'daflaysyasert' => $this->input->post('DaflaySyaSert'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_layanan_lab',$data);

					$idlab = $this->input->post('IdLab');
					$getlab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$id = $getlab['idlab'];

					if($result){
						$this->session->set_flashdata('msg', 'New Layanan Laboratorium has been added successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$id));
					}
				}
			}
			else{
				$data['title'] = 'Layanan Laboratorium';
				$data['page'] = 'layanan_lab';
				$data['idlab'] = $idlab;
				$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
				$data['all_lab'] = $this->master_model->get_master('m_lab');
				$data['view'] = 'admin/layanan_lab/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('DaflayNama', 'Nama Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflayKapas', 'Kapasitas Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflayDesk', 'Deskripsi Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflayTarif', 'Tarif Dsar', 'trim|required');
				$this->form_validation->set_rules('DaflayDittpkn', 'Tanggal Ditetapkan', 'trim|required');
				$this->form_validation->set_rules('DaflayHarga', 'Harga Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflayDurasi', 'Durasi Layanan', 'trim|required');
				$this->form_validation->set_rules('DaflaySyaPddk', 'Syarat Pendidikan', 'trim|required');
				$this->form_validation->set_rules('DaflaySyaSert', 'Syarat Sertifikat', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/layanan_lab/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'idlab' => $this->input->post('IdLab'),
						'daflaynama' => $this->input->post('DaflayNama'),
						'daflaykapas' => $this->input->post('DaflayKapas'),
						'daflaydesk' => $this->input->post('DaflayDesk'),
						'daflaytarif' => $this->input->post('DaflayTarif'),
						'daflaydittpkn' => date('Y-m-d',strtotime($this->input->post('DaflayDittpkn'))),
						'daflayharga' => $this->input->post('DaflayHarga'),
						'daflaydurasi' => $this->input->post('DaflayDurasi'),
						'daflaydurasiwkt' => $this->input->post('DaflayDurasiWaktu'),
						'daflaysyapddk' => $this->input->post('DaflaySyaPddk'),
						'daflaysyasert' => $this->input->post('DaflaySyaSert')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_layanan_lab','daflayid',$data, $id);

					$idlab = $this->input->post('IdLab');
					$getlab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$id = $getlab['idlab'];

					if($result){
						$this->session->set_flashdata('msg', 'Layanan Laboratorium has been updated successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$id));
					}
				}
			}
			else{
				$data['all_data'] = $this->master_model->get_master_by_id('tb_layanan_lab','daflayid',$id);
				$data['title'] = 'Layanan Laboratorium';
				$data['page'] = 'layanan_lab';
				$data['view'] = 'admin/layanan_lab/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$idlab)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_layanan_lab', array('daflayid' => $id));
			$this->session->set_flashdata('msg', 'Layanan Laboratorium has been deleted successfully!');

			redirect(base_url('admin/identitas_lab/edit/'.$idlab));
		}

	}


?>