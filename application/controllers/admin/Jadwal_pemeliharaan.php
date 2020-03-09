	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Jadwal_pemeliharaan extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_jadwal_pemeliharaan');
			$data['title'] = 'Jadwal Pemeliharaan';
			$data['page'] = 'jadwal_pemeliharaan';
			$data['view'] = 'admin/jadwal_pemeliharaan/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_jadwal_pemeliharaan','id_jadpem');
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('SarId', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('JadPemSifat', 'Sifat', 'trim|required');
				$this->form_validation->set_rules('MitraId', 'Mitra', 'trim|required');
				$this->form_validation->set_rules('JadPemTglMul', 'Tanggal Mulai', 'trim|required');
				$this->form_validation->set_rules('JadPemTglSel', 'Tanggal Selesai', 'trim|required');
				$this->form_validation->set_rules('JadPemCatatan', 'Catatan', 'trim|required');
				$this->form_validation->set_rules('JadPemPIC', 'PIC', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/hasil_penelitian/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'id_jadpem' => 'JP'.date('YmdHis').'_'.$this->input->post('SarId').'_'.$this->input->post('MitraId'),
						'sarid' => $this->input->post('SarId'),
						'jadpemsifat' => $this->input->post('JadPemSifat'),
						'mitraid' => $this->input->post('MitraId'),
						'jadpemtglmul' => date('Y-m-d',strtotime($this->input->post('JadPemTglMul'))),
						'jadpemtglsel' => date('Y-m-d',strtotime($this->input->post('JadPemTglSel'))),
						'jadpemcatatan' => $this->input->post('JadPemCatatan'),
						'jadpempic' => $this->input->post('JadPemPIC'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					// $uploadphoto = $this->_uploadImage($this->input->post('LanjasId'));
					// if($uploadphoto){
					// 	$data['hasilfile'] = $uploadphoto;
					// }
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_jadwal_pemeliharaan',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Jadwal Pemeliharaan has been added successfully!');
						redirect(base_url('admin/jadwal_pemeliharaan'));
					}
				}
			}
			else{
			$data['title'] = 'Jadwal Pemeliharaan';
			$data['page'] = 'jadwal_pemeliharaan';
			$data['view'] = 'admin/jadwal_pemeliharaan/add';
			$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('SarId', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('JadPemSifat', 'Sifat', 'trim|required');
				$this->form_validation->set_rules('MitraId', 'Mitra', 'trim|required');
				$this->form_validation->set_rules('JadPemTglMul', 'Tanggal Mulai', 'trim|required');
				$this->form_validation->set_rules('JadPemTglSel', 'Tanggal Selesai', 'trim|required');
				$this->form_validation->set_rules('JadPemCatatan', 'Catatan', 'trim|required');
				$this->form_validation->set_rules('JadPemPIC', 'PIC', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/jadwal_pemeliharaan/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'sarid' => $this->input->post('SarId'),
						'jadpemsifat' => $this->input->post('JadPemSifat'),
						'mitraid' => $this->input->post('MitraId'),
						'jadpemtglmul' => date('Y-m-d',strtotime($this->input->post('JadPemTglMul'))),
						'jadpemtglsel' => date('Y-m-d',strtotime($this->input->post('JadPemTglSel'))),
						'jadpemcatatan' => $this->input->post('JadPemCatatan'),
						'jadpempic' => $this->input->post('JadPemPIC'),
					);
					// $uploadphoto = $this->_uploadImage($this->input->post('LanjasId'));
					// if($uploadphoto){
					// 	$data['hasilfile'] = $uploadphoto;
					// }
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_jadwal_pemeliharaan','id_jadpem',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Jadwal Pemeliharaan has been updated successfully!');
						redirect(base_url('admin/jadwal_pemeliharaan'));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_jadwal_pemeliharaan','id_jadpem',$id);
				$data['title'] = 'Jadwal Pemeliharaan';
				$data['page'] = 'jadwal_pemeliharaan';
				$data['view'] = 'admin/jadwal_pemeliharaan/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_jadwal_pemeliharaan', array('id_jadpem' => $id));
			$this->session->set_flashdata('msg', 'Jadwal Pemeliharaan has been deleted successfully!');
			redirect(base_url('admin/jadwal_pemeliharaan'));
		}

		private function _uploadImage($id)
		{
			$path = './uploads/files/jadwal_pemeliharaan/';
			if(!is_dir($path)){
			  mkdir($path);
			}
		    $config['upload_path']          = $path;
		    $config['allowed_types']        = 'jpeg|jpg|png|pdf';
		    $config['file_name']            = $id."_".time();
		    $config['overwrite']			= true;
		    $config['max_size']             = 4096; // 4MB

		    $this->load->library('upload', $config);
  			$this->upload->initialize($config);

		    if ($this->upload->do_upload('HasilFile')) {
		        $image = $this->upload->data('file_name');
		    }else{
		    	$image = " ";
		    }
		    return $image;
		}

	}


?>