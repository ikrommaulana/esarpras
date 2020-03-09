	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Monev_sarpras extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_monev_sarpras');
			$data['title'] = 'Monev Sarpras';
			$data['page'] = 'monev_sarpras';
			$data['view'] = 'admin/monev_sarpras/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_monev_sarpras','id_monev');
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('SarId', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('MonevSifat', 'Sifat', 'trim|required');
				$this->form_validation->set_rules('MonevPelak', 'Pelaksana', 'trim|required');
				$this->form_validation->set_rules('MonevTglMul', 'Tanggal Mulai', 'trim|required');
				$this->form_validation->set_rules('MonevTglSel', 'Tanggal Selesai', 'trim|required');
				$this->form_validation->set_rules('PegNIP', 'Pegawai', 'trim|required');
				$this->form_validation->set_rules('MonevStatus', 'Status', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Monev Sarpras';
					$data['page'] = 'monev_sarpras';
					$data['view'] = 'admin/monev_sarpras/add';
					$this->load->view('layout', $data);
				}else{
					$id_monev = 'MS'.date('YmdHis').'_'.$this->input->post('SarId');
					$data = array(
						'id_monev' => $id_monev,
						'sarid' => $this->input->post('SarId'),
						'monevsifat' => $this->input->post('MonevSifat'),
						'monevpelak' => $this->input->post('MonevPelak'),
						'monevtglmul' => date('Y-m-d',strtotime($this->input->post('MonevTglMul'))),
						'monevtglsel' => date('Y-m-d',strtotime($this->input->post('MonevTglSel'))),
						'monevcatatan' => $this->input->post('MonevCatatan'),
						'monevstatus' => $this->input->post('MonevStatus'),
						'pegnip' => $this->input->post('PegNIP'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$uploadphoto = $this->_uploadImage($id_monev);
					if($uploadphoto!=""){
						$data['monevfoto'] = $uploadphoto;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_monev_sarpras',$data);
					if($result){
						$this->session->set_flashdata('msg', 'New Monev Sarpras has been added successfully!');
						redirect(base_url('admin/monev_sarpras'));
					}
				}
			}
			else{
			$data['title'] = 'Monev Sarpras';
			$data['page'] = 'monev_sarpras';
			$data['view'] = 'admin/monev_sarpras/add';
			$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('SarId', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('MonevSifat', 'Sifat', 'trim|required');
				$this->form_validation->set_rules('MonevPelak', 'Pelaksana', 'trim|required');
				$this->form_validation->set_rules('MonevTglMul', 'Tanggal Mulai', 'trim|required');
				$this->form_validation->set_rules('MonevTglSel', 'Tanggal Selesai', 'trim|required');
				$this->form_validation->set_rules('PegNIP', 'Pegawai', 'trim|required');
				$this->form_validation->set_rules('MonevStatus', 'Status', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Monev Sarpras';
					$data['page'] = 'monev_sarpras';
					$data['view'] = 'admin/monev_sarpras/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'sarid' => $this->input->post('SarId'),
						'monevsifat' => $this->input->post('MonevSifat'),
						'monevpelak' => $this->input->post('MonevPelak'),
						'monevtglmul' => date('Y-m-d',strtotime($this->input->post('MonevTglMul'))),
						'monevtglsel' => date('Y-m-d',strtotime($this->input->post('MonevTglSel'))),
						'monevcatatan' => $this->input->post('MonevCatatan'),
						'monevstatus' => $this->input->post('MonevStatus'),
						'pegnip' => $this->input->post('PegNIP')
					);
					$uploadphoto = $this->_uploadImage($id);
					if($uploadphoto!=""){
						$data['monevfoto'] = $uploadphoto;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_monev_sarpras','id_monev',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Monev Sarpras has been updated successfully!');
						redirect(base_url('admin/monev_sarpras'));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_monev_sarpras','id_monev',$id);
				$data['title'] = 'Monev Sarpras';
				$data['page'] = 'monev_sarpras';
				$data['view'] = 'admin/monev_sarpras/edit';
				$this->load->view('layout', $data);
			}
		}

		function view($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			$data['data'] = $this->master_model->get_master_by_id('tb_monev_sarpras','id_monev',$id);
			$data['title'] = 'Monev Sarpras';
			$data['page'] = 'monev_sarpras';
			$data['view'] = 'admin/monev_sarpras/view';
			$this->load->view('layout', $data);
		}

		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_monev_sarpras', array('id_monev' => $id));
			$this->session->set_flashdata('msg', 'Monev Sarpras has been deleted successfully!');
			redirect(base_url('admin/monev_sarpras'));
		}

		private function _uploadImage($id)
		{
			$path = './uploads/files/monev_sarpras/';
			if(!is_dir($path)){
			  mkdir($path);
			}
			$cpt = count($_FILES['MonevFoto']['name']);
			for($i=0; $i<$cpt; $i++){         
				$_FILES['file']['name'] = $_FILES['MonevFoto']['name'][$i];
	          	$_FILES['file']['type'] = $_FILES['MonevFoto']['type'][$i];
	          	$_FILES['file']['tmp_name'] = $_FILES['MonevFoto']['tmp_name'][$i];
	          	$_FILES['file']['error'] = $_FILES['MonevFoto']['error'][$i];
	          	$_FILES['file']['size'] = $_FILES['MonevFoto']['size'][$i];  

			    $config['upload_path']   	= $path;
			    $config['allowed_types']  	= 'jpg|jpeg|png|gif';
			    $config['overwrite']		= true;
			    $config['max_size']   		= 4096; // 4MB
			    $config['file_name'] 		= $id.'_'.$i;

			    $this->load->library('upload', $config);
	  			$this->upload->initialize($config);
			    if ($this->upload->do_upload('file')) {
			    	$uploadData = $this->upload->data();
            		$image_array[] = $uploadData['file_name'];
            		$image = implode(',', $image_array);
			    }else{
			    	//$image = $this->upload->display_errors();
			    	$image ="";
			    }
			}
		    return $image;
		}

	}


?>