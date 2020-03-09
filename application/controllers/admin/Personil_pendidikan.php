	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Personil_pendidikan extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
			$data['all_personil_pendidikan'] =  $this->master_model->get_all_simple_master('tb_personil_pendidikan');
			$data['title'] = 'Personil Pendidikan';
			$data['view'] = 'admin/personil_pendidikan/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_personil_pendidikan','idpdk');
		}

		function add($pegnip=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('PdkLulus', 'Tahun Lulus', 'trim|required');
				$this->form_validation->set_rules('PdkJenjang', 'Jenjang', 'trim|required');
				$this->form_validation->set_rules('PdkKota', 'Kota', 'trim|required');
				$this->form_validation->set_rules('PdkNegara', 'Negara', 'trim|required');
				$this->form_validation->set_rules('PdkSekolah', 'Sekolah', 'trim|required');
				$this->form_validation->set_rules('PdkBidStudi', 'Bidang Studi', 'trim|required');
				$this->form_validation->set_rules('PdkTugasAkhir', 'Judul Tugas Akhir', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['pegnip'] = $pegnip;
					$data['peg'] = $this->master_model->get_master('m_personil','pegnip',$pegnip);
					$data['all_peg'] = $this->master_model->get_master('m_personil');
					$data['view'] = 'admin/personil_pendidikan/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'pdklulus' => $this->input->post('PdkLulus'),
						'pdkjenjang' => $this->input->post('PdkJenjang'),
						'pdkkota' => $this->input->post('PdkKota'),
						'pdknegara' => $this->input->post('PdkNegara'),
						'pdksekolah' => $this->input->post('PdkSekolah'),
						'pdkbidstudi' => $this->input->post('PdkBidStudi'),
						'pdktugasakhir' => $this->input->post('PdkTugasAkhir'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_personil_pendidikan',$data);

					$pegnip = $this->input->post('PegNIP');
					$getpeg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
					$idpeg = $getpeg['id_personil'];

					if($result){
						$this->session->set_flashdata('msg', 'New Personil Pendidikan has been added successfully!');
						redirect(base_url('admin/personil/edit/'.$idpeg));
					}
				}
			}
			else{
				$data['pegnip'] = $pegnip;
				$data['peg'] = $this->master_model->get_master('m_personil','pegnip',$pegnip);
				$data['all_peg'] = $this->master_model->get_master('m_personil');
				$data['view'] = 'admin/personil_pendidikan/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('PdkLulus', 'Tahun Lulus', 'trim|required');
				$this->form_validation->set_rules('PdkJenjang', 'Jenjang', 'trim|required');
				$this->form_validation->set_rules('PdkKota', 'Kota', 'trim|required');
				$this->form_validation->set_rules('PdkNegara', 'Negara', 'trim|required');
				$this->form_validation->set_rules('PdkSekolah', 'Sekolah', 'trim|required');
				$this->form_validation->set_rules('PdkBidStudi', 'Bidang Studi', 'trim|required');
				$this->form_validation->set_rules('PdkTugasAkhir', 'Judul Tugas Akhir', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/personil_pendidikan/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'pdklulus' => $this->input->post('PdkLulus'),
						'pdkjenjang' => $this->input->post('PdkJenjang'),
						'pdkkota' => $this->input->post('PdkKota'),
						'pdknegara' => $this->input->post('PdkNegara'),
						'pdksekolah' => $this->input->post('PdkSekolah'),
						'pdkbidstudi' => $this->input->post('PdkBidStudi'),
						'pdktugasakhir' => $this->input->post('PdkTugasAkhir')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_personil_pendidikan','idpdk',$data, $id);

					$pegnip = $this->input->post('PegNIP');
					$getpeg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
					$idpeg = $getpeg['id_personil'];

					if($result){
						$this->session->set_flashdata('msg', 'Personil Pendidikan has been updated successfully!');
						redirect(base_url('admin/personil/edit/'.$idpeg));
					}
				}
			}
			else{
				$data['personil_pendidikan'] = $this->master_model->get_master_by_id('tb_personil_pendidikan','idpdk',$id);
				$data['view'] = 'admin/personil_pendidikan/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$pegnip)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_personil_pendidikan', array('idpdk' => $id));
			$this->session->set_flashdata('msg', 'Personil Pendidikan has been deleted successfully!');

			$getpeg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
			$idpeg = $getpeg['id_personil'];

			redirect(base_url('admin/personil/edit/'.$idpeg));
		}

	}


?>