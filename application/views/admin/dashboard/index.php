<style type="text/css">
  .datepicker{
    padding:6px 12px;
  }
</style>
<!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="background-color:#044476;"><img src="<?=base_url('public').'/dist/img/lab.png';?>" style="filter:brightness(0) invert(1);width:50%"></span>

            <div class="info-box-content">
              <span class="info-box-text"><?=$total1;?></span>
              <span class="info-box-number"><?= $total_total1; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="background-color:#e8641b;"><img src="<?=base_url('public').'/dist/img/sarpras.png';?>" style="filter:brightness(0) invert(1);width:50%"></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Sarpras</span>
              <span class="info-box-number"><?= $total_sarpras; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="background-color:#006a25;"><img src="<?=base_url('public').'/dist/img/pengadaan.png';?>" style="filter:brightness(0) invert(1);width:50%"></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Pengadaan</span>
              <span class="info-box-number"><?= number_format($total_pengadaan,0,',','.'); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Periode Dashboard</h3>


              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                  <?= form_open(base_url('admin/dashboard/index'), 'class="form-horizontal"');  ?>
                  <!--form action="<?=base_url('admin/dashboard/index');?>" class="form-horizontal" method="get"-->
                  <div class="form-group col-md-3">
                    &nbsp;
                  </div>
                  <div class="form-group col-md-3">
                    <label for="DashDari" class="col-sm-3 control-label">Dari</label>
                    <div class="col-sm-9"> 
                      <input type="text" name="dari" class="form-control datefrom" id="" value="<?=$datefrom;?>">
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="DashSampai" class="col-sm-3 control-label">Sampai</label>
                    <div class="col-sm-9">
                      <input type="text" name="sampai" class="form-control dateto" id="" value="<?=$dateuntil;?>">
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <div class="col-sm-12">
                      <input type="submit" name="submit" class="btn btn-default" value="Cari">
                    </div>
                  </div>
                  <!--/form-->
                  <?= form_close(); ?>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border" style="margin-bottom:0px;">
              <h3 class="box-title">Dashboard Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong>Periode Dashboard: <?=date('F Y',strtotime($datefrom));?> - <?=date('F Y',strtotime($dateuntil));?></strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="dashboardChart" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="box-header with-border" style="margin-bottom:0px;">
              <h3 class="box-title">Top Penggunaan</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart">
                    <!-- Doughnut Chart Canvas -->
                    <canvas id="topPenggunaan" style="height: 180px;"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="box-header with-border" style="margin-bottom:0px;">
              <h3 class="box-title">Top Pemeliharaan</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart">
                    <!-- Doughnut Chart Canvas -->
                    <canvas id="topPemeliharaan" style="height: 180px;"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="box-header with-border" style="margin-bottom:0px;">
              <h3 class="box-title">Top Pengadaan</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart">
                    <ol style="font-size:1.1em;font-weight:bold">
                    <?php
                      foreach ($top_pengadaan as $pgd){
                        echo '<li><span title="'.$pgd->nama.'">'.$pgd->namasingkat.' : '.number_format($pgd->total_biaya,0,',','.').'</span></li>';
                      }
                    ?>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- /.row -->
    </section>
    <!-- /.content -->

<!-- Sparkline -->
<script src="<?= base_url() ?>public/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url() ?>public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url() ?>public/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>public/dist/js/demo.js"></script>


<script>
  $("#dashboard1").addClass('active');
</script>
<?php
//harian
// $dates = array();
// $start = $current = strtotime($datefrom);
// $end = strtotime($dateuntil);

// while ($current <= $end) {
//     $dates[] = date('Y/m/d', $current);
//     $current = strtotime('+1 days', $current);
// }

//bulanan
$dates = array();
$start    = new DateTime($datefrom);
$start->modify('first day of this month');
$end      = new DateTime($dateuntil);
$end->modify('first day of next month');
$interval = DateInterval::createFromDateString('1 month');
$period   = new DatePeriod($start, $interval, $end);

foreach ($period as $dt) {
    $dates[] = $dt->format("Y/m");
    // echo $dt->format("Y-m") . "<br>\n";
}

