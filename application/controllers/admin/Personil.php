	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Personil extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_personil'] =  $this->master_model->get_all_simple_master('m_personil');
			$data['title'] = 'Personil';
			$data['view'] = 'admin/personil/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status_peg('m_personil','id_personil');
		}

		function add(){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('PegNama', 'Nama Pegawai', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/personil/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'pegnama' => $this->input->post('PegNama'),
						'pegemail' => $this->input->post('PegEmail'),
						'pegstatus' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$uploadphoto = $this->_uploadImage($this->input->post('PegNIP'));
					if($uploadphoto!=""){
						//echo $uploadphoto;
						$data['pegphoto'] = $uploadphoto;
					}
					// print_r($data);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('m_personil',$data);
					if($result){
							redirect(base_url('admin/personil'));
					}
				}
			}
			else{
				$data['view'] = 'admin/personil/add';
				$this->load->view('layout', $data);
			}
			
		}

		/**function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('PegNama', 'Nama Pegawai', 'trim|required');
				$this->form_validation->set_rules('PegAsal', 'Asal Pegawai', 'trim|required');
				$this->form_validation->set_rules('IdLab', 'Id Lab', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/personil/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'pegnama' => $this->input->post('PegNama'),
						'pegasal' => $this->input->post('PegAsal'),
						'idlab' => $this->input->post('IdLab')
					);
					$uploadphoto = $this->_uploadImage($this->input->post('PegNIP'));
					if($uploadphoto!=" "){
						$data['pegphoto'] = $uploadphoto;
					}
					if($this->input->post('PegNIP')){
						$data2['pegnip'] = $this->input->post('PegNIP');
						$data2 = $this->security->xss_clean($data2);
						$tb1 = $this->master_model->edit_master('tb_personil_pendidikan','pegnip',$data2, $data2['pegnip']);
						$tb2 = $this->master_model->edit_master('tb_personil_training','pegnip',$data2, $data2['pegnip']);
						$tb3 = $this->master_model->edit_master('tb_sertifikat_personil','pegnip',$data2, $data2['pegnip']);
						$tb4 = $this->master_model->edit_master('tb_tenaga_ahli','pegnip',$data2, $data2['pegnip']);
						$tb5 = $this->master_model->edit_master('tb_monev_sarpras','pegnip',$data2, $data2['pegnip']);
						$tb6 = $this->master_model->edit_master('tb_jadwal_pemeliharaan','jadpempic',$data2, $data2['pegnip']);
					}

					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_personil','id_personil',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Personil has been updated successfully!');
						redirect(base_url('admin/personil'));
					}
				}
			}
			else{
				$data['personil'] = $this->master_model->get_master_by_id('m_personil','id_personil',$id);
				$data['view'] = 'admin/personil/edit';
				$this->load->view('layout', $data);
			}
		}**/

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submitPeg')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('PegNama', 'Nama Pegawai', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['personil'] = $this->master_model->get_master_by_id('m_personil','id_personil',$id);
					$data['title'] = 'Data Personil';
					$data['page'] = 'personil';
					$data['view'] = 'admin/personil/edit_personil';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'pegnip' => $this->input->post('PegNIP'),
						'pegnama' => $this->input->post('PegNama'),
						'pegemail' => $this->input->post('PegEmail'),
					);
					$uploadphoto = $this->_uploadImage($this->input->post('PegNIP'));
					if($uploadphoto!=" "){
						$data['pegphoto'] = $uploadphoto;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_personil','id_personil',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Profile has been updated successfully!');
						redirect(base_url('admin/personil/edit/'.$id));
					}
				}
			}

			if($this->input->post('submitAdm')){
				$this->form_validation->set_rules('AdminId', 'Administrator', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['personil'] = $this->master_model->get_master_by_id('m_personil','id_personil',$id);
					$data['title'] = 'Data Personil';
					$data['page'] = 'personil';
					$data['view'] = 'admin/personil/edit_personil';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'admin_id' => $this->input->post('AdminId'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_personil','id_personil',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Administrator has been updated successfully!');
						redirect(base_url('admin/personil/edit/'.$id));
					}
				}
			}


			$data['personil'] = $this->master_model->get_master_by_id('m_personil','id_personil',$id);
			$data['title'] = 'Data Personil';
			$data['page'] = 'personil';
			$data['view'] = 'admin/personil/edit_personil';
			$this->load->view('layout', $data);
			
		}

		function view($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			$data['personil'] = $this->master_model->get_master_by_id('m_personil','id_personil',$id);
			$data['title'] = 'Data Personil';
			$data['page'] = 'personil';
			$data['view'] = 'admin/personil/view_personil';
			$this->load->view('layout', $data);
			
		}


		function delete($id = 0)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('m_personil', array('id_personil' => $id));
			$this->session->set_flashdata('msg', 'Personil has been deleted successfully!');
			redirect(base_url('admin/personil'));
		}

		private function _uploadImage($id)
		{
			$path = './uploads/images/personil/';
		    $config['upload_path']          = $path;
		    $config['allowed_types']        = 'jpeg|jpg|png';
		    $config['file_name']            = $id."_".time();
		    $config['overwrite']			= true;
		    $config['max_size']             = 4096; // 4MB

		    $this->load->library('upload', $config);
  			$this->upload->initialize($config);

		    if ($this->upload->do_upload('PegPhoto')) {
		        $image = $this->upload->data('file_name');
		    }else{
		    	$image = " ";
		    }
		    return $image;
		    // if (!$this->upload->do_upload('PegPhoto')){
      //       	$error = $this->upload->display_errors(); //menampilkan pesan error
      //       	print_r($error);
	     //    } else {
	     //        $result = $this->upload->data();
	     //        echo "<pre>";
	     //        print_r($result);
	     //        echo "</pre>";
	     //    }
		}

	}


?>