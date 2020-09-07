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
			if($this->session->userdata('admin_role')=='superadmin'){
			$data['all_data'] =  $this->master_model->get_simple_jadpem();
			}else{
				$get_admin = $this->db->query('select * from ci_admin
					where admin_id='.$this->session->userdata('admin_id'))->result();
				$priviledge = (isset($get_admin[0]->priviledge))? $get_admin[0]->priviledge : set_value('priviledge');
				if($priviledge==3){
					$data['all_data'] =  $this->master_model->get_simple_jadpem();
				}else{
					$pegnip = (isset($get_admin[0]->pegnip))? $get_admin[0]->pegnip : set_value('pegnip');
					$get_lab = $this->db->query('select * from tb_personil_daftar
						where pegnip="'.$pegnip.'"')->result();
					$idlab = (isset($get_lab[0]->idlab))? $get_lab[0]->idlab : set_value('idlab');
					$data['all_data'] =  $this->master_model->get_all_pemeliharaan_by_lab($idlab);
				}
			}
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
				$this->form_validation->set_rules('JadPemTglMul', 'Tanggal Mulai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('JadPemTglSel', 'Tanggal Selesai', 'trim|required|callback_datetime_exists');
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
				$this->form_validation->set_rules('JadPemTglMul', 'Tanggal Mulai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('JadPemTglSel', 'Tanggal Selesai', 'trim|required|callback_datetime_exists');
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

		public function date_jadwal_pemeliharaan($date1,$date2,$sarid)
        {
        	//$sarid = 2;
        	$query = $this->db->query('SELECT * FROM tb_jadwal_pemeliharaan WHERE (sarid='.$sarid.' AND jadpemtglmul >= "'.$date1.'" AND jadpemtglmul <= "'.$date2.'") OR (sarid='.$sarid.' AND jadpemtglsel >= "'.$date1.'" AND jadpemtglsel <= "'.$date2.'")')->result();
			if($query){
      			$valid = 'exist';
          	}else{
      			$valid = $this->date_monev_sarpras($date1,$date2,$sarid);
            }
            return $valid;
        }

		public function date_monev_sarpras($date1,$date2,$sarid)
        {
        	//$sarid = 2;
        	$query = $this->db->query('SELECT * FROM tb_monev_sarpras WHERE (sarid='.$sarid.' AND monevtglmul >= "'.$date1.'" AND monevtglmul <= "'.$date2.'") OR (sarid='.$sarid.' AND monevtglsel >= "'.$date1.'" AND monevtglsel <= "'.$date2.'")')->result();
			if($query){
      			$valid = 'exist';
          	}else{
      			$valid = $this->date_jadwal_penggunaan($date1,$date2,$sarid);
            }
            return $valid;
        }

		public function date_jadwal_penggunaan($date1,$date2,$sarid)
        {
        	$query = $this->db->query('SELECT * FROM tb_penggunaan_ruangan WHERE (sarid='.$sarid.' AND rgntglmul >= "'.$date1.'" AND rgntglmul <= "'.$date2.'") OR (sarid='.$sarid.' AND rgntglsel >= "'.$date1.'" AND rgntglsel <= "'.$date2.'")')->result();
			if($query){
      			$valid = 'exist';
          	}else{
      			$query2 = $this->db->query('SELECT * FROM tb_penggunaan_peralatan WHERE (sarid='.$sarid.' AND prttglmul >= "'.$date1.'" AND prttglmul <= "'.$date2.'") OR (sarid='.$sarid.' AND prttglsel >= "'.$date1.'" AND prttglsel <= "'.$date2.'")')->result();
      			if($query2){
      				$valid = 'exist';
      			}else{
      				$valid = 'available';
      			}
            }
            return $valid;
        }

        public function datetime_exists()
        {
        	$date1 = date('Y-m-d',strtotime($this->input->post('JadPemTglMul')));
        	$date2 = date('Y-m-d',strtotime($this->input->post('JadPemTglSel')));
        	$sarid = $this->input->post('SarId');
        	$res = $this->date_jadwal_pemeliharaan($date1,$date2,$sarid);
        	if($res=='available'){
        		return TRUE;
        	}else{
        		$this->form_validation->set_message('datetime_exists', 'Sarpras tepakai ditanggal tersebut. Silahkan pilih tanggal lain.');
          		return FALSE;
        	}
        }

	}


?>