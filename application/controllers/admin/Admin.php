<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('rbac');
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/menu_model', 'menu_model');
		$this->load->model('admin/master_model', 'master_model');

		$this->rbac->check_module_access();
    }

	//-----------------------------------------------------		
	function index($type='')
	{
		$this->session->set_userdata('filter_type',$type);
		$this->session->set_userdata('filter_keyword','');
		$this->session->set_userdata('filter_status','');
		
		$data['admin_roles'] = $this->admin->get_admin_roles();
		$data['view']='admin/admin/index';
		$this->load->view('layout',$data);
	}

	//---------------------------------------------------------
	function filterdata()
	{
		$this->session->set_userdata('filter_type',$this->input->post('type'));
		$this->session->set_userdata('filter_status',$this->input->post('status'));
		$this->session->set_userdata('filter_keyword',$this->input->post('keyword'));
	}

	//--------------------------------------------------		
	function list_data()
	{
		$data['info'] = $this->admin->get_all();
		$this->load->view('admin/admin/list',$data);
	}

	//-----------------------------------------------------------
	function change_status()
	{   
		$this->rbac->check_operation_access(); // check opration permission

		$this->admin->change_status();
	}
	
	//--------------------------------------------------
	function add()
	{	
		$this->rbac->check_operation_access(); // check opration permission

		$data['admin_roles']=$this->admin->get_admin_roles();
		$data['personil']=$this->admin->get_available_personil();

		if($this->input->post('submit')){
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('role', 'Role', 'trim|required');
				$this->form_validation->set_rules('priviledge', 'Priviledge', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/admin/add';
					$this->load->view('layout', $data);
				}
				else{
					$pegnip = $this->input->post('pegnip');
					$get_personil = $this->db->query("select * from m_personil where pegnip='".$pegnip."'")->result();
					$email = (isset($get_personil[0]->pegemail))? $get_personil[0]->pegemail : set_value('email');

					$data = array(
						'pegnip' => $pegnip,
						'email' => $email,
						'priviledge' => $this->input->post('priviledge'),
						'admin_role_id' => $this->input->post('role'),
						//'username' => $this->input->post('username'),
						'username' => $email,
						'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
						'is_active' => 1,
						'created_at' => date('Y-m-d : h:m:s'),
						'updated_at' => date('Y-m-d : h:m:s'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->admin->add_admin($data);
					
					$id = (isset($get_personil[0]->id_personil))? $get_personil[0]->id_personil : set_value('id_personil');
					$data2 = array(
						'admin_id' => $result
					);
					$result2 = $this->master_model->edit_master('m_personil','id_personil',$data2, $id);

					if($result){
						$this->session->set_flashdata('msg', 'User has been added successfully!');
						redirect(base_url('admin/admin'));
					}
				}
			}
			else
			{
				$data['view']='admin/admin/add';
				$this->load->view('layout',$data);	
			}
	}

	//--------------------------------------------------
	function edit($id="")
	{
		$this->rbac->check_operation_access(); // check opration permission

		$data['admin_roles'] = $this->admin->get_admin_roles();
		$data['personil']=$this->admin->get_available_personil();

		if($this->input->post('submit')){
			$this->form_validation->set_rules('role', 'Role', 'trim|required');
			$this->form_validation->set_rules('priviledge', 'Priviledge', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['admin'] = $this->admin->get_admin_by_id($id);
				$data['view'] = 'admin/admin/edit';
				$this->load->view('layout', $data);
			}
			else{
				$pegnip = $this->input->post('pegnip');
				$get_personil = $this->db->query("select * from m_personil where pegnip='".$pegnip."'")->result();
				$email = (isset($get_personil[0]->pegemail))? $get_personil[0]->pegemail : set_value('email');

				$data = array(
					'pegnip' => $pegnip,
					'email' => $email,
					'admin_role_id' => $this->input->post('role'),
					'priviledge' => $this->input->post('priviledge'),
						//'username' => $this->input->post('username'),
					'username' => $email,
					'is_active' => 1,
					'updated_at' => date('Y-m-d : h:m:s'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->admin->edit_admin($data, $id);
				
				$id2 = (isset($get_personil[0]->id_personil))? $get_personil[0]->id_personil : set_value('id_personil');
				$data2 = array(
					'admin_id' => $id
				);
				$result2 = $this->master_model->edit_master('m_personil','id_personil',$data2, $id2);
				
				if($result){
					$this->session->set_flashdata('msg', 'Edit Record has been Disabled in Demo!');
					redirect(base_url('admin/admin'));
				}
			}
		}
		elseif($id==""){
			redirect('admin/admin');
		}
		else{
			$data['admin'] = $this->admin->get_admin_by_id($id);
			$data['view'] = 'admin/admin/edit';
			$this->load->view('layout',$data);
		}		
	}

	//--------------------------------------------------
	function check_username($id=0)
    {
		$this->db->from('admin');
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('admin_id !='.$id);
		$query=$this->db->get();
		if($query->num_rows() >0)
			echo 'false';
		else 
	    	echo 'true';
    }

	//--------------------------------------------------
	function addEmail($id=0)
    {
		$this->db->from('m_personil');
		$this->db->where('pegnip',$id);
		$query=$this->db->get();
		$result=$query->result();
		echo $result[0]->pegemail;
    }

    //------------------------------------------------------------
	function delete($id='')
	{   
		$this->rbac->check_operation_access(); // check opration permission

		$this->admin->delete($id);
		$this->session->set_flashdata('msg','Delete operation has been disabled in demo.');	
		redirect('admin/admin');
	}	
}

?>