	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Layanan_lab_eks extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			if($this->session->userdata('admin_role')=='superadmin'){
				$data['all_data'] =  $this->master_model->get_all_simple_master('tb_layanan_lab_eks');
			}else{
				$get_personil = $this->db->query('select * from ci_admin
					where admin_id='.$this->session->userdata('admin_id'))->result();
				$priviledge = (isset($get_personil[0]->priviledge))? $get_personil[0]->priviledge : set_value('priviledge');
				if($priviledge==3){
					$data['all_data'] =  $this->master_model->get_all_simple_master('tb_layanan_lab_eks');
				}else{
					$pegnip = (isset($get_personil[0]->pegnip))? $get_personil[0]->pegnip : set_value('pegnip');
					$get_lab = $this->db->query('select * from tb_personil_daftar
						where pegnip="'.$pegnip.'"')->result();
					$idlab = (isset($get_lab[0]->idlab))? $get_lab[0]->idlab : set_value('idlab');
					$data['all_data'] =  $this->master_model->get_all_penggunaan_by_lab($idlab);
				}
			}
			//$data['all_data'] =  $this->master_model->get_all_simple_master('tb_layanan_lab_eks');
			$data['title'] = 'Layanan Laboratorium Eksternal';
			$data['page'] = 'layanan_lab_eks';
			$data['view'] = 'admin/penggunaan/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_layanan_lab_eks','lanjasidpermohonan');
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('DaflayId', 'Layanan', 'trim|required');
				$this->form_validation->set_rules('LanjasKetLay', 'Keterangan', 'trim|required');
				$this->form_validation->set_rules('LanjasPemohon', 'Pemohon', 'trim|required');
				$this->form_validation->set_rules('LanjasInstansi', 'Instansi', 'trim|required');
				$this->form_validation->set_rules('LanjasPIC', 'PIC', 'trim|required');
				$this->form_validation->set_rules('LanjasAlamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('LanjasTelepon', 'Telepon', 'trim|required');
				$this->form_validation->set_rules('LanjasEmail', 'Email', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/penggunaan/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'daflayid' => $this->input->post('DaflayId'),
						'lanjasketlay' => $this->input->post('LanjasKetLay'),
						'lanjaspemohon' => $this->input->post('LanjasPemohon'),
						'lanjasinstansi' => $this->input->post('LanjasInstansi'),
						'lanjaspic' => $this->input->post('LanjasPIC'),
						'lanjasalamat' => $this->input->post('LanjasAlamat'),
						'lanjastelepon' => $this->input->post('LanjasTelepon'),
						'lanjasemail' => $this->input->post('LanjasEmail'),
						'mitra1' => $this->input->post('MitraSatu'),
						'mitra2' => $this->input->post('MitraDua'),
						'mitra3' => $this->input->post('MitraTiga'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_layanan_lab_eks',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Layanan Laboratorium Eksternal has been added successfully!');
						redirect(base_url('admin/layanan_lab_eks'));
					}
				}
			}
			else{
				$data['title'] = 'Layanan Laboratorium Eksternal';
				$data['page'] = 'layanan_lab_eks';
				$data['view'] = 'admin/penggunaan/add';
				$this->load->view('layout', $data);
			}
			
		}

		/**function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('DaflayId', 'Layanan', 'trim|required');
				$this->form_validation->set_rules('LanjasKetLay', 'Keterangan', 'trim|required');
				$this->form_validation->set_rules('LanjasPemohon', 'Pemohon', 'trim|required');
				$this->form_validation->set_rules('LanjasInstansi', 'Instansi', 'trim|required');
				$this->form_validation->set_rules('LanjasPIC', 'PIC', 'trim|required');
				$this->form_validation->set_rules('LanjasAlamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('LanjasTelepon', 'Telepon', 'trim|required');
				$this->form_validation->set_rules('LanjasEmail', 'Email', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/layanan_lab_eks/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'daflayid' => $this->input->post('DaflayId'),
						'lanjasketlay' => $this->input->post('LanjasKetLay'),
						'lanjaspemohon' => $this->input->post('LanjasPemohon'),
						'lanjasinstansi' => $this->input->post('LanjasInstansi'),
						'lanjaspic' => $this->input->post('LanjasPIC'),
						'lanjasalamat' => $this->input->post('LanjasAlamat'),
						'lanjastelepon' => $this->input->post('LanjasTelepon'),
						'lanjasemail' => $this->input->post('LanjasEmail'),
						'mitra1' => $this->input->post('MitraSatu'),
						'mitra2' => $this->input->post('MitraDua'),
						'mitra3' => $this->input->post('MitraTiga')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_layanan_lab_eks','lanjasidpermohonan',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Layanan Laboratorium Eksternal has been updated successfully!');
						redirect(base_url('admin/layanan_lab_eks'));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$id);
				$data['title'] = 'Layanan Laboratorium Eksternal';
				$data['page'] = 'layanan_lab_eks';
				$data['view'] = 'admin/layanan_lab_eks/edit';
				$this->load->view('layout', $data);
			}
		}**/

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submitLayanan')){
				$this->form_validation->set_rules('DaflayId', 'Layanan', 'trim|required');
				$this->form_validation->set_rules('LanjasKetLay', 'Keterangan', 'trim|required');
				$this->form_validation->set_rules('LanjasPemohon', 'Pemohon', 'trim|required');
				$this->form_validation->set_rules('LanjasInstansi', 'Instansi', 'trim|required');
				$this->form_validation->set_rules('LanjasPIC', 'PIC', 'trim|required');
				$this->form_validation->set_rules('LanjasAlamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('LanjasTelepon', 'Telepon', 'trim|required');
				$this->form_validation->set_rules('LanjasEmail', 'Email', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['data'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$id);
					$data['title'] = 'Layanan Laboratorium Eksternal';
					$data['page'] = 'layanan_lab_eks';
					$data['view'] = 'admin/penggunaan/edit_layanan';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'daflayid' => $this->input->post('DaflayId'),
						'lanjasketlay' => $this->input->post('LanjasKetLay'),
						'lanjaspemohon' => $this->input->post('LanjasPemohon'),
						'lanjasinstansi' => $this->input->post('LanjasInstansi'),
						'lanjaspic' => $this->input->post('LanjasPIC'),
						'lanjasalamat' => $this->input->post('LanjasAlamat'),
						'lanjastelepon' => $this->input->post('LanjasTelepon'),
						'lanjasemail' => $this->input->post('LanjasEmail'),
						'mitra1' => $this->input->post('MitraSatu'),
						'mitra2' => $this->input->post('MitraDua'),
						'mitra3' => $this->input->post('MitraTiga')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_layanan_lab_eks','lanjasidpermohonan',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Layanan Laboratorium Eksternal has been updated successfully!');
						redirect(base_url('admin/layanan_lab_eks'));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$id);
				$data['title'] = 'Layanan Laboratorium Eksternal';
				$data['page'] = 'layanan_lab_eks';
				$data['view'] = 'admin/penggunaan/edit_layanan';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_layanan_lab_eks', array('lanjasidpermohonan' => $id));
			$this->session->set_flashdata('msg', 'Layanan Laboratorium has been deleted successfully!');
			redirect(base_url('admin/layanan_lab_eks'));
		}

	}


?>