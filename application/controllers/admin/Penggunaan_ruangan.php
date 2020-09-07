	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Penggunaan_ruangan extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_penggunaan_ruangan');
			$data['title'] = 'Penggunaan Ruangan';
			$data['page'] = 'penggunaan_ruangan';
			$data['view'] = 'admin/penggunaan_ruangan/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_penggunaan_ruangan','rgnid');
		}

		function add($lanjasid=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('LanJasId', 'Layanan', 'trim|required');
				$this->form_validation->set_rules('SarId', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('RgnTglMul', 'Tanggal Mulai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('RgnTglSel', 'Tanggal Selesai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('RgnJamMul', 'Jam Mulai', 'trim|required');
				$this->form_validation->set_rules('RgnJamSel', 'Jam Selesai', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Penggunaan Ruangan';
					$data['page'] = 'penggunaan_ruangan';
					$data['lanjasid'] = $lanjasid;
					$data['lanjas'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
					$data['all_lanjas'] = $this->master_model->get_master('tb_layanan_lab_eks');
					$data['view'] = 'admin/penggunaan_ruangan/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'rgnid' => 'PRT'.date('YmdHis').'_'.$this->input->post('LanJasId').'_'.$this->input->post('SarId'),
						'lanjasid' => $this->input->post('LanJasId'),
						'sarid' => $this->input->post('SarId'),
						'rgnpemesan' => $this->input->post('RgnPemesan'),
						'rgnkegiatan' => $this->input->post('RgnKegiatan'),
						'rgntglmul' => date('Y-m-d',strtotime($this->input->post('RgnTglMul'))),
						'rgntglsel' => date('Y-m-d',strtotime($this->input->post('RgnTglSel'))),
						'rgnjammul' => date('H:i',strtotime($this->input->post('RgnJamMul'))),
						'rgnjamsel' => date('H:i',strtotime($this->input->post('RgnJamSel'))),
						'rgnpmkint' => $this->input->post('RgnPmkInt'),
						'rgnpmkekt' => $this->input->post('RgnPmkEkt'),
						'rgncatatan' => $this->input->post('RgnCatatan'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_penggunaan_ruangan',$data);
					$lanjasid = $this->input->post('LanJasId');
					if($result){
						$this->session->set_flashdata('msg', 'Penggunaan Ruangan has been added successfully!');
						redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
					}
				}
			}
			else{
			$data['title'] = 'Penggunaan Ruangan';
			$data['page'] = 'penggunaan_ruangan';
			$data['lanjasid'] = $lanjasid;
			$data['lanjas'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
			$data['all_lanjas'] = $this->master_model->get_master('tb_layanan_lab_eks');
			$data['view'] = 'admin/penggunaan_ruangan/add';
			$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('LanJasId', 'Layanan', 'trim|required');
				$this->form_validation->set_rules('SarId', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('RgnTglMul', 'Tanggal Mulai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('RgnTglSel', 'Tanggal Selesai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('RgnJamMul', 'Jam Mulai', 'trim|required');
				$this->form_validation->set_rules('RgnJamSel', 'Jam Selesai', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['data'] = $this->master_model->get_master_by_id('tb_penggunaan_ruangan','rgnid',$id);
					$data['title'] = 'Penggunaan Ruangan';
					$data['page'] = 'penggunaan_ruangan';
					$data['view'] = 'admin/penggunaan_ruangan/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'lanjasid' => $this->input->post('LanJasId'),
						'sarid' => $this->input->post('SarId'),
						'rgnpemesan' => $this->input->post('RgnPemesan'),
						'rgnkegiatan' => $this->input->post('RgnKegiatan'),
						'rgntglmul' => date('Y-m-d',strtotime($this->input->post('RgnTglMul'))),
						'rgntglsel' => date('Y-m-d',strtotime($this->input->post('RgnTglSel'))),
						'rgnjammul' => date('H:i',strtotime($this->input->post('RgnJamMul'))),
						'rgnjamsel' => date('H:i',strtotime($this->input->post('RgnJamSel'))),
						'rgnpmkint' => $this->input->post('RgnPmkInt'),
						'rgnpmkekt' => $this->input->post('RgnPmkEkt'),
						'rgncatatan' => $this->input->post('RgnCatatan')
					);
					//print_r($data);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_penggunaan_ruangan','rgnid',$data, $id);
					$lanjasid = $this->input->post('LanJasId');
					if($result){
						$this->session->set_flashdata('msg', 'Penggunaan Ruangan has been updated successfully!');
						redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_penggunaan_ruangan','rgnid',$id);
				$data['title'] = 'Penggunaan Ruangan';
				$data['page'] = 'penggunaan_ruangan';
				$data['view'] = 'admin/penggunaan_ruangan/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$lanjasid)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_penggunaan_ruangan', array('rgnid' => $id));
			$this->session->set_flashdata('msg', 'Penggunaan Ruangan has been deleted successfully!');
			
			redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
		}

		public function date_penggunaan_ruangan($date1,$date2,$time1,$time2,$sarid)
        {
        	//$sarid = 2;
        	$query = $this->db->query('SELECT * FROM tb_penggunaan_ruangan WHERE (sarid='.$sarid.' AND rgntglmul >= "'.$date1.'" AND rgntglmul <= "'.$date2.'") OR (sarid='.$sarid.' AND rgntglsel >= "'.$date1.'" AND rgntglsel <= "'.$date2.'")')->result();
			if($query){
          		foreach($query as $row){
          			$rgnid = $row->rgnid;
          			$jam1 = $row->rgnjammul;
          			$jam2 = $row->rgnjamsel;
          			$cekjam = 'SELECT * FROM tb_penggunaan_ruangan WHERE (sarid="'.$sarid.'" AND rgnjammul >= "'.$time1.'" AND rgnjammul <= "'.$time2.'") OR (sarid="'.$sarid.'" AND rgnjamsel >= "'.$time1.'" AND rgnjamsel <= "'.$time2.'")';
          			$query2 = $this->db->query($cekjam)->result();
          			if($query2){
          				$valid = 'exist';
          			}else{
          				$valid = 'available';
          			}
          		}	
          	}else{
      			$valid = 'available';
            }
            return $valid;
        }

        public function datetime_exists()
        {
        	$date1 = date('Y-m-d',strtotime($this->input->post('RgnTglMul')));
        	$date2 = date('Y-m-d',strtotime($this->input->post('RgnTglSel')));
        	$time1 = date('H:i:s',strtotime($this->input->post('RgnJamMul')));
        	$time2 = date('H:i:s',strtotime($this->input->post('RgnJamSel')));
        	$sarid = $this->input->post('SarId');
        	$res = $this->date_penggunaan_ruangan($date1,$date2,$time1,$time2,$sarid);
        	if($res=='available'){
        		return TRUE;
        	}else{
        		$this->form_validation->set_message('datetime_exists', 'Sarpras tepakai ditanggal tersebut. Silahkan pilih tanggal lain.');
          		return FALSE;
        	}
        }

		// public function datefrom_exists($date)
  //       {
  //       	$rgndate = date('Y-m-d',strtotime($this->input->post('RgnTglMul')));
  //       	$sarid = $this->input->post('SarId');
  //       	$query = $this->db->query('SELECT * FROM tb_penggunaan_ruangan WHERE sarid='.$sarid.' AND rgntglmul <= "'.$rgndate.'" AND rgntglsel >= "'.$rgndate.'"')->num_rows();
		// 	 if($query>0){
  //         		$this->form_validation->set_message('datefrom_exists', 'Please enter another date (Tanggal Mulai)');
  //         		return FALSE;
  //         	}else{
  //     			return TRUE;
  //           }
  //       }

		// public function dateuntil_exists($date)
  //       {
  //       	$rgndate = date('Y-m-d',strtotime($this->input->post('RgnTglSel')));
  //       	$sarid = $this->input->post('SarId');
		// 	$query = $this->db->query('SELECT * FROM tb_penggunaan_ruangan WHERE rgntglmul <= "'.$rgndate.'" AND sarid='.$sarid.' AND rgntglsel >= "'.$rgndate.'"')->num_rows();
		// 	 if($query>0){
  //         		$this->form_validation->set_message('dateuntil_exists', 'Please enter another date (Tanggal Selesai)');
  //         		return FALSE;
  //         	}else{
  //     			return TRUE;
  //           }
  //       }

	}


?>