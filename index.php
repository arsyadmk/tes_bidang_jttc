<?php
ob_start();

session_start();
$GLOBALS['koneksi'] = new mysqli("localhost","root","","tes_bidang");
date_default_timezone_set("Asia/Jakarta"); 
function enkripsiDekripsi( $string, $action ) {
	// you may change these values to your own
	$secret_key = '15saf fsFed5&sda6v Pkfasbdu tesbi';
	$secret_iv = '1597864002563154';

	$output = false;
	$encrypt_method = 'AES-256-CBC';
	$key = hash( 'sha256', $secret_key );
	$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	if( $action == 'enkripsi' ) {
		$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	}
	else if( $action == 'dekripsi' ){
		$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	}
	return $output;
}function tanggal_indo($tanggal_sblm){
	$tanggal = date("Y-m-j", strtotime($tanggal_sblm));

	$bulan = array (1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

function tanggal_jam_indo($tanggal_sblm){
	$tanggal = date("Y-m-j", strtotime($tanggal_sblm));

	$bulan = array (1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0] . '<br>' . date("G:i:s", strtotime($tanggal_sblm));
}

function tanggal_jam_indo_nobr($tanggal_sblm){
	$tanggal = date("Y-m-j", strtotime($tanggal_sblm));

	$bulan = array (1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0] . ' - ' . date("G:i:s", strtotime($tanggal_sblm));
}

function tanggal_order($tanggal_sblm){
	return date("YmdHis", strtotime($tanggal_sblm));
}

function jam_indo($tanggal_sblm){
	return date("G:i", strtotime($tanggal_sblm));
}

$hari_indo = array ( 1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');

$id_admin_temp_fix = "";
$nama_admin_temp_fix = "";

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tes Bidang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"> -->
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- character counter -->
  <script src="plugins/character-counter/jQuery.maxlength.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- input filter -->
  <script type="text/javascript">
    function setInputFilter(textbox, inputFilter) {
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          }
        });
      });
    }
  </script>
  <!-- Ion Slider -->
  <link rel="stylesheet" href="plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <script src="plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="admin.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">Tes Bidang</span>
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li></li>

            <li class="nav-header">OLAH DATA</li>
            <li class="nav-item has-treeview" id="pegawaiH">
              <a href="#" class="nav-link" id="pegawai">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Pegawai
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?page=pegawai&action=tambah" class="nav-link" id="pegawaitambah">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?page=pegawai&action=kelola" class="nav-link" id="pegawaikelola">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kelola</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview" id="jabatanH">
              <a href="#" class="nav-link" id="jabatan">
                <i class="nav-icon fas fa-tag"></i>
                <p>
                  Jabatan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?page=jabatan&action=tambah" class="nav-link" id="jabatantambah">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?page=jabatan&action=kelola" class="nav-link" id="jabatankelola">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kelola</p>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="nav-item has-treeview" id="kontrakH">
              <a href="#" class="nav-link" id="kontrak">
                <i class="nav-icon fas fa-tag"></i>
                <p>
                  Kontrak
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?page=kontrak&action=tambah" class="nav-link" id="kontraktambah">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?page=kontrak&action=kelola" class="nav-link" id="kontrakkelola">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kelola</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <?php
      $page   = @$_GET['page'];
      $action = @$_GET['action'];
      if ($page == "dashboard") {
        if ($action == "") {
        }
      } elseif ($page == "pegawai") {
        if ($action == "kelola") {
          include "view/pegawai_kelola.php";
        } elseif ($action == "tambah") {
          include "view/pegawai_set.php";
        } elseif ($action == "edit") {
          include "view/pegawai_set.php";
        }
      } elseif ($page == "jabatan") {
        if ($action == "kelola") {
          include "view/jabatan_kelola.php";
        } elseif ($action == "tambah") {
          include "view/jabatan_set.php";
        } elseif ($action == "edit") {
          include "view/jabatan_set.php";
        }
      } elseif ($page == "kontrak") {
        if ($action == "kelola") {
          include "view/kontrak_kelola.php";
        } elseif ($action == "tambah") {
          include "view/kontrak_set.php";
        } elseif ($action == "edit") {
          include "view/kontrak_set.php";
        }
      } else {
        // include "view/dev.php";
      }
      
      if(!empty($page)){
        ?>
        <script type="text/javascript">
          if(document.getElementById('<?=$page?>H') !== null){
            document.getElementById('<?=$page?>H').classList.add('menu-open');
            document.getElementById('<?=$page?>H').scrollIntoView();
          }
          if(document.getElementById('<?=$page?>') !== null){
            document.getElementById('<?=$page?>').classList.add('active');
            document.getElementById('<?=$page?>').scrollIntoView();
          }
        </script>
        <?php
        if(!empty($action)){
          ?>
          <script type="text/javascript">
            if(document.getElementById('<?=$page.$action?>') !== null){
              document.getElementById('<?=$page.$action?>').classList.add('active');
            }
          </script>
          <?php
        }
      }
      ?>
    </div>


    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
      </div>
    </footer>


    <aside class="control-sidebar control-sidebar-dark">

    </aside>

  </div>


  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script> -->
  <!-- <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript">
    $('.datePicker').daterangepicker({
      locale: {
        format: 'DD/MM/YYYY',
        // separator: " - ",
        applyLabel: "Pilih",
        cancelLabel: "Batal",
        fromLabel: "Dari",
        toLabel: "Sampai",
        customRangeLabel: "Custom",
        daysOfWeek: [
        "Min",
        "Sen",
        "Sel",
        "Rab",
        "Kam",
        "Jum",
        "Sab"
        ],
        "monthNames": [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
        ],
        "firstDay": 1
      },
    })
  </script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="dist/js/pages/dashboard.js"></script> -->
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script>
    $(function () {
      $('#example').DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "pagingType": "full_numbers",
        "iDisplayLength": 10,
        "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Semua"] ],
        "oLanguage": { 
          "sEmptyTable": "Tidak ada data yang tersedia",
          "sSearch": "Cari:",
          "sZeroRecords": "Tidak ada data yang cocok dengan pencarian",
          "sLengthMenu": "Tampilkan per _MENU_ data",
        },
        "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
          return "Menampilkan data " + iStart + " sampai " + iEnd + " dari <strong>" + iTotal + "</strong> total data ";
        },
        "language": {
          "paginate": {
            "previous": "<",
            "next": ">",
            "first": "<<",
            "last": ">>",
          }
        },
      });
    });
  </script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <script type="text/javascript">
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()
  </script>
  <!-- tooltips -->
  <script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    })
  </script>

  <!-- Mask -->
  <!-- <script src="plugins/inputmask/jquery.inputmask.min.js"></script> -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
  </script>

  <!-- character counter -->
  <script type="text/javascript">
    $('div.cc').maxlength();
  </script>

</body>
</html>
