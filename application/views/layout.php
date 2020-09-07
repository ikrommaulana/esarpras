<!DOCTYPE html>

<html lang="en">
	<head>
		  <title><?=isset($title)?$title:'E-Sarpras Admin' ?></title>
		  <!-- Tell the browser to be responsive to screen width -->
		  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		  <meta name = "keywords" content = "E-Sarpras" />
      	  <meta name = "description" content = "E-Sarpras" />
      	  <meta name = "author" content = "Ikrom Maulana" />
		  <!-- Bootstrap 3.3.6 -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/bootstrap/css/bootstrap.min.css">
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		  <!-- Theme style -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/AdminLTE.min.css">
		  <!-- Datatable style -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">
		  <!-- Custom CSS -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/style.css">
		  <!-- AdminLTE Skins. Choose a skin from the css/skins -->

		  <!-- daterange picker -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.css">
		  <!-- bootstrap datepicker -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/datepicker/datepicker3.css">
		  <!-- iCheck for checkboxes and radio inputs -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/iCheck/all.css">
		  <!-- Bootstrap Color Picker -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/colorpicker/bootstrap-colorpicker.min.css">
		  <!-- Bootstrap time Picker -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/timepicker/bootstrap-timepicker.min.css">
		  <!-- Select2 -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/select2/select2.min.css">
		
		  <!--folder instead of downloading all of them to reduce the load. -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/skins/skin-green.min.css">
		  <!-- iCheck for checkboxes and radio inputs -->
		  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/iCheck/all.css">
		  <!-- jQuery 2.2.3 -->
		  <script src="<?= base_url() ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
          <!-- PDF JS -->
          <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
	</head>

	<body class="hold-transition skin-green sidebar-mini">
		<div class="wrapper" style="height: auto;">
			<?php if($this->session->flashdata('msg') != ''): ?>
			    <div class="alert alert-success flash-msg alert-dismissible">
			      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			      <h4>Success!</h4>
			      <?= $this->session->flashdata('msg'); ?> 
			    </div>
			<?php endif; ?>
			<?php if($this->session->flashdata('alert') != ''): ?>
			    <div class="alert alert-info flash-msg alert-dismissible">
			      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			      <h4>Alert!</h4>
			      <?= $this->session->flashdata('alert'); ?> 
			    </div>
			<?php endif; ?>
			<section id="container">
				<!--header start-->
				<header class="header white-bg">
					<?php include('include/navbar.php'); ?>
				</header>
				<!--header end-->
				<!--sidebar start-->
				<aside>
					<?php if($this->session->userdata('is_admin_login')): ?>
						<?php include('include/admin_sidebar.php'); ?>
					<?php else: ?>
						<?php include('include/sidebar.php'); ?>
					<?php endif; ?>
				</aside>
				<!--sidebar end-->
				<!--main content start-->
				<section id="main-content">
					<div class="content-wrapper" style="min-height: 394px; padding:15px;">
						<!-- page start-->
						<?php $this->load->view($view);?>
						<!-- page end-->
					</div>
				</section>
				<!--main content end-->
				<!--footer start-->
				<footer class="main-footer">
					<strong>Copyright © 2018 All rights
					reserved.
				</footer>
				<!--footer end-->
			</section>
			<!-- /.control-sidebar -->
			<?php include('include/control_sidebar.php'); ?>
		</div>

	<!-- jQuery UI 1.11.4 -->
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?= base_url() ?>public/bootstrap/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url() ?>public/dist/js/app.min.js"></script>
	
	<!-- Select2 -->
	<script src="<?= base_url() ?>public/plugins/select2/select2.full.min.js"></script>
	<!-- InputMask -->
	<script src="<?= base_url() ?>public/plugins/input-mask/jquery.inputmask.js"></script>
	<script src="<?= base_url() ?>public/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="<?= base_url() ?>public/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap datepicker -->
	<script src="<?= base_url() ?>public/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- bootstrap color picker -->
	<script src="<?= base_url() ?>public/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
	<!-- bootstrap time picker -->
	<script src="<?= base_url() ?>public/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="<?= base_url() ?>public/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="<?= base_url() ?>public/plugins/iCheck/icheck.min.js"></script>
	<script type="text/javascript">
			$('.hr_datepicker').datepicker({ dateFormat: 'YY-mm-dd'});
	</script>
	<!-- Notify JS -->
	<script src="<?= base_url() ?>public/plugins/notify/notify.min.js"></script>
	<script type="text/javascript">
	  $(".flash-msg").fadeTo(2000, 500).slideUp(500, function(){
	    $(".flash-msg").slideUp(500);
	});
	</script>
	<script type="text/javascript">
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});

		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

	$('.datepicker').datepicker({
	    autoclose: true,
	    format: 'mm/dd/yyyy'
	}); 

	$('.datefrom').datepicker({
	    autoclose: true,
	    startView: 'months',
  		minViewMode: 'months',
	    format: 'yyyy-mm'
	}).on('changeDate', function(selected){
	        startDate = new Date(selected.date.valueOf());
	        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
	        $('.dateto').datepicker('setStartDate', startDate);
	    }); 

	$('.dateto').datepicker({
	    autoclose: true,
	    startView: 'months',
  		minViewMode: 'months',
	    format: 'yyyy-mm'
	}).on('changeDate', function(selected){
	        FromEndDate = new Date(selected.date.valueOf());
	        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
	        $('.datefrom').datepicker('setEndDate', FromEndDate);
	    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
	</body>

</html>