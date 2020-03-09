	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Daftar_pegawai extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			$data['all_personil'] =  $this->master_model->get_all_simple_master('m_personil');
			//$data['all_personil'] =  $this->db->query('SELECT a.id_personil,a.pegnip,a.pegnama,a.pegasal,a.pegphoto,a.idlab,c.traselesai,b.pdklulus FROM m_personil a LEFT JOIN tb_personil_pendidikan b ON a.pegnip=b.pegnip LEFT JOIN tb_personil_training c ON a.pegnip=c.pegnip LEFT JOIN tb_personil_training d ON a.pegnip=d.pegnip GROUP BY a.pegnip ORDER BY a.pegnip DESC, c.traselesai ASC')->result_array();
			$data['title'] = 'Daftar Pegawai';
			$data['page'] = 'daftar_pegawai';
			$data['view'] = 'admin/kepegawaian/daftar_pegawai';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status_peg('m_personil','id_personil');
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submitPeg')){
				$this->form_validation->set_rules('PegNIP', 'NIP Pegawai', 'trim|required');
				$this->form_validation->set_rules('PegNama', 'Nama Pegawai', 'trim|required');
				$this->form_validation->set_rules('PegAsal', 'Asal Pegawai', 'trim|required');
				$this->form_validation->set_rules('IdLab', 'Id Lab', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/kepegawaian/edit_daftar_pegawai';
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
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('m_personil','id_personil',$data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Profile has been updated successfully!');
						redirect(base_url('admin/daftar_pegawai'));
					}
				}
			}


			$data['personil'] = $this->master_model->get_master_by_id('m_personil','id_personil',$id);
			$data['title'] = 'Data Pegawai';
			$data['page'] = 'daftar_pegawai';
			$data['view'] = 'admin/kepegawaian/edit_daftar_pegawai';
			$this->load->view('layout', $data);
			
		}

		function view($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			$data['personil'] = $this->master_model->get_master_by_id('m_personil','id_personil',$id);
			$data['title'] = 'Data Pegawai';
			$data['page'] = 'daftar_pegawai';
			$data['view'] = 'admin/kepegawaian/view_daftar_pegawai';
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
		    $config['upload_path']          = './uploads/images/personil/';
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
		}

	}


?>