<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('admin/dashboard_model', 'dashboard_model');
			$this->load->model('dashboard_model');
		}

		public function index(){
			$inputdate1 = $this->input->post('dari');
			$inputdate2 = $this->input->post('sampai');
			$date1 = (isset($inputdate1))? date('Y-m',strtotime($inputdate1)) : date('Y-m', strtotime('-2 months'));
			$date2 = (isset($inputdate2))? date('Y-m',strtotime($inputdate2)) : date('Y-m');
			// echo $date1.'----'.$date2;
			$datefrom = date('m/Y',strtotime($date1));
			$dateuntil = date('m/Y',strtotime($date2));
			if($this->session->userdata('admin_role')=='superadmin'){
				$data['total1'] = 'Total Laboratorium';
				$data['total_total1'] = $this->dashboard_model->get_all_lab();
				$data['total_sarpras'] = $this->dashboard_model->get_all_sarpras();
				$data['total_pengadaan'] = $this->dashboard_model->sum_pengadaan()[0]->total_biaya;
				// $data['pengadaan'] = $this->dashboard_model->get_pengadaan_perday($date1,$date2);
				$data['top_penggunaan'] = $this->dashboard_model->count_penggunaan_lab($datefrom,$dateuntil);
				$data['top_pemeliharaan'] = $this->dashboard_model->count_pemeliharaan($datefrom,$dateuntil);
				$data['top_pengadaan'] = $this->dashboard_model->count_pengadaan_lab($datefrom,$dateuntil);
			}else{
				$get_admin = $this->db->query('select * from ci_admin
					where admin_id='.$this->session->userdata('admin_id'))->result();
				$priviledge = (isset($get_admin[0]->priviledge))? $get_admin[0]->priviledge : set_value('priviledge');				if($priviledge==3){
					//L2
					$data['total1'] = 'Total Laboratorium';
					$data['total_total1'] = $this->dashboard_model->get_all_lab();
					$data['total_sarpras'] = $this->dashboard_model->get_all_sarpras();
					$data['total_pengadaan'] = $this->dashboard_model->sum_pengadaan()[0]->total_biaya;
					// $data['pengadaan'] = $this->dashboard_model->get_pengadaan_perday($date1,$date2);
					$data['top_penggunaan'] = $this->dashboard_model->count_penggunaan_lab($datefrom,$dateuntil);
					$data['top_pemeliharaan'] = $this->dashboard_model->count_pemeliharaan($datefrom,$dateuntil);
					$data['top_pengadaan'] = $this->dashboard_model->count_pengadaan_lab($datefrom,$dateuntil);
				}else{
					$pegnip = (isset($get_admin[0]->pegnip))? $get_admin[0]->pegnip : set_value('pegnip');
					$get_lab = $this->db->query('select * from tb_personil_daftar
						where pegnip="'.$pegnip.'"')->result();
					$idlab = (isset($get_lab[0]->idlab))? $get_lab[0]->idlab : set_value('idlab');
					//L1 dan Staff
					$data['idlab'] = $idlab;
					$data['total1'] = 'Total Layanan';
					$data['total_total1'] = $this->dashboard_model->get_all_layanan($idlab);
					$data['total_sarpras'] = $this->dashboard_model->get_all_sarpras($idlab);
					$data['total_pengadaan'] = $this->dashboard_model->sum_pengadaan($idlab)[0]->total_biaya;
					// $data['pengadaan'] = $this->dashboard_model->get_pengadaan_perday($date1,$date2);
					$data['top_penggunaan'] = $this->dashboard_model->count_penggunaan_lay($datefrom,$dateuntil,$idlab);
					$data['top_pemeliharaan'] = $this->dashboard_model->count_pemeliharaan_sar($datefrom,$dateuntil,$idlab);
					$data['top_pengadaan'] = $this->dashboard_model->count_pengadaan_sar($datefrom,$dateuntil,$idlab);
				}
			}
			$data['datefrom'] = $date1;
			$data['dateuntil'] = $date2;
			$data['title'] = 'Dashboard';
			$data['view'] = 'admin/dashboard/index';
			$this->load->view('layout', $data);
		}

		public function chart(){
			$data['title'] = 'Chart';
			$data['view'] = 'admin/dashboard/chart';
			$this->load->view('layout', $data);
		}

		public function chartjs(){
			$data['title'] = 'Chart';
			$data['view'] = 'admin/dashboard/index2';
			$this->load->view('layout', $data);
		}
		
	}

?>	