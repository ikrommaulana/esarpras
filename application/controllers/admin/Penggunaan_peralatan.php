	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Penggunaan_peralatan extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_penggunaan_peralatan');
			$data['title'] = 'Penggunaan Peralatan';
			$data['page'] = 'penggunaan_peralatan';
			$data['view'] = 'admin/penggunaan_peralatan/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_penggunaan_peralatan','prtid');
		}

		function add($lanjasid=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('LanJasId', 'Layanan', 'trim|required');
				$this->form_validation->set_rules('SarId', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('PrtTglMul', 'Tanggal Mulai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('PrtTglSel', 'Tanggal Selesai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('PrtJamMul', 'Jam Mulai', 'trim|required');
				$this->form_validation->set_rules('PrtJamSel', 'Jam Selesai', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Penggunaan Peralatan';
					$data['page'] = 'penggunaan_peralatan';
					$data['lanjasid'] = $lanjasid;
					$data['lanjas'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
					$data['all_lanjas'] = $this->master_model->get_master('tb_layanan_lab_eks');
					$data['view'] = 'admin/penggunaan_peralatan/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'prtid' => 'PRT'.date('YmdHis').'_'.$this->input->post('LanJasId').'_'.$this->input->post('SarId'),
						'lanjasid' => $this->input->post('LanJasId'),
						'sarid' => $this->input->post('SarId'),
						'prtpemesan' => $this->input->post('PrtPemesan'),
						'prtkegiatan' => $this->input->post('PrtKegiatan'),
						'prttglmul' => date('Y-m-d',strtotime($this->input->post('PrtTglMul'))),
						'prttglsel' => date('Y-m-d',strtotime($this->input->post('PrtTglSel'))),
						'prtjammul' => date('H:i',strtotime($this->input->post('PrtJamMul'))),
						'prtjamsel' => date('H:i',strtotime($this->input->post('PrtJamSel'))),
						'prtpmkint' => $this->input->post('PrtPmkInt'),
						'prtpmkekt' => $this->input->post('PrtPmkEkt'),
						'prtcatatan' => $this->input->post('PrtCatatan'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_penggunaan_peralatan',$data);
					$lanjasid = $this->input->post('LanJasId');
					if($result){
						$this->session->set_flashdata('msg', 'Penggunaan Peralatan has been added successfully!');
						redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
					}
				}
			}
			else{
			$data['title'] = 'Penggunaan Peralatan';
			$data['page'] = 'penggunaan_peralatan';
			$data['lanjasid'] = $lanjasid;
			$data['lanjas'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
			$data['all_lanjas'] = $this->master_model->get_master('tb_layanan_lab_eks');
			$data['view'] = 'admin/penggunaan_peralatan/add';
			$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('LanJasId', 'Layanan', 'trim|required');
				$this->form_validation->set_rules('SarId', 'Sarpras', 'trim|required');
				$this->form_validation->set_rules('PrtTglMul', 'Tanggal Mulai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('PrtTglSel', 'Tanggal Selesai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('PrtJamMul', 'Jam Mulai', 'trim|required');
				$this->form_validation->set_rules('PrtJamSel', 'Jam Selesai', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
				$data['data'] = $this->master_model->get_master_by_id('tb_penggunaan_peralatan','prtid',$id);
				$data['title'] = 'Penggunaan Peralatan';
				$data['page'] = 'penggunaan_peralatan';
					$data['view'] = 'admin/penggunaan_peralatan/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'lanjasid' => $this->input->post('LanJasId'),
						'sarid' => $this->input->post('SarId'),
						'prtpemesan' => $this->input->post('PrtPemesan'),
						'prtkegiatan' => $this->input->post('PrtKegiatan'),
						'prttglmul' => date('Y-m-d',strtotime($this->input->post('PrtTglMul'))),
						'prttglsel' => date('Y-m-d',strtotime($this->input->post('PrtTglSel'))),
						'prtjammul' => date('H:i',strtotime($this->input->post('PrtJamMul'))),
						'prtjamsel' => date('H:i',strtotime($this->input->post('PrtJamSel'))),
						'prtpmkint' => $this->input->post('PrtPmkInt'),
						'prtpmkekt' => $this->input->post('PrtPmkEkt'),
						'prtcatatan' => $this->input->post('PrtCatatan'),
					);
					//print_r($data);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_penggunaan_peralatan','prtid',$data, $id);
					$lanjasid = $this->input->post('LanJasId');
					if($result){
						$this->session->set_flashdata('msg', 'Penggunaan Peralatan has been updated successfully!');
						redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_penggunaan_peralatan','prtid',$id);
				$data['title'] = 'Penggunaan Peralatan';
				$data['page'] = 'penggunaan_peralatan';
				$data['view'] = 'admin/penggunaan_peralatan/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$lanjasid)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_penggunaan_peralatan', array('prtid' => $id));
			$this->session->set_flashdata('msg', 'Penggunaan Peralatan has been deleted successfully!');
			
			redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
		}

		public function date_penggunaan_peralatan($date1,$date2,$time1,$time2,$sarid)
        {
        	//$sarid = 2;
        	$query = $this->db->query('SELECT * FROM tb_penggunaan_peralatan WHERE (sarid='.$sarid.' AND prttglmul >= "'.$date1.'" AND prttglmul <= "'.$date2.'") OR (sarid='.$sarid.' AND prttglsel >= "'.$date1.'" AND prttglsel <= "'.$date2.'")')->result();
			if($query){
          		foreach($query as $row){
          			$prtid = $row->prtid;
          			$jam1 = $row->prtjammul;
          			$jam2 = $row->prtjamsel;
          			$cekjam = 'SELECT * FROM tb_penggunaan_peralatan WHERE (sarid="'.$sarid.'" AND prtjammul >= "'.$time1.'" AND prtjammul <= "'.$time2.'") OR (sarid="'.$sarid.'" AND prtjamsel >= "'.$time1.'" AND prtjamsel <= "'.$time2.'")';
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
        	$date1 = date('Y-m-d',strtotime($this->input->post('PrtTglMul')));
        	$date2 = date('Y-m-d',strtotime($this->input->post('PrtTglSel')));
        	$time1 = date('H:i:s',strtotime($this->input->post('PrtJamMul')));
        	$time2 = date('H:i:s',strtotime($this->input->post('PrtJamSel')));
        	$sarid = $this->input->post('SarId');
        	$res = $this->date_penggunaan_peralatan($date1,$date2,$time1,$time2,$sarid);
        	if($res=='available'){
        		return TRUE;
        	}else{
        		$this->form_validation->set_message('datetime_exists', 'Sarpras tepakai ditanggal tersebut. Silahkan pilih tanggal lain.');
        	}
        }

	}


?>