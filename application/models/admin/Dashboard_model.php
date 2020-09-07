<?php
	class Dashboard_model extends CI_Model{

		// public function get_all_users(){
		// 	return $this->db->count_all('ci_admin');
		// }
		// public function get_active_users(){
		// 	$this->db->where('is_active', 1);
		// 	return $this->db->count_all_results('ci_admin');
		// }
		// public function get_deactive_users(){
		// 	$this->db->where('is_active', 0);
		// 	return $this->db->count_all_results('ci_admin');
		// }
		// public function get_all_pegawai(){
		// 	return $this->db->count_all_results('m_personil');
		// }
		public function get_all_lab(){
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('m_lab');
		}
		public function get_all_layanan($idlab=0){
			if($idlab!=0){
				$this->db->where('idlab', $idlab);	
			}
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('tb_layanan_lab');
		}
		public function get_all_sarpras($idlab=0){
			if($idlab!=0){
				$this->db->where('tb_sarpras_lab.idlab', $idlab);	
			}
			$this->db->join('m_lab', 'tb_sarpras_lab.idlab=m_lab.idlab');
			$this->db->where('tb_sarpras_lab.is_active', 1);
			$this->db->where('m_lab.idlab!=', '');
			return $this->db->count_all_results('tb_sarpras_lab');
		}
		public function sum_pengadaan($idlab=0){
			if($idlab!=0){
				$where = 'AND tb_lokasi_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT SUM(tb_pengadaan.loklabbia) AS total_biaya FROM tb_pengadaan INNER JOIN tb_lokasi_lab ON tb_pengadaan.loklabid=tb_lokasi_lab.loklabid INNER JOIN m_lab ON tb_lokasi_lab.idlab=m_lab.idlab WHERE m_lab.idlab!="" '.$where.' ';
			return $this->db->query($query)->result();
		}

		// public function get_pengadaan_perday($date1,$date2){
		// 	$query = 'SELECT COUNT(id) AS total_pengadaan,loklabwak FROM tb_pengadaan WHERE loklabwak>="'.$date1.'" AND loklabwak<="'.$date2.'" GROUP BY loklabwak';
		// 	return $this->db->query($query)->result();
		// }

		public function pengadaan_perday($id,$idlab=0){
			if($idlab!=0){
				$where = 'AND tb_lokasi_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT * FROM tb_pengadaan INNER JOIN tb_lokasi_lab ON tb_pengadaan.loklabid=tb_lokasi_lab.loklabid WHERE  tb_pengadaan.loklabwak="'.$id.'" '.$where.' ';
			return $this->db->query($query)->num_rows();
			// return 1;
		}

		public function pemeliharaan_perday($id,$idlab=0){
			if($idlab!=0){
				$where = 'AND tb_sarpras_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT * FROM tb_jadwal_pemeliharaan INNER JOIN tb_sarpras_lab ON tb_jadwal_pemeliharaan.sarid=tb_sarpras_lab.sarid WHERE tb_jadwal_pemeliharaan.jadpemtglmul<="'.$id.'" AND tb_jadwal_pemeliharaan.jadpemtglsel>="'.$id.'" '.$where.' ';
			return $this->db->query($query)->num_rows();
			// return 1;
		}

		public function prt_perday($id,$idlab=0){
			if($idlab!=0){
				$where = 'AND tb_sarpras_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT * FROM tb_penggunaan_peralatan INNER JOIN tb_sarpras_lab ON tb_penggunaan_peralatan.sarid=tb_sarpras_lab.sarid WHERE tb_penggunaan_peralatan.prttglmul<="'.$id.'" AND tb_penggunaan_peralatan.prttglsel>="'.$id.'" '.$where.' ';
			return $this->db->query($query)->num_rows();
			// return 1;
		}

		public function rgn_perday($id,$idlab=0){
			if($idlab!=0){
				$where = 'AND tb_sarpras_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT * FROM tb_penggunaan_ruangan INNER JOIN tb_sarpras_lab ON tb_penggunaan_ruangan.sarid=tb_sarpras_lab.sarid WHERE tb_penggunaan_ruangan.rgntglmul<="'.$id.'" AND tb_penggunaan_ruangan.rgntglsel>="'.$id.'" '.$where.' ';
			return $this->db->query($query)->num_rows();
			// return 1;
		}

		public function pemeliharaan_range($dt1,$dt2){
			$query = 'SELECT * FROM tb_jadwal_pemeliharaan WHERE jadpemtglmul<="'.$dt1.'" AND jadpemtglsel>="'.$dt2.'" ';
			return $this->db->query($query)->result();
			// return 1;
		}

		public function count_lab_penggunaan_rgn($date1,$date2,$idlab=0){
			$exp1 = explode('/',$date1);
			$month1 = $exp1[0];
			$year1 = $exp1[1];
			$exp2 = explode('/',$date2);
			$month2 = $exp2[0];
			$year2 = $exp2[1];
			if($idlab!=0){
				$where = 'AND b.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT COUNT(*) as jumlah, a.sarid, c.labnamasingkat AS nama,c.labcolor from tb_penggunaan_ruangan a inner join tb_sarpras_lab b on a.sarid=b.sarid inner join m_lab c on b.idlab=c.idlab WHERE MONTH(a.rgntglmul)>="'.$month1.'" AND MONTH(a.rgntglsel)<="'.$month2.'" AND YEAR(a.rgntglmul)>="'.$year1.'" AND YEAR(a.rgntglsel)<="'.$year2.'" '.$where.' group by c.labnamasingkat,c.labcolor';
			return $this->db->query($query)->result_array();
		}

		public function count_lab_penggunaan_prt($date1,$date2,$idlab=0){
			$exp1 = explode('/',$date1);
			$month1 = $exp1[0];
			$year1 = $exp1[1];
			$exp2 = explode('/',$date2);
			$month2 = $exp2[0];
			$year2 = $exp2[1];
			if($idlab!=0){
				$where = 'AND b.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT COUNT(*) as jumlah, a.sarid, c.labnamasingkat AS nama,c.labcolor from tb_penggunaan_peralatan a inner join tb_sarpras_lab b on a.sarid=b.sarid inner join m_lab c on b.idlab=c.idlab WHERE MONTH(a.prttglmul)>="'.$month1.'" AND MONTH(a.prttglsel)<="'.$month2.'" AND YEAR(a.prttglmul)>="'.$year1.'" AND YEAR(a.prttglsel)<="'.$year2.'" '.$where.' group by c.labnamasingkat,c.labcolor';
			return $this->db->query($query)->result_array();
		}

		public function count_penggunaan_lab($dt1,$dt2,$idlab=0){
			if($idlab!=0){
				$peralatan = $this->count_lab_penggunaan_prt($dt1,$dt2);
				$ruangan = $this->count_lab_penggunaan_rgn($dt1,$dt2);
			}else{
				$peralatan = $this->count_lab_penggunaan_prt($dt1,$dt2,$idlab);
				$ruangan = $this->count_lab_penggunaan_rgn($dt1,$dt2,$idlab);
			}
			// $sumArray[] = array();
			// $no = 0;
			// foreach($peralatan as $prt){
			// 	foreach($ruangan as $rgn){
			// 		$sumArray[$no]['namalab'] = $rgn->labnamasingkat;
			// 		$sumArray[$no]['jumlah'] = ($prt->labnamasingkat==$rgn->labnamasingkat) ? $prt->jumlah + $rgn->jumlah : $rgn->jumlah;
			// 		$sumArray[$no]['labcolor'] = $rgn->labcolor;
			// 		$no++;
			// 	}
			// }
			$merge = array_merge($peralatan,$ruangan);
			$sumArray = array_reduce($merge, function ($a, $b) {
			    isset($a[$b['nama']]) ? $a[$b['nama']]['jumlah'] += $b['jumlah'] : $a[$b['nama']] = $b;  
			    return $a;
			});
			return $sumArray;
		}

		public function count_pengadaan_lab($date1,$date2,$idlab=0){
			$exp1 = explode('/',$date1);
			$month1 = $exp1[0];
			$year1 = $exp1[1];
			$exp2 = explode('/',$date2);
			$month2 = $exp2[0];
			$year2 = $exp2[1];
			if($idlab!=0){
				$where = 'AND tb_lokasi_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT m_lab.labnamasingkat AS namasingkat,m_lab.labnama AS nama,tb_lokasi_lab.loklabid,SUM(loklabbia) AS total_biaya FROM tb_pengadaan INNER JOIN tb_lokasi_lab ON tb_pengadaan.loklabid=tb_lokasi_lab.loklabid INNER JOIN m_lab ON tb_lokasi_lab.idlab=m_lab.idlab WHERE MONTH(tb_pengadaan.loklabwak)>="'.$month1.'" AND MONTH(tb_pengadaan.loklabwak)<="'.$month2.'" AND YEAR(tb_pengadaan.loklabwak)>="'.$year1.'" AND YEAR(tb_pengadaan.loklabwak)<="'.$year2.'" '.$where.' GROUP BY tb_lokasi_lab.loklabid,m_lab.labnama,m_lab.labnamasingkat ORDER BY total_biaya DESC LIMIT 5';
			return $this->db->query($query)->result();
		}

		public function count_pemeliharaan($date1,$date2,$idlab=0){
			$exp1 = explode('/',$date1);
			$month1 = $exp1[0];
			$year1 = $exp1[1];
			$exp2 = explode('/',$date2);
			$month2 = $exp2[0];
			$year2 = $exp2[1];
			if($idlab!=0){
				$where = 'AND b.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT COUNT(*) as jumlah, a.sarid, c.labnamasingkat as nama,c.labcolor as color from tb_jadwal_pemeliharaan a inner join tb_sarpras_lab b on a.sarid=b.sarid inner join m_lab c on b.idlab=c.idlab WHERE MONTH(a.jadpemtglmul)>="'.$month1.'" AND MONTH(a.jadpemtglsel)<="'.$month2.'" AND YEAR(a.jadpemtglmul)>="'.$year1.'" AND YEAR(a.jadpemtglsel)<="'.$year2.'" '.$where.' GROUP BY c.labnamasingkat,c.labcolor';
			return $this->db->query($query)->result_array();
		}

		public function pengadaan_permonth($id,$idlab=0){
			$exp = explode('/',$id);
			$month = $exp[1];
			$year = $exp[0];
			if($idlab!=0){
				$where = 'AND tb_lokasi_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT * FROM tb_pengadaan INNER JOIN tb_lokasi_lab ON tb_pengadaan.loklabid=tb_lokasi_lab.loklabid WHERE MONTH(tb_pengadaan.loklabwak)="'.$month.'" AND YEAR(tb_pengadaan.loklabwak)="'.$year.'" '.$where.' ';
			return $this->db->query($query)->num_rows();
			// return 1;
		}

		public function pemeliharaan_permonth($id,$idlab=0){
			$exp = explode('/',$id);
			$month = $exp[1];
			$year = $exp[0];
			if($idlab!=0){
				$where = 'AND tb_sarpras_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT * FROM tb_jadwal_pemeliharaan INNER JOIN tb_sarpras_lab ON tb_jadwal_pemeliharaan.sarid=tb_sarpras_lab.sarid WHERE MONTH(tb_jadwal_pemeliharaan.jadpemtglmul)<="'.$month.'" AND MONTH(tb_jadwal_pemeliharaan.jadpemtglsel)>="'.$month.'" AND YEAR(tb_jadwal_pemeliharaan.jadpemtglmul)<="'.$year.'" AND YEAR(tb_jadwal_pemeliharaan.jadpemtglsel)>="'.$year.'" '.$where.' ';
			return $this->db->query($query)->num_rows();
			// return 1;
		}

		public function prt_permonth($id,$idlab=0){
			$exp = explode('/',$id);
			$month = $exp[1];
			$year = $exp[0];
			if($idlab!=0){
				$where = 'AND tb_sarpras_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT * FROM tb_penggunaan_peralatan INNER JOIN tb_sarpras_lab ON tb_penggunaan_peralatan.sarid=tb_sarpras_lab.sarid WHERE MONTH(tb_penggunaan_peralatan.prttglmul)<="'.$month.'" AND MONTH(tb_penggunaan_peralatan.prttglsel)>="'.$month.'" AND YEAR(tb_penggunaan_peralatan.prttglmul)<="'.$year.'" AND YEAR(tb_penggunaan_peralatan.prttglsel)>="'.$year.'" '.$where.' ';
			return $this->db->query($query)->num_rows();
			// return 1;
		}

		public function rgn_permonth($id,$idlab=0){
			$exp = explode('/',$id);
			$month = $exp[1];
			$year = $exp[0];
			if($idlab!=0){
				$where = 'AND tb_sarpras_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT * FROM tb_penggunaan_ruangan INNER JOIN tb_sarpras_lab ON tb_penggunaan_ruangan.sarid=tb_sarpras_lab.sarid WHERE MONTH(tb_penggunaan_ruangan.rgntglmul)<="'.$month.'" AND MONTH(tb_penggunaan_ruangan.rgntglsel)>="'.$month.'" AND YEAR(tb_penggunaan_ruangan.rgntglmul)<="'.$year.'" AND YEAR(tb_penggunaan_ruangan.rgntglsel)>="'.$year.'" '.$where.' ';
			return $this->db->query($query)->num_rows();
			// return 1;
		}

		public function count_lay_penggunaan_rgn($date1,$date2,$idlab=0){
			$exp1 = explode('/',$date1);
			$month1 = $exp1[0];
			$year1 = $exp1[1];
			$exp2 = explode('/',$date2);
			$month2 = $exp2[0];
			$year2 = $exp2[1];
			if($idlab!=0){
				$where = 'AND d.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT COUNT(*) as jumlah,  c.daflaynama as nama from tb_penggunaan_ruangan a inner join tb_layanan_lab_eks b on a.lanjasid=b.lanjasidpermohonan inner join tb_layanan_lab c on b.daflayid=c.daflayid inner join m_lab d ON c.idlab=d.idlab WHERE MONTH(a.rgntglmul)>="'.$month1.'" AND MONTH(a.rgntglsel)<="'.$month2.'" AND YEAR(a.rgntglmul)>="'.$year1.'" AND YEAR(a.rgntglsel)<="'.$year2.'" '.$where.' group by c.daflaynama';
			return $this->db->query($query)->result_array();
		}

		public function count_lay_penggunaan_prt($date1,$date2,$idlab=0){
			$exp1 = explode('/',$date1);
			$month1 = $exp1[0];
			$year1 = $exp1[1];
			$exp2 = explode('/',$date2);
			$month2 = $exp2[0];
			$year2 = $exp2[1];
			if($idlab!=0){
				$where = 'AND d.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT COUNT(*) as jumlah,  c.daflaynama as nama from tb_penggunaan_peralatan a inner join tb_layanan_lab_eks b on a.lanjasid=b.lanjasidpermohonan inner join tb_layanan_lab c on b.daflayid=c.daflayid inner join m_lab d ON c.idlab=d.idlab WHERE MONTH(a.prttglmul)>="'.$month1.'" AND MONTH(a.prttglsel)<="'.$month2.'" AND YEAR(a.prttglmul)>="'.$year1.'" AND YEAR(a.prttglsel)<="'.$year2.'" '.$where.' group by c.daflaynama';
			return $this->db->query($query)->result_array();
		}

		public function count_penggunaan_lay($dt1,$dt2,$idlab=0){
			$peralatan = $this->count_lay_penggunaan_prt($dt1,$dt2,$idlab);
			$ruangan = $this->count_lay_penggunaan_rgn($dt1,$dt2,$idlab);

			$merge = array_merge($peralatan,$ruangan);
			$sumArray = array_reduce($merge, function ($a, $b) {
			    isset($a[$b['nama']]) ? $a[$b['nama']]['jumlah'] += $b['jumlah'] : $a[$b['nama']] = $b;  
			    return $a;
			});
			return $sumArray;
			print_r($sumArray);
		}

		public function count_pengadaan_sar($date1,$date2,$idlab=0){
			$exp1 = explode('/',$date1);
			$month1 = $exp1[0];
			$year1 = $exp1[1];
			$exp2 = explode('/',$date2);
			$month2 = $exp2[0];
			$year2 = $exp2[1];
			if($idlab!=0){
				$where = 'AND tb_lokasi_lab.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT tb_lokasi_lab.loklabid,tb_pengadaan.loklabbia AS total_biaya,tb_pengadaan.pengsarnama as namasingkat, tb_pengadaan.pengsarspes AS nama FROM tb_pengadaan INNER JOIN tb_lokasi_lab ON tb_pengadaan.loklabid=tb_lokasi_lab.loklabid  WHERE MONTH(tb_pengadaan.loklabwak)>="'.$month1.'" AND MONTH(tb_pengadaan.loklabwak)<="'.$month2.'" AND YEAR(tb_pengadaan.loklabwak)>="'.$year1.'" AND YEAR(tb_pengadaan.loklabwak)<="'.$year2.'" '.$where.' ORDER BY total_biaya DESC LIMIT 5';
			return $this->db->query($query)->result();
		}

		public function count_pemeliharaan_sar($date1,$date2,$idlab=0){
			$exp1 = explode('/',$date1);
			$month1 = $exp1[0];
			$year1 = $exp1[1];
			$exp2 = explode('/',$date2);
			$month2 = $exp2[0];
			$year2 = $exp2[1];
			if($idlab!=0){
				$where = 'AND b.idlab='.$idlab;	
			}else{
				$where = '';
			}
			$query = 'SELECT COUNT(*) as jumlah, a.sarid, b.sarnama as nama from tb_jadwal_pemeliharaan a inner join tb_sarpras_lab b on a.sarid=b.sarid WHERE MONTH(a.jadpemtglmul)>="'.$month1.'" AND MONTH(a.jadpemtglsel)<="'.$month2.'" AND YEAR(a.jadpemtglmul)>="'.$year1.'" AND YEAR(a.jadpemtglsel)<="'.$year2.'" '.$where.' GROUP BY a.sarid';
			return $this->db->query($query)->result_array();
		}
	}

?>
