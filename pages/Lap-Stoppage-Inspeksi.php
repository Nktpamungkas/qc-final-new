<?PHP
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Harian Stoppage Mesin</title>

</head>
<body>
<?php
$Awal	= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	= isset($_POST['akhir']) ? $_POST['akhir'] : '';
$Dept	= isset($_POST['dept']) ? $_POST['dept'] : '';	
	
function formatJamMenit($decimalHours) {
    if ($decimalHours == 0) {
        return "0 Jam 0 Menit";
    }

    $jam = floor($decimalHours); // Ambil bagian jam bulat
    $menit = round(($decimalHours - $jam) * 60); // Ambil bagian menit dari sisa jam

    return $jam . " Jam " . $menit . " Menit";
}
	
function formatJamMenit1($decimalMinutes) {
    if ($decimalMinutes == 0) {
        return "0 Jam 0 Menit";
    }

    $jam = floor($decimalMinutes / 60); // Ambil bagian jam
    $menit = round($decimalMinutes % 60); // Ambil sisa menit

    return $jam . " Jam " . $menit . " Menit";
}	
?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"> Filter Laporan Stoppage Mesin</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
    <div class="box-body">
      <div class="form-group">
        <div class="col-sm-3">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off"/>
          </div>
        </div>
        <!-- /.input group -->
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="akhir" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" autocomplete="off"/>
          </div>
        </div>
        <!-- /.input group -->
      </div>
	  
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-2">
        <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="save" style="width: 60%">Search <i class="fa fa-search"></i></button>
      </div>
    </div>
    <!-- /.box-footer -->
  </form>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data Stoppage Mesin</h3><br>
        <?php if($_POST['awal']!="") { ?><b>Periode: <?php echo $_POST['awal']." to ".$_POST['akhir']; ?></b>
		<?php } ?>
      <div class="box-body">
      <table class="table table-bordered table-hover table-striped nowrap" id="example3" style="width:100%">
        <thead class="bg-blue">
          <tr>
            <th><div align="center">No</div></th>
            <th><div align="center">Demand</div></th>
            <th><div align="center">Awal Stop</div></th>
            <th><div align="center">Akhir Stop</div></th>
            <th><div align="center">Durasi</div></th>            
            <th><div align="center">Kode Stop</div></th>
            <th><div align="center">Mesin</div></th>
			</tr>
        </thead>
        <tbody>
          <?php
	        $no=1;
			
			if($Awal!=""){ $Where =" DATE_FORMAT( ts.tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; }
			else { $Where =" DATE_FORMAT( ts.tgl_update, '%Y-%m-%d' ) BETWEEN ' ' AND ' ' "; }		
			
			$qry1=mysqli_query($con,"SELECT
										ts.nodemand,
										ts.no_mesin,
										ts.tgl_mulai,
										ts.tgl_stop,
										ts.kode_stop,

										-- Ambil tgl_stop mesin sebelumnya berdasarkan no_mesin
										LAG(ts.tgl_stop) OVER (
											PARTITION BY ts.no_mesin 
											ORDER BY ts.tgl_mulai
										) AS prev_stop,

										-- Hitung selisih menit antara stop sebelumnya dan mulai sekarang
										TIMESTAMPDIFF(
											MINUTE,
											LAG(ts.tgl_stop) OVER (
												PARTITION BY ts.no_mesin 
												ORDER BY ts.tgl_mulai
											),
											ts.tgl_mulai
										) AS lama_stop_menit,

										-- Format jam dan menit
										CONCAT(
											FLOOR(TIMESTAMPDIFF(
												MINUTE,
												LAG(ts.tgl_stop) OVER (
													PARTITION BY ts.no_mesin 
													ORDER BY ts.tgl_mulai
												),
												ts.tgl_mulai
											) / 60), ' Jam ',
											MOD(TIMESTAMPDIFF(
												MINUTE,
												LAG(ts.tgl_stop) OVER (
													PARTITION BY ts.no_mesin 
													ORDER BY ts.tgl_mulai
												),
												ts.tgl_mulai
											), 60), ' Menit'
										) AS lama_stop,

										ts.tgl_update

									FROM
										db_qc.tbl_schedule AS ts

									WHERE
										$Where
										AND ts.kode_stop <> ''

									ORDER BY
										ts.no_mesin, ts.tgl_mulai;");
			while($row1=mysqli_fetch_array($qry1)){				
		 ?>
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo $no; ?></td>
            <td align="center"><?php echo $row1['nodemand'];?></td>
            <td align="center"><?php echo $row1['prev_stop'];?></td>
            <td align="center"><?php echo $row1['tgl_stop'];?></td>
            <td align="center"><?php echo $row1['lama_stop'];?></td>            
            <td align="center"><?php echo $row1['kode_stop'];?></td>
			<td align="center"><?php echo $row1['no_mesin'];?></td>  
			</tr>
          <?php	$no++;  } ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="modal_del" tabindex="-1" >
  <div class="modal-dialog modal-sm" >
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Are you sure to delete all data ?</h4>
      </div>

      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	
<script type="text/javascript">
    function confirm_delete(delete_url)
    {
      $('#modal_del').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>	
<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

	</script>
</body>
</html>