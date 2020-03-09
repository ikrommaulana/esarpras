	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Hasil_penelitian extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
			$data['all_data'] =  $this->master_model->get_all_simple_master('tb_hasil_penelitian');
			$data['title'] = 'Hasil Penelitian';
			$data['page'] = 'hasil_penelitian';
			$data['view'] = 'admin/hasil_penelitian/list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_hasil_penelitian','hasil_id');
		}

		function add($lanjasid=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('LanjasId', 'Kegiatan', 'trim|required');
				$this->form_validation->set_rules('HasilAbstrak', 'Abstrak', 'trim|required');
				$this->form_validation->set_rules('HasilKunci', 'Kunci', 'trim|required');
				$this->form_validation->set_rules('HasilPenulis', 'Penulis', 'trim|required');
				$this->form_validation->set_rules('HasilTglLap', 'Tanggal Laporan', 'trim|required');
				$this->form_validation->set_rules('HasilVersi', 'Versi', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Hasil Penelitian';
					$data['page'] = 'hasil_penelitian';
					$data['lanjasid'] = $lanjasid;
					$data['lanjas'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
					$data['all_lanjas'] = $this->master_model->get_master('tb_layanan_lab_eks');
					$data['view'] = 'admin/hasil_penelitian/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'hasil_id' => 'HSL'.date('YmdHis').'_'.$this->input->post('LanjasId'),
						'lanjasid' => $this->input->post('LanjasId'),
						'hasilabstrak' => $this->input->post('HasilAbstrak'),
						'hasilkunci' => $this->input->post('HasilKunci'),
						'hasilpenulis' => $this->input->post('HasilPenulis'),
						'hasiltgllap' => date('Y-m-d',strtotime($this->input->post('HasilTglLap'))),
						'hasilversi' => $this->input->post('HasilVersi'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$uploadphoto = $this->_uploadImage($this->input->post('LanjasId'));
					if($uploadphoto){
						$data['hasilfile'] = $uploadphoto;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_hasil_penelitian',$data);
					$lanjasid = $this->input->post('LanJasId');
					if($result){
						$this->session->set_flashdata('msg', 'Hasil Penelitian has been added successfully!');
						redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
					}
				}
			}
			else{
			$data['title'] = 'Hasil Penelitian';
			$data['page'] = 'hasil_penelitian';
			$data['lanjasid'] = $lanjasid;
			$data['lanjas'] = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
			$data['all_lanjas'] = $this->master_model->get_master('tb_layanan_lab_eks');
			$data['view'] = 'admin/hasil_penelitian/add';
			$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('LanjasId', 'Kegiatan', 'trim|required');
				$this->form_validation->set_rules('HasilAbstrak', 'Abstrak', 'trim|required');
				$this->form_validation->set_rules('HasilKunci', 'Kunci', 'trim|required');
				$this->form_validation->set_rules('HasilPenulis', 'Penulis', 'trim|required');
				$this->form_validation->set_rules('HasilTglLap', 'Tanggal Laporan', 'trim|required');
				$this->form_validation->set_rules('HasilVersi', 'Versi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/hasil_penelitian/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'lanjasid' => $this->input->post('LanjasId'),
						'hasilabstrak' => $this->input->post('HasilAbstrak'),
						'hasilkunci' => $this->input->post('HasilKunci'),
						'hasilpenulis' => $this->input->post('HasilPenulis'),
						'hasiltgllap' => date('Y-m-d',strtotime($this->input->post('HasilTglLap'))),
						'hasilversi' => $this->input->post('HasilVersi')
					);
					$uploadphoto = $this->_uploadImage($this->input->post('LanjasId'));
					if($uploadphoto){
						$data['hasilfile'] = $uploadphoto;
					}
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_hasil_penelitian','hasil_id',$data, $id);
					$lanjasid = $this->input->post('LanJasId');
					if($result){
						$this->session->set_flashdata('msg', 'Hasil Penelitian has been updated successfully!');
						redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
					}
				}
			}
			else{
				$data['data'] = $this->master_model->get_master_by_id('tb_hasil_penelitian','hasil_id',$id);
				$data['title'] = 'Hasil Penelitian';
				$data['page'] = 'hasil_penelitian';
				$data['view'] = 'admin/hasil_penelitian/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$lanjasid)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_hasil_penelitian', array('hasil_id' => $id));
			$this->session->set_flashdata('msg', 'Hasil Penelitian has been deleted successfully!');
			
			redirect(base_url('admin/layanan_lab_eks/edit/'.$lanjasid));
		}

		private function _uploadImage($id)
		{
			$path = './uploads/files/hasil_penelitian/';
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