<html>
<head>
	<style>


		td.bd_color{width:310px; background-color:#F64747;}
		td.sd_color{ width:310px; background-color:#00FAFF;}
		table{font-size:8pt;font-family:Georgia;}

		th.title{line-height:2px;font-weight:bold;border-bottom:black solid 1pt; }

		table#wrap td.first{}
		table#wrap td.value{}

		table#s td.first{width:110px;border-left: black solid 1pt;line-height:2px;}
		table#s td.value{font-family:courier;width:60px;border-left: black solid 1pt;text-align:right;}
		table#title{font-size: 10pt;font-family:Courier;line-height: 3px;width:80%;}
		

		table th.headSummary{background-color: #47bb8e;}

		table#head{line-height:2px;font-family:calibri;}
		table#head td{}
		table#head td.first{font-weight:bold;border-top: black solid 1pt;text-align:left;width:45px;}
		table#head th.first{font-weight:bold;border-top: black solid 1pt;border-bottom: black solid 1pt;text-align:left;text-align:center;}
		table#head td.align-center{text-align:center;}
		table#head td.align-left{text-align:left;}
		table#head td.align-right{text-align:right;}

		table#head td.value{font-family:courier;text-align:center;border-right: black solid 1pt;width:55px;}
		table#head th{font-weight:bold;font-size:10pt;text-align:center;}
		span.jalan{font-size:8pt;font-weight:bold;}

		td.info{border-left: black solid 1pt;border-right: black solid 1pt;}

		table#s1 td.first{width:60pt;text-align:right;}
		table#s2 td.first{width:175pt;text-align:right;}

		table#footer td.val{font-family:courier}
		.bl{border-left:1pt solid #000;}
		.br{border-right:1pt solid #000;}
		.bt{border-top:1pt solid #000;}
		.bb{border-bottom:1pt solid #000;}

		.align-center{
		text-align:center;
		}
		.align-right{
		text-align:right;
		}
		.align-left{
		text-align:left;
		}
	</style>
</head>
<body>

	<?php $tanggal = date("d/m/Y");
			$header_stat="Content-Disposition: attachment; filename=Data-Pemeliharaan.xls";
			header("Content-type: application/octet-stream");
			header($header_stat);
			header("Pragma: no-cache");
			header("Expires: 0");
	?>
	<div class="align-right">Date : <?php echo date('l\, jS F Y'); ?></div>
	<div>
		<div class="align-center">
		



		<h3>DATA PEMELIHARAAN</h3>
		</div>
		<table border="1">
         <thead>
        <tr>
          <th style=" white-space:nowrap;">No</th>
          <th style=" white-space:nowrap;">Pemohon</th>
          <th style=" white-space:nowrap;">Unit Kerja</th>
          <th style=" white-space:nowrap;">Tipe Item</th>
          <th style=" white-space:nowrap;">Nama Item</th>
          <th style=" white-space:nowrap;">Fungsi Item</th>
          <th style=" white-space:nowrap;">Jumlah</th>
          <th style=" white-space:nowrap;">Tujuan</th>
          <th style=" white-space:nowrap;">Lokasi</th>
          <th style=" white-space:nowrap;">Waktu</th>
          <th style=" white-space:nowrap;">Perkiraan Biaya</th>
          <th style=" white-space:nowrap;">Mitra</th>
          <th style=" white-space:nowrap;">Respon L1</th>
          <th style=" white-space:nowrap;">Note L1</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($pemeliharaan as $row): 
          $lokasi = $row['nama_jalan'].' '.$row['kecamatan'].' '.$row['kabupaten'].' '.$row['provinsi'];
            if($row['respon']=='Y') {
              $respon = "<span class='label label-success' data-toggle='tooltip' data-placement='top' title='".$row['note']."'>Approved</span>";
            } else if($row['respon']=='N') {
              $respon = "<span class='label label-danger' data-toggle='tooltip' data-placement='top' title='".$row['note']."'>Revised</span>";
            } else {
              $respon = "<span class='label label-warning'>Processs</span>";
            }
            ?>
          <tr>
            <td style=" white-space:nowrap;"><?= ++$i; ?></td>
            <td style=" white-space:nowrap;"><?= $row['nama_pegawai']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['nama_unitkerja']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['type']; ?></td>
            <td style=" white-space:nowrap;" ><?= $row['nama_sarpras']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['fungsi']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['jumlah']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['tujuan']; ?></td>
            <td style=" white-space:nowrap;"><?= $lokasi; ?></td>
            <td style=" white-space:nowrap;"><?= $row['waktu']; ?></td>
            <td style=" white-space:nowrap;">Rp. <?= number_format($row['biaya'], 0, '', '.'); ?></td>
            <td style=" white-space:nowrap;"><?= $row['nama_mitra']; ?></td>
            <td style=" white-space:nowrap;"><?= $respon; ?></td>
            <td style=" white-space:nowrap;"><?= $row['note']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
		<br/>
	</div>
	


</body>