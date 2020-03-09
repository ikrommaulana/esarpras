	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Sarpras_lab extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_sarpras_lab');
			$data['title'] = 'Sarpras Laboratorium';
			$data['page'] = 'sarpras_lab';
			$data['view'] = 'admin/sarpras_lab/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_sarpras_lab','sarid');
		}

		function add($idlab=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('SarJenis', 'Jenis Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarNama', 'Nama Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarSpek', 'Spek Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarModel', 'Model Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarMerk', 'Merk Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarGuna', 'Kegunaan Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarKodeBrg', 'Kode Barang', 'trim|required');
				$this->form_validation->set_rules('SarNUP', 'NUP Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarPerolehan', 'Perolehan Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarPenyedia', 'Penyedia Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarNilai', 'Nilai Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarLokasi', 'Lokasi Sarpras', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Sarpras Laboratorium';
					$data['page'] = 'sarpras_lab';
					$data['idlab'] = $idlab;
					$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$data['all_lab'] = $this->master_model->get_master('m_lab');
					$data['view'] = 'admin/sarpras_lab/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'idlab' => $this->input->post('IdLab'),
						'sarjenis' => $this->input->post('SarJenis'),
						'sarnama' => $this->input->post('SarNama'),
						'sarspek' => $this->input->post('SarSpek'),
						'sarmodel' => $this->input->post('SarModel'),
						'sarmerk' => $this->input->post('SarMerk'),
						'sarguna' => $this->input->post('SarGuna'),
						'sarkodebrg' => $this->input->post('SarKodeBrg'),
						'sarnup' => $this->input->post('SarNUP'),
						'sarperolehan' => $this->input->post('SarPerolehan'),
						'sarpenyedia' => $this->input->post('SarPenyedia'),
						'sarnilai' => $this->input->post('SarNilai'),
						'sarlokasi' => $this->input->post('SarLokasi'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_sarpras_lab',$data);

					$idlab = $this->input->post('IdLab');
					$getlab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$id = $getlab['idlab'];

					if($result){
						$this->session->set_flashdata('msg', 'New Sarpras Laboratorium has been added successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$id));
					}
				}
			}
			else{
				$data['title'] = 'Sarpras Laboratorium';
				$data['page'] = 'sarpras_lab';
				$data['idlab'] = $idlab;
				$data['lab'] = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
				$data['all_lab'] = $this->master_model->get_master('m_lab');
				$data['view'] = 'admin/sarpras_lab/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('SarJenis', 'Jenis Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarNama', 'Nama Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarSpek', 'Spek Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarModel', 'Model Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarMerk', 'Merk Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarGuna', 'Kegunaan Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarKodeBrg', 'Kode Barang', 'trim|required');
				$this->form_validation->set_rules('SarNUP', 'NUP Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarPerolehan', 'Perolehan Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarPenyedia', 'Penyedia Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarNilai', 'Nilai Sarpras', 'trim|required');
				$this->form_validation->set_rules('SarLokasi', 'Lokasi Sarpras', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Sarpras Laboratorium';
					$data['page'] = 'sarpras_lab';
					$data['view'] = 'admin/sarpras_lab/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'idlab' => $this->input->post('IdLab'),
						'sarjenis' => $this->input->post('SarJenis'),
						'sarnama' => $this->input->post('SarNama'),
						'sarspek' => $this->input->post('SarSpek'),
						'sarmodel' => $this->input->post('SarModel'),
						'sarmerk' => $this->input->post('SarMerk'),
						'sarguna' => $this->input->post('SarGuna'),
						'sarkodebrg' => $this->input->post('SarKodeBrg'),
						'sarnup' => $this->input->post('SarNUP'),
						'sarperolehan' => $this->input->post('SarPerolehan'),
						'sarpenyedia' => $this->input->post('SarPenyedia'),
						'sarnilai' => $this->input->post('SarNilai'),
						'sarlokasi' => $this->input->post('SarLokasi')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_sarpras_lab','sarid',$data, $id);

					$idlab = $this->input->post('IdLab');
					$getlab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
					$id = $getlab['idlab'];

					if($result){
						$this->session->set_flashdata('msg', 'New Sarpras Laboratorium has been updated successfully!');
						redirect(base_url('admin/identitas_lab/edit/'.$id));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_sarpras_lab','sarid',$id);
				$data['title'] = 'Sarpras Laboratorium';
				$data['page'] = 'sarpras_lab';
				$data['view'] = 'admin/sarpras_lab/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$idlab)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_sarpras_lab', array('sarid' => $id));
			$this->session->set_flashdata('msg', 'Sarpras Laboratorium has been deleted successfully!');

			redirect(base_url('admin/identitas_lab/edit/'.$idlab));
		}

	}


?>