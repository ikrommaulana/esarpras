	<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Layanan_mitra extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/master_model', 'master_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		    $this->load->library('upload');

			$this->rbac->check_module_access();
		}

		function index(){
			redirect(base_url('admin/dashboard'));
		}

		//-----------------------------------------------------------
		function change_status(){   
			$this->rbac->check_operation_access(); // check opration permission
			$this->master_model->change_status('tb_layanan_mitra','laymitid');
		}

		function add($mitra_id=''){
			$this->rbac->check_operation_access(); // check opration permission
			if($this->input->post('submit')){
				$this->form_validation->set_rules('LayMitNama', 'Nama Layanan', 'trim|required');
				$this->form_validation->set_rules('LayMitHarga', 'Harga Layanan', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['title'] = 'Layanan Mitra';
					$data['page'] = 'layanan_mitra';
					$data['mitra_id'] = $mitra_id;
					$data['mitra'] = $this->master_model->get_master_by_id('m_mitra','mitra_id',$mitra_id);
					$data['all_mitra'] = $this->master_model->get_master('m_mitra');
					$data['view'] = 'admin/layanan_mitra/add';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'mitra_id' => $this->input->post('MitraId'),
						'laymitnama' => $this->input->post('LayMitNama'),
						'laymitharga' => $this->input->post('LayMitHarga'),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('admin_id')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->add_master('tb_layanan_mitra',$data);

					$id = $this->input->post('MitraId');

					if($result){
						$this->session->set_flashdata('msg', 'New Layanan Mitra has been added successfully!');
						redirect(base_url('admin/mitra/edit/'.$id));
					}
				}
			}
			else{
				$data['title'] = 'Layanan Mitra';
				$data['page'] = 'layanan_mitra';
				$data['mitra_id'] = $mitra_id;
				$data['mitra'] = $this->master_model->get_master_by_id('m_mitra','mitra_id',$mitra_id);
				$data['all_mitra'] = $this->master_model->get_master('m_mitra');
				$data['view'] = 'admin/layanan_mitra/add';
				$this->load->view('layout', $data);
			}
			
		}

		function edit($id = 0){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('LayMitNama', 'Nama Layanan', 'trim|required');
				$this->form_validation->set_rules('LayMitHarga', 'Harga Layanan', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['all_data'] = $this->master_model->get_master_by_id('tb_layanan_mitra','laymitid',$id);
					$data['title'] = 'Layanan Mitra';
					$data['page'] = 'layanan_mitra';
					$data['view'] = 'admin/layanan_mitra/edit';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'mitra_id' => $this->input->post('MitraId'),
						'laymitnama' => $this->input->post('LayMitNama'),
						'laymitharga' => $this->input->post('LayMitHarga')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->master_model->edit_master('tb_layanan_mitra','laymitid',$data, $id);

					$id = $this->input->post('MitraId');

					if($result){
						$this->session->set_flashdata('msg', 'Layanan Mitra has been updated successfully!');
						redirect(base_url('admin/mitra/edit/'.$id));
					}
				}
			}
			else{
				$data['all_data'] = $this->master_model->get_master_by_id('tb_layanan_mitra','laymitid',$id);
				$data['title'] = 'Layanan Mitra';
				$data['page'] = 'layanan_mitra';
				$data['view'] = 'admin/layanan_mitra/edit';
				$this->load->view('layout', $data);
			}
		}

		function delete($id = 0,$mitraid)
		{
			$this->rbac->check_operation_access(); // check opration permission
			
			$this->db->delete('tb_layanan_mitra', array('laymitid' => $id));
			$this->session->set_flashdata('msg', 'Layanan Mitra has been deleted successfully!');

			redirect(base_url('admin/mitra/edit/'.$mitraid));
		}

	}


?>