$idlab = (isset($idlab))? $idlab : set_value('pegnip');
$this->load->model('dashboard_model');
$rangedate = ''; $value_pengadaan = ''; $value_pemeliharaan = ''; $value_penggunaan_rgn = ''; $value_penggunaan_prt = '';
$rangedate .= '['; $value_pengadaan .= '['; $value_pemeliharaan .= '['; $value_penggunaan_rgn .= '['; $value_penggunaan_prt .= '[';
foreach($dates as $dt){
  $v1 = $this->dashboard_model->pengadaan_permonth($dt,$idlab);
  $v2 = $this->dashboard_model->pemeliharaan_permonth($dt,$idlab);
  $v3 = $this->dashboard_model->rgn_permonth($dt,$idlab);
  $v4 = $this->dashboard_model->prt_permonth($dt,$idlab);
  $rangedate .= '"'.$dt.'",';
  $value_pengadaan .= '"'.$v1.'",';
  $value_pemeliharaan .= '"'.$v2.'",';
  $value_penggunaan_rgn .= '"'.$v3.'",';
  $value_penggunaan_prt .= '"'.$v4.'",';
}
$rangedate .=']'; $value_pengadaan .=']'; $value_pemeliharaan .=']'; $value_penggunaan_rgn .=']'; $value_penggunaan_prt .=']';

// echo '<pre>';
// print_r($top_penggunaan);
// echo '</pre>';
$tpgnlabel = ''; $tpgndata = ''; $tpgncolor = '';
$tpgnlabel .= '['; $tpgndata .= '['; $tpgncolor .= '[';
if($top_penggunaan){
  foreach($top_penggunaan as $pgn){
  $color = (isset($pgn['color']))? $pgn['color'] : '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
  $tpgnlabel .= '"'.$pgn['nama'].'",';
  $tpgndata .= '"'.$pgn['jumlah'].'",';
  $tpgncolor .= '"'.$color.'",';
  }
}
$tpgnlabel .= ']'; $tpgndata .= ']'; $tpgncolor .= ']';

$tpmhlabel = ''; $tpmhdata = ''; $tpmhcolor = '';
$tpmhlabel .= '['; $tpmhdata .= '['; $tpmhcolor .= '[';
if($top_penggunaan){
  foreach($top_pemeliharaan as $pmh){
  $color = (isset($pmh['color']))? $pmh['color'] : '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
  $tpmhlabel .= '"'.$pmh['nama'].'",';
  $tpmhdata .= '"'.$pmh['jumlah'].'",';
  $tpmhcolor .= '"'.$color.'",';
  }
}
$tpmhlabel .= ']'; $tpmhdata .= ']'; $tpmhcolor .= ']';
      


?>

<script>
  var ctx = document.getElementById('dashboardChart').getContext('2d');
  var dashchart = new Chart(ctx, {
      // The type of chart we want to create
      type: 'line',
      // The data for our dataset
      data: {
          labels: <?php echo $rangedate;?>,
          datasets: [
                {
                  label: "Pemeliharaan",
                  backgroundColor: "rgb(11, 179, 56)",
                  borderColor: "rgb(11, 179, 56)",
                  fill: false,
                  data: <?php echo $value_pemeliharaan;?>
                },
                {
                  label: "Pengadaan",
                  backgroundColor: "rgba(60,141,188,0.9)",
                  borderColor: "rgba(60,141,188,0.9)",
                  fill: false,
                  data: <?php echo $value_pengadaan;?>
                },
                {
                  label: "Penggunaan Ruangan",
                  backgroundColor: "rgb(236, 146, 48)",
                  borderColor: "rgb(236, 146, 48)",
                  fill: false,
                  data: <?php echo $value_penggunaan_rgn;?>
                },
                {
                  label: "Penggunaan Peralatan",
                  backgroundColor: "rgb(146, 74, 56)",
                  borderColor: "rgb(146, 74, 56)",
                  fill: false,
                  data: <?php echo $value_penggunaan_prt;?>
                }
              ]
      },

      // Configuration options go here
      options: {
        legend: {
            display: true,
            position: 'bottom'
        }
    }
  });
</script>

<script>
 new Chart(document.getElementById("topPenggunaan"), {
    type: 'pie',
    data: {
      labels: <?php echo $tpgnlabel;?>,
      datasets: [{
        label: "Top Penggunaan",
        backgroundColor: <?php echo $tpgncolor;?>,
        data: <?php echo $tpgndata;?>,
      }]
    },
    options: {
        legend: {
            display: true,
            position: 'right'
        }
    }
});
</script>


<script>
 new Chart(document.getElementById("topPemeliharaan"), {
    type: 'pie',
    data: {
      labels: <?php echo $tpmhlabel;?>,
      datasets: [{
        label: "Top Penggunaan",
        backgroundColor: <?php echo $tpmhcolor;?>,
        data: <?php echo $tpmhdata;?>,
      }]
    },
    options: {
        legend: {
            display: true,
            position: 'right'
        }
      }
});
</script>