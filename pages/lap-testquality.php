<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";

?>

<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Laporan Test Quality</title>

</head>

<body>
	<?php
	$Awal = isset($_POST['awal']) ? $_POST['awal'] : '';
	$Akhir = isset($_POST['akhir']) ? $_POST['akhir'] : '';
	$Dept = isset($_POST['dept']) ? $_POST['dept'] : '';
	$Shift = isset($_POST['shift']) ? $_POST['shift'] : '';
	$GShift = isset($_POST['gshift']) ? $_POST['gshift'] : '';
	$Proses = isset($_POST['proses']) ? $_POST['proses'] : '';
	$jamA = isset($_POST['jam_awal']) ? $_POST['jam_awal'] : '';
	$jamAr = isset($_POST['jam_akhir']) ? $_POST['jam_akhir'] : '';
	$Buyer = isset($_POST['buyer']) ? $_POST['buyer'] : '';
	$Item = isset($_POST['no_item']) ? $_POST['no_item'] : '';
	if (strlen($jamA) == 5) {
		$start_date = $Awal . ' ' . $jamA;
	} else {
		$start_date = $Awal . ' 0' . $jamA;
	}
	if (strlen($jamAr) == 5) {
		$stop_date = $Akhir . ' ' . $jamAr;
	} else {
		$stop_date = $Akhir . ' 0' . $jamAr;
	}
	?>
	<div class="row">
		<div class="col-xs-4">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"> Filter Tanggal Test Quality</h3>

				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
					<div class="box-body">
						<div class="form-group">
							<div class="col-sm-5">
								<div class="input-group date">
									<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
									<input name="awal" type="text" class="form-control pull-right" id="datepicker"
										placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="input-group">
									<input type="text" class="form-control timepicker" name="jam_awal"
										placeholder="00:00" value="<?php echo $jamA; ?>" autocomplete="off">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
								</div>
								<div>
								</div>
							</div>
							<!-- /.input group -->
						</div>

						<div class="form-group">
							<div class="col-sm-5">
								<div class="input-group date">
									<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
									<input name="akhir" type="text" class="form-control pull-right" id="datepicker1"
										placeholder="Tanggal Akhir" value="<?php echo $Akhir; ?>" autocomplete="off" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="input-group">
									<input type="text" class="form-control timepicker" name="jam_akhir"
										placeholder="00:00" value="<?php echo $jamAr; ?>" autocomplete="off">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<select class="form-control select2" name="shift" id="shift">
									<option value="">Pilih</option>
									<option value="ALL" <?php if ($Shift == "ALL") {
										echo "SELECTED";
									} ?>>ALL</option>
									<option value="1" <?php if ($Shift == "1") {
										echo "SELECTED";
									} ?>>1</option>
									<option value="2" <?php if ($Shift == "2") {
										echo "SELECTED";
									} ?>>2</option>
									<option value="3" <?php if ($Shift == "3") {
										echo "SELECTED";
									} ?>>3</option>
									<option value="NON" <?php if ($Shift == "NON") {
										echo "SELECTED";
									} ?>>
										Non-Shift</option>
								</select>
							</div>
							<div class="col-sm-3">
								<select class="form-control select2" name="gshift" id="gshift">
									<option value="">Pilih</option>
									<option value="ALL" <?php if ($GShift == "ALL") {
										echo "SELECTED";
									} ?>>ALL</option>
									<option value="A" <?php if ($GShift == "A") {
										echo "SELECTED";
									} ?>>A</option>
									<option value="B" <?php if ($GShift == "B") {
										echo "SELECTED";
									} ?>>B</option>
									<option value="C" <?php if ($GShift == "C") {
										echo "SELECTED";
									} ?>>C</option>
									<option value="NON" <?php if ($GShift == "NON") {
										echo "SELECTED";
									} ?>>
										Non-Shift</option>
								</select>
							</div>
						</div>
						<!-- <div class="form-group">
							<div class="col-sm-6">
								<select name="buyer" class="form-control select2" id="buyer" style="width: 100%">
									<option value="">Pilih</option>
									<?php
									$sqlBuyer = mysqli_query($con, "SELECT buyer FROM tbl_schedule  GROUP BY buyer");
									while ($rBy = mysqli_fetch_array($sqlBuyer)) {
										?>
										<option value="<?php echo $rBy['buyer']; ?>" <?php if ($Buyer == $rBy['buyer']) {
											   echo "SELECTED";
										   } ?>>
											<?php echo $rBy['buyer']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div> -->
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<div class="col-sm-2">
							<button type="submit" class="btn btn-social btn-linkedin btn-sm" name="save">Search <i
									class="fa fa-search"></i></button>
						</div>
					</div>
					<!-- /.box-footer -->
				</form>
			</div>
		</div>
		<div class="col-xs-8">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"> Rangkuman Test Quality</h3>
					<?php if ($Awal != "") { ?>
						<!-- <div class="pull-right">
							<a href="pages/cetak/excel-rangkuman-inspeksi.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&dept=<?php echo $_POST['dept']; ?>&shift=<?php echo $_POST['shift']; ?>&gshift=<?php echo $_POST['gshift']; ?>&proses=<?php echo $_POST['proses']; ?>&buyer=<?php echo $_POST['buyer']; ?>&jam_awal=<?php echo $_POST['jam_awal']; ?>&jam_akhir=<?php echo $_POST['jam_akhir']; ?>"
								class="btn btn-primary <?php if ($_POST['awal'] == "") {
									echo "disabled";
								} ?>" target="_blank">Rangkuman Excel</a>
						</div> -->
					<?php } ?>
				</div>
				<div class="box-body">
					<?php 
					function buildQCWhere(&$params, $start_date, $stop_date, $Shift, $GShift, $Proses)
							{
								$where = [];

								$where[] = "t.tgl_masuk BETWEEN ? AND ?";
								$params[] = $start_date;
								$params[] = $stop_date;

								if ($Shift !== "ALL" && $Shift !== "") {
									$where[] = "t.shift = ?";
									$params[] = $Shift;
								}

								if ($GShift !== "ALL" && $GShift !== "") {
									$where[] = "t.gshift = ?";
									$params[] = $GShift;
								}

								if (!empty($Proses)) {
									$where[] = "t.development = ?";
									$params[] = $Proses;
								}

								return implode(" AND ", $where);
							}

					function getQCCountByShift($con, $start_date, $stop_date, $Shift, $GShift, $Proses)
							{
								$params = [];
								$whereSQL = buildQCWhere($params, $start_date, $stop_date, $Shift, $GShift, $Proses);

								$sql = "
									SELECT t.gshift, COUNT(*) AS total
									FROM db_qc.tbl_tq_nokk t
									WHERE $whereSQL
									GROUP BY t.gshift
								";

								$stmt = mysqli_prepare($con, $sql);
								$types = str_repeat('s', count($params));
								mysqli_stmt_bind_param($stmt, $types, ...$params);
								mysqli_stmt_execute($stmt);
								$res = mysqli_stmt_get_result($stmt);

								$data = ['A'=>0,'B'=>0,'C'=>0,'NON'=>0];
								while ($r = mysqli_fetch_assoc($res)) {
									$data[$r['gshift']] = (int)$r['total'];
								}
								return $data;
							}

					function getCountTest($con, $start_date, $stop_date, $Shift, $GShift, $Proses)
							{
								$params = [];
								$whereSQL = buildQCWhere($params, $start_date, $stop_date, $Shift, $GShift, $Proses);

								$sql = "SELECT
											t.gshift,
											COUNT(*) AS total
										FROM
												(
												SELECT
													t.operator,
													t.shift,
													t.gshift,
													t.tgl_update as tanggal_update_headerkk,
													t.tgl_masuk as tanggal_masuk_kk,
													t1.tgl_approve as tanggal_approve,
													CASE
														WHEN t1.tgl_update > t1.tgl_buat THEN t1.tgl_update
														ELSE t1.tgl_buat
													END AS tgl_masuk,
													t1.tgl_buat as tanggal_buat_data,
													t1.tgl_update as tanggal_update_data
												FROM
													tbl_tq_nokk t
												LEFT JOIN tbl_tq_test t1 ON
													t1.id_nokk = t.id
												WHERE
													(t.operator is not null
													AND t.shift is not null
													AND t.gshift is not null)
											) AS t
										WHERE $whereSQL
										GROUP BY t.gshift
								";

								$stmt = mysqli_prepare($con, $sql);
								$types = str_repeat('s', count($params));
								mysqli_stmt_bind_param($stmt, $types, ...$params);
								mysqli_stmt_execute($stmt);
								$res = mysqli_stmt_get_result($stmt);

								$data = ['A'=>0,'B'=>0,'C'=>0,'NON'=>0];
								while ($r = mysqli_fetch_assoc($res)) {
									$data[$r['gshift']] = (int)$r['total'];
								}
								return $data;
							}

					function getCountLot($con, $start_date, $stop_date, $Shift, $GShift, $Proses)
							{
								$params = [];
								$whereSQL = buildQCWhere($params, $start_date, $stop_date, $Shift, $GShift, $Proses);

								$sql = "SELECT
											t.gshift,
											COUNT(*) AS total
										FROM
												(
												SELECT
													t.operator,
													t.shift,
													t.gshift,
													t.tgl_update as tanggal_update_headerkk,
													t.tgl_masuk as tanggal_masuk_kk,
													t1.tgl_approve as tgl_masuk,
													CASE
														WHEN t1.tgl_update > t1.tgl_buat THEN t1.tgl_update
														ELSE t1.tgl_buat
													END AS tgl_masuk_data_kk,
													t1.tgl_buat as tanggal_buat_data,
													t1.tgl_update as tanggal_update_data
												FROM
													tbl_tq_nokk t
												LEFT JOIN tbl_tq_test t1 ON
													t1.id_nokk = t.id
												WHERE
													(t.operator is not null
													AND t.shift is not null
													AND t.gshift is not null)
											) AS t
										WHERE $whereSQL
										GROUP BY t.gshift
								";

								$stmt = mysqli_prepare($con, $sql);
								$types = str_repeat('s', count($params));
								mysqli_stmt_bind_param($stmt, $types, ...$params);
								mysqli_stmt_execute($stmt);
								$res = mysqli_stmt_get_result($stmt);

								$data = ['A'=>0,'B'=>0,'C'=>0,'NON'=>0];
								while ($r = mysqli_fetch_assoc($res)) {
									$data[$r['gshift']] = (int)$r['total'];
								}
								return $data;
							}

					function getCountLotNa($con, $start_date, $stop_date, $Shift, $GShift, $Proses)
							{
								$params = [];
								$whereSQL = buildQCWhere($params, $start_date, $stop_date, $Shift, $GShift, $Proses);

								$sql = "SELECT
											t.gshift,
											COUNT(*) AS total
										FROM
												(
												SELECT
													t.operator,
													t.shift,
													t.gshift,
													t.tgl_update as tanggal_update_headerkk,
													t.tgl_masuk as tgl_masuk,
													t1.tgl_approve as tgl_approve,
													CASE
														WHEN t1.tgl_update > t1.tgl_buat THEN t1.tgl_update
														ELSE t1.tgl_buat
													END AS tgl_masuk_data_kk,
													t1.tgl_buat as tanggal_buat_data,
													t1.tgl_update as tanggal_update_data
												FROM
													tbl_tq_nokk t
												LEFT JOIN tbl_tq_test t1 ON
													t1.id_nokk = t.id
												WHERE
													(t.operator is not null
													AND t.shift is not null
													AND t.gshift is not null)
													AND t1.tgl_approve IS NULL
											) AS t
										WHERE $whereSQL
										GROUP BY t.gshift
								";

								$stmt = mysqli_prepare($con, $sql);
								$types = str_repeat('s', count($params));
								mysqli_stmt_bind_param($stmt, $types, ...$params);
								mysqli_stmt_execute($stmt);
								$res = mysqli_stmt_get_result($stmt);

								$data = ['A'=>0,'B'=>0,'C'=>0,'NON'=>0];
								while ($r = mysqli_fetch_assoc($res)) {
									$data[$r['gshift']] = (int)$r['total'];
								}
								return $data;
							}

					function getCountTesting($con, $start_date, $stop_date, $Shift, $GShift, $Proses)
							{
								$params = [];
								$whereSQL = buildQCWhere($params, $start_date, $stop_date, $Shift, $GShift, $Proses);

								$sql = "SELECT
											t.gshift,
											COUNT(*) AS total
										FROM
												(
												SELECT
													t.operator,
													t.shift,
													t.gshift,
													t.tgl_update as tanggal_update_headerkk,
													t.tgl_masuk as tgl_masuk,
													t1.tgl_approve as tgl_approve,
													CASE
														WHEN t1.tgl_update > t1.tgl_buat THEN t1.tgl_update
														ELSE t1.tgl_buat
													END AS tgl_masuk_data_kk,
													t1.tgl_buat as tanggal_buat_data,
													t1.tgl_update as tanggal_update_data
												FROM
													tbl_tq_nokk t
												LEFT JOIN tbl_tq_test t1 ON
													t1.id_nokk = t.id
												WHERE
													(t.operator is not null
													AND t.shift is not null
													AND t.gshift is not null)
													AND (t1.tgl_buat IS NULL or t1.tgl_update IS NULL)
											) AS t
										WHERE $whereSQL
										GROUP BY t.gshift
								";

								$stmt = mysqli_prepare($con, $sql);
								$types = str_repeat('s', count($params));
								mysqli_stmt_bind_param($stmt, $types, ...$params);
								mysqli_stmt_execute($stmt);
								$res = mysqli_stmt_get_result($stmt);

								$data = ['A'=>0,'B'=>0,'C'=>0,'NON'=>0];
								while ($r = mysqli_fetch_assoc($res)) {
									$data[$r['gshift']] = (int)$r['total'];
								}
								return $data;
							}

					function getRangkumanQC($con, $start_date, $stop_date, $Shift, $GShift, $Proses)
						{
							return [
								'kain_masuk' => getQCCountByShift(
									$con, $start_date, $stop_date, $Shift, $GShift, $Proses
								),

								'testing_selesai' => getCountTest(
									$con, $start_date, $stop_date, $Shift, $GShift, $Proses
								),

								'lot_approved' => getCountLot(
									$con, $start_date, $stop_date, $Shift, $GShift, $Proses
								),

								'lot_not_approved' => getCountLotNa(
									$con, $start_date, $stop_date, $Shift, $GShift, $Proses
								),

								'testing_not_start' => getCountTesting(
									$con, $start_date, $stop_date, $Shift, $GShift, $Proses
								),

								// 'testing_masuk' => getQCCountByShift(
								// 	$con, "t.status_testing = 'MASUK'",
								// 	$start_date, $stop_date, $Shift, $GShift, $Proses
								// ),

								// 'testing_selesai' => getQCCountByShift(
								// 	$con, "t.status_testing = 'SELESAI'",
								// 	$start_date, $stop_date, $Shift, $GShift, $Proses
								// ),

								// 'lot_approved' => getQCCountByShift(
								// 	$con, "t.status_lot = 'APPROVED'",
								// 	$start_date, $stop_date, $Shift, $GShift, $Proses
								// )
							];
						}
				?>
				<table class="table table-bordered table-striped" style="width: 100%;">
					<thead class="bg-red">
						<tr>
							<th width="5%" rowspan="2">
								<div align="center">Shift</div>
							</th>
							<th width="14%" rowspan="2">
								<div align="center">Kain Masuk</div>
							</th>
							<th width="14%" rowspan="2">
								<div align="center">Jumlah Testing Masuk</div>
							</th>
							<th width="10%" rowspan="2">
								<div align="center">Testing Selesai</div>
							</th>
							<th width="18%" rowspan="2">
								<div align="center">Lot Approved</div>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php $rangkuman = getRangkumanQC($con, $start_date, $stop_date, $Shift, $GShift, $Proses);
							foreach (['A','B','C','NON'] as $s): ?>
						<tr>
							<td align="center"><b><?= $s ?></b></td>
							<td align="right"><?= $rangkuman['kain_masuk'][$s] ?></td>
							<td align="right"><?= $rangkuman['kain_masuk'][$s] ?></td>
							<td align="right"><?= $rangkuman['testing_selesai'][$s] ?></td>
							<td align="right"><?= $rangkuman['lot_approved'][$s] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<td align="center"><b>TOTAL</b></td>
							<td align="right"><?= array_sum($rangkuman['kain_masuk']) ?></td>
							<td align="right"><?= array_sum($rangkuman['kain_masuk']) ?></td>
							<td align="right"><?= array_sum($rangkuman['testing_selesai']) ?></td>
							<td align="right"><?= array_sum($rangkuman['lot_approved']) ?></td>
						</tr>
						<tr>
							<td align="center" colspan='2'><b>SISA KK TUNGGU HASIL</b></td>
							<td align="right"><?= array_sum($rangkuman['lot_not_approved']) ?></td>
							<td align="right"  colspan='2'></td>
						</tr>
						<tr>
							<td align="center" colspan='2'><b>SISA TESTING TUNGGU HASIL</b></td>
							<td align="right"><?= array_sum($rangkuman['testing_not_start']) ?></td>
							<td align="right" colspan='2'></td>
						</tr>
					</tfoot>
				</table>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kain Masuk</h3><br>
					<?php if ($_POST['awal'] != "") { ?><b>Periode:
							<?php echo $start_date . " to " . $stop_date ?>
						</b>
					<?php } ?>
					<?php if ($_POST['awal'] != "") { ?>
						<!-- <div class="pull-right">
							<a href="pages/cetak/cetak_lap_inspeksi.php?&awal=<?php echo $Awal; ?>&akhir=<?php echo $Akhir; ?>&jam_awal=<?php echo $jamA; ?>&jam_akhir=<?php echo $jamAr; ?>&shift=<?php echo $Shift; ?>&gshift=<?php echo $GShift; ?>&proses=<?php echo $Proses; ?>&buyer=<?php echo $Buyer; ?>"
								class="btn btn-danger " target="_blank" data-toggle="tooltip" data-html="true"
								title="Laporan Inspeksi"><i class="fa fa-print"></i> Cetak</a>
							<a href="pages/cetak/excel_lap_inspectnew.php?&awal=<?php echo $Awal; ?>&akhir=<?php echo $Akhir; ?>&jam_awal=<?php echo $jamA; ?>&jam_akhir=<?php echo $jamAr; ?>&shift=<?php echo $Shift; ?>&gshift=<?php echo $GShift; ?>&proses=<?php echo $Proses; ?>&buyer=<?php echo $Buyer; ?>"
								class="btn btn-success " target="_blank" data-toggle="tooltip" data-html="true"
								title="Laporan Inspeksi Harian New"><i class="fa fa-print"></i> Laporan Inspeksi Harian
								New</a>
						</div> -->
					<?php } ?>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-hover table-striped nowrap" id="example3"
						style="width:100%">
						<thead class="bg-blue">
							<tr>
								<th>
									<div align="center">No</div>
								</th>
								<th>
									<div align="center">Pelanggan</div>
								</th>
								<th>
									<div align="center">No Order</div>
								</th>
								<th>
									<div align="center">Jenis Kain</div>
								</th>
								<th>
									<div align="center">Warna</div>
								</th>
								<th>
									<div align="center">Tgl Pengiriman</div>
								</th>
								<th>
									<div align="center">Lot</div>
								</th>
								<th>
									<div align="center">No Item</div>
								</th>
								<th>
									<div align="center">Inspektor</div>
								</th>
								<th>
									<div align="center">No MC</div>
								</th>
								<th>
									<div align="center">Roll</div>
								</th>
								<th>
									<div align="center">Qty Bruto</div>
								</th>
								<th>
									<div align="center">Yard</div>
								</th>
								<th>
									<div align="center">Total Waktu</div>
								</th>
								<th>
									<div align="center">Tanggal Mulai</div>
								</th>
								<th>
									<div align="center">Tanggal Stop</div>
								</th>
								<th>
									<div align="center">Yard/Menit</div>
								</th>
								<th>
									<div align="center">No Test</div>
								</th>
								<th>Nokk</th>
								<th>No Demand</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							$query2 = "SELECT t.* FROM db_qc.tbl_tq_nokk t WHERE t.tgl_masuk between '$start_date' and '$stop_date' $Wshift $WGshift $WProses ORDER BY t.tgl_masuk ASC";
							$qry1 = mysqli_query($con, $query2);
							$totOk = 0;
							$totTk = 0;
							$totPr = 0;
							$totOkQ = 0;
							$totTkQ = 0;
							$totPrQ = 0;
							$totOkY = 0;
							$totTkY = 0;
							$totPrY = 0;
							$totF = 0;
							$totO = 0;
							$totPS = 0;
							$totFQ = 0;
							$totOQ = 0;
							$totPSQ = 0;
							$totFY = 0;
							$totOY = 0;
							$totPSY = 0;
							$okRol = 0;
							$okQty = 0;
							$okYrd = 0;
							$TkRol = 0;
							$TkQty = 0;
							$TkYrd = 0;
							$PrRol = 0;
							$PrQty = 0;
							$PrYrd = 0;
							$FRol = 0;
							$FQty = 0;
							$FYrd = 0;
							$ORol = 0;
							$OQty = 0;
							$OYrd = 0;
							$PSRol = 0;
							$PSQty = 0;
							$PSYrd = 0;
							while ($row1 = mysqli_fetch_array($qry1)) {
								$hourdiff = (int) $row1['waktu'] - (int) $row1['istirahat'];
								?>
								<tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
									<td align="center">
										<?php echo $no; ?>
									</td>
									<td align="left">
										<?php echo $row1['pelanggan']; ?>
									</td>
									<td>
										<?php echo $row1['no_order']; ?>
									</td>
									<td>
										<?php echo $row1['jenis_kain']; ?>
									</td>
									<td align="left">
										<?php echo $row1['warna']; ?>
									</td>
									<td align="center">
										<?php echo $row1['tgl_delivery']; ?>
									</td>
									<td align="center">
										<?php echo $row1['lot']; ?>
									</td>
									<td align="center">
										<?php echo $row1['no_item']; ?>
									</td>
									<td align="center">
										<?php echo $row1['personil']; ?>
									</td>
									<td align="center">
										<?php echo $row1['no_mesin']; ?>
									</td>
									<td align="center">
										<?php if ($row1['jml_rol'] > 0) { ?>
											<a data-pk="<?php echo $row1['idins']; ?>"
												data-value="<?php echo $row1['jml_rol']; ?>" class="jml_roll_inspeksi"
												href="javascript:void(0)">
												<?php echo $row1['jml_rol']; ?>
											</a>
										<?php } else { ?>
											<a data-pk="<?php echo $row1['id_schedule']; ?>"
												data-value="<?php echo $row1['rol']; ?>" class="jml_roll_inspeksi2"
												href="javascript:void(0)">
												<?php echo $row1['rol']; ?>
											</a>
										<?php } ?>
									</td>
									<td align="center">
										<?php if ($row1['jml_rol'] > 0) { ?>
											<a data-pk="<?php echo $row1['idins']; ?>" data-value="<?php echo $row1['qty']; ?>" class="qty_inspeksi"
												href="javascript:void(0)">
												<?php echo $row1['qty']; ?>
											</a>
										<?php } else { ?>
											<a data-pk="<?php echo $row1['id_schedule']; ?>" data-value="<?php echo $row1['bruto']; ?>" class="qty_inspeksi2"
												href="javascript:void(0)">
												<?php echo $row1['bruto']; ?>
											</a>
										<?php } ?>
									</td>
									<td align="center">
										<?php if ($row1['yard'] > 0) { ?>
											<a data-pk="<?php echo $row1['idins']; ?>" data-value="<?php echo $row1['yard']; ?>" class="jml_yard_inspeksi"
												href="javascript:void(0)">
												<?php echo $row1['yard']; ?>
											</a>
										<?php } else { ?>
											<a data-pk="<?php echo $row1['id_schedule']; ?>" data-value="<?php echo $row1['pjng_order']; ?>" class="jml_yard_inspeksi2"
												href="javascript:void(0)">
												<?php echo $row1['pjng_order']; ?>
											</a>
										<?php } ?>
									</td>
									<td align="center">
										<?php echo $hourdiff; ?>
									</td>
									<td align="center">
										<?php echo $row1['tgl_mulai']; ?>
									</td>
									<td align="center">
										<?php echo $row1['tgl_stop']; ?>
									</td>
									<td align="center">
										<?php if ($hourdiff > 0) {
											echo round($row1['yard'] / $hourdiff, 2);
										} else {
											echo "0";
										} ?>
									</td>
									<td>
										<?php echo $row1['no_test']; ?>
									</td>
									<td>
										<?php echo $row1['nokk']; ?>
									</td>
									<td>
										<a href="javascript:void(0)"
										class="nodemand-link"
										data-nodemand="<?php echo htmlspecialchars(trim($row1['nodemand'])); ?>">
											<?php echo htmlspecialchars($row1['nodemand']); ?>
										</a>
									</td>
									<td><a href="#" onclick="confirm_del('HapusIns-<?php echo $row1['idins'] ?>');" class="btn btn-xs btn-danger <?php if ($_SESSION['akses'] == "biasa" or $_SESSION['lvl_id'] != "INSPEKSI") {
										   echo "disabled";
									   } ?>"><i class="fa fa-trash"></i></a></td>
								</tr>
								<?php
								if ($row1['proses'] == "Inspect Finish" and $row1['status_produk'] == "1") {
									$okRol = (int) $row1['jml_rol'];
									$okQty = (int) $row1['qty'];
									$okYrd = (int) $row1['yard'];
								} else {
									$okRol = 0;
									$okQty = 0;
									$okYrd = 0;
								}
								if ($row1['proses'] == "Inspect Finish" and $row1['status_produk'] == "2") {
									$TkRol = (int) $row1['jml_rol'];
									$TkQty = (int) $row1['qty'];
									$TkYrd = (int) $row1['yard'];
								} else {
									$TkRol = 0;
									$TkQty = 0;
									$TkYrd = 0;
								}
								if ($row1['proses'] == "Inspect Finish" and $row1['status_produk'] == "3") {
									$PrRol = (int) $row1['jml_rol'];
									$PrQty = (int) $row1['qty'];
									$PrYrd = (int) $row1['yard'];
								} else {
									$PrRol = 0;
									$PrQty = 0;
									$PrYrd = 0;
								}
								if ($row1['proses'] == "Inspect Finish" and ($row1['status_produk'] == "1" or $row1['status_produk'] == "2")) {
									$FRol = (int) $row1['jml_rol'];
									$FQty = (int) $row1['qty'];
									$FYrd = (int) $row1['yard'];
								} else {
									$FRol = 0;
									$FQty = 0;
									$FYrd = 0;
								}
								if ($row1['proses'] == "Inspect Oven") {
									$ORol = (int) $row1['jml_rol'];
									$OQty = (int) $row1['qty'];
									$OYrd = (int) $row1['yard'];
								} else {
									$ORol = 0;
									$OQty = 0;
									$OYrd = 0;
								}
								if ($row1['proses'] == "Pisah") {
									$PSRol = (int) $row1['jml_rol'];
									$PSQty = (int) $row1['qty'];
									$PSYrd = (int) $row1['yard'];
								} else {
									$PSRol = 0;
									$PSQty = 0;
									$PSYrd = 0;
								}
								$totOk = $totOk + $okRol;
								$totTk = $totTk + $TkRol;
								$totPr = $totPr + $PrRol;
								$totOkQ = $totOkQ + $okQty;
								$totTkQ = $totTkQ + $TkQty;
								$totPrQ = $totPrQ + $PrQty;
								$totOkY = $totOkY + $okYrd;
								$totTkY = $totTkY + $TkYrd;
								$totPrY = $totPrY + $PrYrd;
								$totF = $totF + $FRol;
								$totO = $totO + $ORol;
								$totPS = $totPS + $PSRol;
								$totFQ = $totFQ + $FQty;
								$totOQ = $totOQ + $OQty;
								$totPSQ = $totPSQ + $PSQty;
								$totFY = $totFY + $FYrd;
								$totOY = $totOY + $FYrd;
								$totPSY = $totPSY + $PSYrd;
								$no++;
							} ?>
						</tbody>
						<tfoot>
							<tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
								<td align="center">&nbsp;</td>
								<td align="left">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align="left">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
							</tr>
							<tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
								<td align="center">&nbsp;</td>
								<td align="left"><strong>F</strong>=
									<?php echo $totF . "x" . $totFQ . " KGs"; ?>
								</td>
								<td>&nbsp;</td>
								<td align="left"><strong>OK</strong>=
									<?php echo $totOk . "x" . $totOkQ . " KGs"; ?>
								</td>
								<td align="left"><strong>PR</strong>=
									<?php echo $totPr . "x" . $totPrQ . " KGs"; ?>
								</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="left"><strong>F</strong>=
									<?php echo $totF . "x" . $totFY . " Yrds"; ?>
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align="left"><strong>OK</strong>=
									<?php echo $totOk . "x" . $totOkY . " Yrds"; ?>
								</td>
								<td align="left"><strong>PR</strong>=
									<?php echo $totPr . "x" . $totPrY . " Yrds"; ?>
								</td>
								<td align="left">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr valign="top" bgcolor="<?php echo $bgcolor; ?>">
								<td align="center">&nbsp;</td>
								<td align="left"><strong>O</strong>=
									<?php echo $totO . "x" . $totOQ . " KGs"; ?>
								</td>
								<td>&nbsp;</td>
								<td align="left"><strong>TK</strong>=
									<?php echo $totTk . "x" . $totTkQ . " KGs"; ?>
								</td>
								<td align="left"><strong>PS</strong>=
									<?php echo $totPS . "x" . $totPSQ . " KGs"; ?>
								</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="left"><strong>O</strong>=
									<?php echo $totO . "x" . $totOY . " Yrds"; ?>
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td align="left"><strong>TK</strong>=
									<?php echo $totTk . "x" . $totTkY . " Yrds"; ?>
								</td>
								<td align="left"><strong>PS</strong>=
									<?php echo $totPS . "x" . $totPSY . " Yrds"; ?>
								</td>
								<td align="left">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script>
document.addEventListener('click', function (e) {

    const link = e.target.closest('.nodemand-link');
    if (!link) return;

    const nodemand = link.dataset.nodemand;
    if (!nodemand) return;

    fetch('pages/ajax/get_no_test.php?nodemand=' + encodeURIComponent(nodemand))
        .then(response => response.json())
        .then(data => {

            if (data.no_test) {
                // ✅ buka tab baru ke halaman final
                window.open(
                    'TestingNewNoTes-' + data.no_test,
                    '_blank'
                );
            } else {
                Swal.fire({
                    title: 'No Kartu Tidak Ditemukan',
                    text: 'Klik OK untuk input data kembali',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                title: 'Terjadi Kesalahan',
                text: 'Gagal mengambil data dari server.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
});
</script>

	<!-- Modal Popup untuk delete-->
	<div class="modal fade" id="delLapIns" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" style="margin-top:100px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
				</div>

				<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
					<a href="#" class="btn btn-danger" id="del_link">Delete</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div id="StsEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true"></div>
	<script>
		$(document).ready(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});
		function confirm_del(delete_url) {
			$('#delLapIns').modal('show', {
				backdrop: 'static'
			});
			document.getElementById('del_link').setAttribute('href', delete_url);
		}
	</script>
</body>

</html>