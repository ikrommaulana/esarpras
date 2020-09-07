	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Tenaga_ahli extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_tenaga_ahli');
			$data['title'] = 'Tenaga Ahli';
			$data['page'] = 'tenaga_ahli';
			$data['view'] = 'admin/tenaga_ahli/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_tenaga_ahli','tnaid');
		}

		function add($lanjasid=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('LanJasId', 'Layanan', 'trim|required');
				$this->form_validation->set_rules('PegNIP', 'Personil', 'trim|required');
				$this->form_validation->set_rules('TnaTglMul', 'Tanggal Mulai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('TnaTglSel', 'Tanggal Selesai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('TnaJamMul', 'Jam Mulai', 'trim|required');
				$this->form_validation->set_rules('TnaJamSel', 'Jam Selesai', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Tenaga Ahli';
					$data['page'] = 'tenaga_ahli';
					$data['lanjasid'] = $lanjasid;
					$data['lanjas'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
					$data['all_lanjas'] = $this->master_model->get_master('tb_layanan_lab_eks');
					$data['view'] = 'admin/tenaga_ahli/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'tnaid' => 'TA'.date('YmdHis').'_'.$this->input->post('LanJasId').'_'.$this->input->post('SarId'),
						'lanjasid' => $this->input->post('LanJasId'),
						'pegnip' => $this->input->post('PegNIP'),
						'pdkjenjang' => $this->input->post('PdkJenjang'),
						'tranmtraining' => $this->input->post('TraNmTraining'),
						'tnakomlain' => $this->input->post('TnaKomLain'),
						'tnaperan' => $this->input->post('TnaPeran'),
						'tnatglmul' => date('Y-m-d',strtotime($this->input->post('TnaTglMul'))),
						'tnatglsel' => date('Y-m-d',strtotime($this->input->post('TnaTglSel'))),
						'tnajammul' => date('H:i',strtotime($this->input->post('TnaJamMul'))),
						'tnajamsel' => date('H:i',strtotime($this->input->post('TnaJamSel'))),
						'tnacatatan' => $this->input->post('TnaCatatan'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_tenaga_ahli',$data);
					$lanjasid = $this->input->post('LanJasId');
					if($result){
						$this->session->set_flashdata('msg', 'Tenaga Ahli has been added successfully!');
						redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
					}
				}
			}
			else{
			$data['title'] = 'Tenaga Ahli';
			$data['page'] = 'tenaga_ahli';
			$data['lanjasid'] = $lanjasid;
			$data['lanjas'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
			$data['all_lanjas'] = $this->master_model->get_master('tb_layanan_lab_eks');
			$data['view'] = 'admin/tenaga_ahli/add';
			$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('LanJasId', 'Layanan', 'trim|required');
				$this->form_validation->set_rules('PegNIP', 'Personil', 'trim|required');
				$this->form_validation->set_rules('TnaTglMul', 'Tanggal Mulai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('TnaTglSel', 'Tanggal Selesai', 'trim|required|callback_datetime_exists');
				$this->form_validation->set_rules('TnaJamMul', 'Jam Mulai', 'trim|required');
				$this->form_validation->set_rules('TnaJamSel', 'Jam Selesai', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['data'] = $this->master_model->get_master_by_id('tb_tenaga_ahli','tnaid',$id);
					$data['title'] = 'Tenaga Ahli';
					$data['page'] = 'tenaga_ahli';
					$data['view'] = 'admin/tenaga_ahli/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'lanjasid' => $this->input->post('LanJasId'),
						'pegnip' => $this->input->post('PegNIP'),
						'pdkjenjang' => $this->input->post('PdkJenjang'),
						'tranmtraining' => $this->input->post('TraNmTraining'),
						'tnakomlain' => $this->input->post('TnaKomLain'),
						'tnaperan' => $this->input->post('TnaPeran'),
						'tnatglmul' => date('Y-m-d',strtotime($this->input->post('TnaTglMul'))),
						'tnatglsel' => date('Y-m-d',strtotime($this->input->post('TnaTglSel'))),
						'tnajammul' => date('H:i',strtotime($this->input->post('TnaJamMul'))),
						'tnajamsel' => date('H:i',strtotime($this->input->post('TnaJamSel'))),
						'tnacatatan' => $this->input->post('TnaCatatan')
					);
					//print_r($data);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_tenaga_ahli','tnaid',$data, $id);
					$lanjasid = $this->input->post('LanJasId');
					if($result){
						$this->session->set_flashdata('msg', 'Tenaga Ahli has been updated successfully!');
						redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_tenaga_ahli','tnaid',$id);
				$data['title'] = 'Tenaga Ahli';
				$data['page'] = 'tenaga_ahli';
				$data['view'] = 'admin/tenaga_ahli/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$lanjasid)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_tenaga_ahli', array('tnaid' => $id));
			$this->session->set_flashdata('msg', 'Tenaga Ahli has been deleted successfully!');
			
			redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
		}

		public function date_tenaga_ahli($date1,$date2,$time1,$time2,$sarid)
        {
        	//$sarid = 2;
        	$query = $this->db->query('SELECT * FROM tb_penggunaan_peralatan WHERE (sarid='.$sarid.' AND tnatglmul >= "'.$date1.'" AND tnattglmul <= "'.$date2.'") OR (sarid='.$sarid.' AND tnatglsel >= "'.$date1.'" AND tnatglsel <= "'.$date2.'")')->result();
			if($query){
          		foreach($query as $row){
          			$tnaid = $row->tnaid;
          			$jam1 = $row->tnajammul;
          			$jam2 = $row->tnajamsel;
          			$cekjam = 'SELECT * FROM tb_penggunaan_peralatan WHERE (sarid="'.$sarid.'" AND tnajammul >= "'.$time1.'" AND tnajammul <= "'.$time2.'") OR (sarid="'.$sarid.'" AND tnajamsel >= "'.$time1.'" AND tnajamsel <= "'.$time2.'")';
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
        	$date1 = date('Y-m-d',strtotime($this->input->post('TnaTglMul')));
        	$date2 = date('Y-m-d',strtotime($this->input->post('TnaTglSel')));
        	$time1 = date('H:i:s',strtotime($this->input->post('TnaJamMul')));
        	$time2 = date('H:i:s',strtotime($this->input->post('TnaJamSel')));
        	$sarid = $this->input->post('SarId');
        	$res = $this->date_tenaga_ahli($date1,$date2,$time1,$time2,$sarid);
        	if($res=='available'){
        		return TRUE;
        	}else{
        		$this->form_validation->set_message('datetime_exists', 'Sarpras tepakai ditanggal tersebut. Silahkan pilih tanggal lain.');
        	}
        }

	}


?>