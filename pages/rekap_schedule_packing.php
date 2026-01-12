<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
$today = date('Y-m-d');
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="refresh" content="180">
  <title>Rekap Schedule</title>
</head>
<?php
$data = mysqli_query($con, "SELECT
   	id,
	no_mesin,
	buyer,
	langganan,
	no_order,
	nokk,
  nodemand,
	jenis_kain,
	warna,
	no_warna,
	lot,
  proses_gerobak,
  ket_gerobak,
	sum(rol) as rol,
	sum(bruto) as bruto,
	proses,
	catatan,
	ket_status,
  total_gerobak,
	tgl_delivery,
  tgl_masuk,
  TIMESTAMPDIFF(HOUR, tgl_update, now()) as diff
FROM
	tbl_schedule_packing 
WHERE
	NOT `STATUS` = 'selesai' 
GROUP BY
	id
ORDER BY
	tgl_masuk ASC");
$no = 1;
$n = 1;
$c = 0;
?>
<body>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">

          <a href="" class="btn btn-success "><i class="fa fa-plus-circle"></i> Kembali</a>
          </div>

          <div class="box-body">
            <h3>Rekap Schedule Packing </h3>
             <table id="example1" class="table table-bordered table-hover table-striped" width="100%">
<thead class="bg-blue">
                <tr>
                  <th width="115">
                    <div align="center">No order</div>
                  </th>
                  <th width="24">
                    <div align="center">No.KK</div>
                  </th>
                  <th width="24">
                    <div align="center">No Demand</div>
                  </th>
                  <th width="24">
                    <div align="center">roll</div>
                  </th>
                  <th width="24">
                    <div align="center">bruto</div>
                  </th>
                  <th width="24">
                    <div align="center">Item</div>
                  </th>
                </tr>
              </thead>
                <tbody>
                <?php
                $col = 0;
                $no = 1;
                while ($rowd = mysqli_fetch_array($data)) {

                    $nodemand = trim($rowd['nodemand']);

                    $sql_db2 = "SELECT CODE, SUBCODE02, SUBCODE03, ORIGDLVSALORDLINESALORDERCODE
                                FROM PRODUCTIONDEMAND
                                WHERE CODE = ?";

                    $stmt = db2_prepare($conn1, $sql_db2);
                    if (!$stmt) {
                        die("DB2 prepare error: " . db2_conn_errormsg());
                    }

                    $ok = db2_execute($stmt, [$nodemand]);
                    if (!$ok) {
                        die("DB2 execute error: " . db2_stmt_errormsg($stmt));
                    }

                    $row_item = db2_fetch_assoc($stmt);

                    $item = $row_item ? (($row_item['SUBCODE02'] ?? '').($row_item['SUBCODE03'] ?? '')) : '-';
                    ?>
                    <tr>
                        <td align="center"><?= $rowd['no_order']; ?></td>
                        <td><?= $rowd['nokk']; ?></td>
                        <td><?= $rowd['nodemand']; ?></td>
                        <td align="center"><?= $rowd['rol']; ?></td>
                        <td align="center"><?= $rowd['bruto']; ?></td>
                        <td align="center"><?= $item; ?></td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</body>

</html>
