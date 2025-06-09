<!DOCTYPE html>
<html>
<?php
ini_set("error_reporting", 1);
session_start();
?>

<head>
	<style>
		/* mengatur ukuran canvas tanda tangan  */
		canvas {
			border: 1px solid #ccc;
			border-radius: 0.5rem;
			width: 100%;
			height: 400px;
		}
	</style>
</head>
<?php
include "koneksi.php";
$id = $_GET['id'];
$query = "SELECT * FROM tbl_conform_qc WHERE id ='$id'";
$result = mysqli_query($con, $query);
$row1 = mysqli_fetch_assoc($result);
// echo"<pre>";
// echo print_r($row1);
// echo"</pre>";
//GRAMASI
$posg = strpos($row1['GRAMASI'], ".");
$valgramasi = substr($row1['GRAMASI'], 0, $posg);
//LEBAR
$posl = strpos($row1['LEBAR'], ".");
$vallebar = substr($row1['LEBAR'], 0, $posl);


if (isset($_POST['update']) && $_POST['update'] == "update" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $keputusan = str_replace("'", "''", $_POST['keputusan']);
    // File lama
    $old_file_foto = $row1['file_foto'];
    $old_file_foto2 = $row1['file_foto2'];
    $old_file_foto3 = $row1['file_foto3'];
    // File baru
    $file_foto = $_FILES['file_foto']['name'] ? $_FILES['file_foto']['name'] : $old_file_foto;
    $file_foto2 = $_FILES['file_foto2']['name'] ? $_FILES['file_foto2']['name'] : $old_file_foto2;
    $file_foto3 = $_FILES['file_foto3']['name'] ? $_FILES['file_foto3']['name'] : $old_file_foto3;
    // ambil data file
    $namaFile_foto = $_FILES['file_foto']['name'];
    $namaSementara_foto = $_FILES['file_foto']['tmp_name'];
    $namaFile_foto2 = $_FILES['file_foto2']['name'];
    $namaSementara_foto2 = $_FILES['file_foto2']['tmp_name'];
    $namaFile_foto3 = $_FILES['file_foto3']['name'];
    $namaSementara_foto3 = $_FILES['file_foto3']['tmp_name'];
    // tentukan lokasi file akan dipindahkan
    $dirUpload = "dist/img-disposisinow/";
    // pindahkan file jika ada upload baru
    if ($namaFile_foto) move_uploaded_file($namaSementara_foto, $dirUpload . $namaFile_foto);
    if ($namaFile_foto2) move_uploaded_file($namaSementara_foto2, $dirUpload . $namaFile_foto2);
    if ($namaFile_foto3) move_uploaded_file($namaSementara_foto3, $dirUpload . $namaFile_foto3);
    $qry1 = mysqli_query($con, "UPDATE tbl_conform_qc SET
        -- `no_demand`='$_POST[no_demand]',
        -- `prod_order`='$_POST[prod_order]',
        -- `langganan`='$_POST[langganan]',
        -- `buyer`='$_POST[buyer]',
        -- `no_po`='$_POST[no_po]',
        -- `no_order`='$_POST[no_order]',
        -- `no_item`='$_POST[no_item]',
        -- `article_group`='$_POST[article_group]',
        -- `article_code`='$_POST[article_code]',
        -- `jenis_kain`='$_POST[jenis_kain]',
        -- `lebar`='$_POST[lebar]',
        -- `gramasi`='$_POST[gramasi]',
        -- `warna`='$_POST[warna]',
        -- `qty_kg`='$_POST[qty_kg]',
        -- `qty_yard`='$_POST[qty_yard]',
        -- `ext_ref`='$_POST[ext_ref]',
        -- `int_ref`='$_POST[int_ref]',
        `masalah`='$_POST[masalah]',
        `keputusan`='$keputusan',
        `pejabat1`='$_POST[pejabat1]',
        `pejabat2`='$_POST[pejabat2]',
        `pejabat3`='$_POST[pejabat3]',
        `produksi`='$_POST[produksi]',
        `marketing`='$_POST[marketing]',
        `file_foto`='$file_foto',
        `file_foto2`='$file_foto2',
        `file_foto3`='$file_foto3',
        `tgl_update`=now(),
        `no_hanger`='$_POST[no_hanger]',
        `lot`='$_POST[lot]',
        `tgl_conform`='$_POST[tgl_conform]',
        `tgl_mkt_terima`='$_POST[tgl_mkt_terima]',
        `tgl_feedback`='$_POST[tgl_feedback]'
        WHERE id='$id'");
    if ($qry1) {
        echo "<script>swal({
            title: 'Data Telah diupdate',
            text: 'Klik Ok untuk kembali',
            type: 'success',
        }).then((result) => {
            if (result.value) {
                window.location.href='Reportconfrom';
            }
        });</script>";
    }
}
?>
<?php
include "koneksi.php";
$sqldis = mysqli_query($con, " SELECT * FROM tbl_conform_qc WHERE no_demand='$no_demand' ORDER BY tgl_buat ASC");
$cekdis = mysqli_num_rows($sqldis);
$rdis = mysqli_fetch_array($sqldis);
?>
<div class="box box-info">
	<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1">
		<div class="box-header with-border">
			<h3 class="box-title">Input Detail Conform</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="col-md-6">
				<div class="form-group">
					<label for="no_demand" class="col-sm-2 control-label">No Demand</label>
					<div class="col-sm-6">
						<input name="no_demand" type="text" class="form-control" id="no_demand"
							value="<?php echo $row1['no_demand']; ?>" placeholder="No Demand" readonly>
					</div>
					<font color="red"><?php if ($cekdis > 0) {
											echo "Sudah Input Pada Tgl: " . $rdis['tgl_buat'] . " | ";
										} ?></font>
				</div>
				<div class="form-group">
					<label for="text1" class="col-sm-2 control-label">Langganan</label>
					<div class="col-sm-6">
						<input name="langganan" type="text" readonly class="form-control" id="langganan" value="<?php echo $row1['langganan']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="text2" class="col-sm-2 control-label">Prod. Order</label>
					<div class="col-sm-6">
						<input name="prod_order" type="text" readonly class="form-control" id="prod_order" value="<?php echo $row1['prod_order']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="text3" class="col-sm-2 control-label">No Order</label>
					<div class="col-sm-6">
						<input name="no_order" type="text" readonly class="form-control" id="no_order" value="<?php echo $row1['no_order']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="text4" class="col-sm-2 control-label">PO</label>
					<div class="col-sm-6">
						<input name="no_po" type="text" readonly class="form-control" id="no_po" value="<?php echo $row1['no_po']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="text5" class="col-sm-2 control-label">Jenis Kain</label>
					<div class="col-sm-6">
						<textarea name="jenis_kain" readonly rows="3" class="form-control" id="jenis_kain" placeholder=""><?php echo $row1['jenis_kain']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="text6" class="col-sm-2 control-label">Warna</label>
					<div class="col-sm-6">
						<input name="warna" type="text" readonly class="form-control" id="warna" value="<?php echo $row1['warna']; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="no_hanger" class="col-sm-2 control-label">No Item</label>
					<div class="col-sm-3">
						<input readonly name="no_item" type="text" class="form-control"
							value="<?php echo $row1['no_item']; ?>" placeholder="No Item">
					</div>
				</div>

				<div class="form-group">
					<label for="no_hanger" class="col-sm-2 control-label">No Hanger</label>
					<div class="col-sm-3">
						<input readonly name="no_hanger" type="text" class="form-control" id="no_hanger"
							value="<?php echo $row1['no_hanger']; ?>" placeholder="No Hanger">
					</div>
				</div>
				<div class="form-group">
					<label for="lot" class="col-sm-2 control-label">Lot</label>
					<div class="col-sm-3">
						<input readonly name="lot" type="text" class="form-control" id="lot"
							value="<?php echo $row1['prod_order'];  ?>" placeholder="Lot">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="masalah" class="col-sm-2 control-label">Masalah</label>
					<div class="col-sm-6">
						<div class="input-group">
							<select class="form-control select2" name="masalah" id="masalah">
								<option value="">Pilih</option>
								<?php
								$qrym = mysqli_query($con, "SELECT masalah FROM tbl_masalah_conform ORDER BY masalah ASC");
								while ($rm = mysqli_fetch_array($qrym)) {
									$selected = ($row1['masalah'] == $rm['masalah']) ? 'selected' : '';
								?>
									<option value="<?php echo $rm['masalah']; ?>" <?php echo $selected; ?>><?php echo $rm['masalah']; ?></option>
								<?php } ?>
							</select>
							<?php if (@strtoupper($_SESSION['usrid']) != "INSPEKSI") { ?>
								<span class="input-group-btn"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#DataMasalah"> ...</button></span>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="pejabat1" class="col-sm-2 control-label">Pejabat QC 1</label>
					<div class="col-sm-6">
						<div class="input-group">
							<select class="form-control select2" name="pejabat1" id="pejabat1">
								<option value="">Pilih</option>
								<?php
								$qryp = mysqli_query($con, "SELECT nama FROM tbl_jabatan_qc ORDER BY nama ASC");
								while ($rp = mysqli_fetch_array($qryp)) {
									$selected = ($row1['pejabat1'] == $rp['nama']) ? 'selected' : '';
								?>
									<option value="<?php echo $rp['nama']; ?>" <?php echo $selected; ?>><?php echo $rp['nama']; ?></option>
								<?php } ?>
							</select>
							<?php if (@strtoupper($_SESSION['usrid']) != "INSPEKSI") { ?>
								<span class="input-group-btn"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#DataPejabat"> ...</button></span>
							<?php } ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="pejabat2" class="col-sm-2 control-label">Pejabat QC 2</label>
					<div class="col-sm-6">
						<div class="input-group">
							<select class="form-control select2" name="pejabat2" id="pejabat2">
								<option value="">Pilih</option>
								<?php
								$qryp = mysqli_query($con, "SELECT nama FROM tbl_jabatan_qc ORDER BY nama ASC");
								while ($rp = mysqli_fetch_array($qryp)) {
									$selected = ($row1['pejabat2'] == $rp['nama']) ? 'selected' : '';
								?>
									<option value="<?php echo $rp['nama']; ?>" <?php echo $selected; ?>><?php echo $rp['nama']; ?></option>
								<?php } ?>
							</select>
							<?php if (@strtoupper($_SESSION['usrid']) != "INSPEKSI") { ?>
								<span class="input-group-btn"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#DataPejabat"> ...</button></span>
							<?php } ?>
						</div>
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="pejabat3" class="col-sm-2 control-label">Pejabat QC 3</label>
					<div class="col-sm-6">
						<div class="input-group">
							<select class="form-control select2" name="pejabat3" id="pejabat3">
								<option value="">Pilih</option>
								<?php
								$qryp = mysqli_query($con, "SELECT nama FROM tbl_jabatan_qc ORDER BY nama ASC");
								while ($rp = mysqli_fetch_array($qryp)) {
									$selected = ($row1['pejabat3'] == $rp['nama']) ? 'selected' : '';
								?>
									<option value="<?php echo $rp['nama']; ?>" <?php echo $selected; ?>><?php echo $rp['nama']; ?></option>
								<?php } ?>
							</select>
							<?php if (@strtoupper($_SESSION['usrid']) != "INSPEKSI") { ?>
								<span class="input-group-btn"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#DataPejabat"> ...</button></span>
							<?php } ?>
						</div>
					</div>
				</div> -->
				<div class="form-group">
					<label for="produksi" class="col-sm-2 control-label">Produksi</label>
					<div class="col-sm-6">
						<div class="input-group">
							<select class="form-control select2" name="produksi" id="produksi">
								<option value="">Pilih</option>
								<?php
								$qrypr = mysqli_query($con, "SELECT nama FROM tbl_personil_produksi_conform ORDER BY nama ASC");
								while ($rpr = mysqli_fetch_array($qrypr)) {
									$selected = ($row1['produksi'] == $rpr['nama']) ? 'selected' : '';
								?>
									<option value="<?php echo $rpr['nama']; ?>" <?php echo $selected; ?>><?php echo $rpr['nama']; ?></option>
								<?php } ?>
							</select>
							<?php if (@strtoupper($_SESSION['usrid']) != "INSPEKSI") { ?>
								<span class="input-group-btn"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#DataProduksi"> ...</button></span>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="marketing" class="col-sm-2 control-label">Marketing</label>
					<div class="col-sm-6">
						<div class="input-group">
							<select class="form-control select2" name="marketing" id="marketing">
								<option value="">Pilih</option>
								<?php
								$qrypm = mysqli_query($con, "SELECT nama FROM tbl_personil_mkt ORDER BY nama ASC");
								while ($rpm = mysqli_fetch_array($qrypm)) {
									$selected = ($row1['marketing'] == $rpm['nama']) ? 'selected' : '';
								?>
									<option value="<?php echo $rpm['nama']; ?>" <?php echo $selected; ?>><?php echo $rpm['nama']; ?></option>
								<?php } ?>
							</select>
							<?php if (@strtoupper($_SESSION['usrid']) != "INSPEKSI") { ?>
								<span class="input-group-btn"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#DataMKT"> ...</button></span>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_conform" class="col-sm-2 control-label">Tgl Conform</label>
					<div class="col-sm-4">
						<input name="tgl_conform" type="date" class="form-control" id="tgl_conform" value="<?php echo $row1['tgl_conform']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_mkt_terima" class="col-sm-2 control-label">Tgl MKT Terima</label>
					<div class="col-sm-4">
						<input name="tgl_mkt_terima" type="date" class="form-control" id="tgl_mkt_terima" value="<?php echo $row1['tgl_mkt_terima']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_feedback" class="col-sm-2 control-label">Tgl Feedback</label>
					<div class="col-sm-4">
						<input name="tgl_feedback" type="date" class="form-control" id="tgl_feedback" value="<?php echo $row1['tgl_feedback']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="keputusan" class="col-sm-2 control-label">Keputusan</label>
					<div class="col-sm-6">
						<select name="keputusan" id="keputusan" placeholder="Keputusan" required class="form-control select2">
							<option value="">-</option>
							<option value="Approved" <?php echo ($row1['keputusan'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
							<option value="Conditional Approved" <?php echo ($row1['keputusan'] == 'Conditional Approved') ? 'selected' : ''; ?>>Conditional Approved</option>
							<option value="Limited Approved" <?php echo ($row1['keputusan'] == 'Limited Approved') ? 'selected' : ''; ?>>Limited Approved</option>
							<option value="Reject" <?php echo ($row1['keputusan'] == 'Reject') ? 'selected' : ''; ?>>Reject</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="file_foto" class="col-md-2 control-label">Upload Foto Confrom </label>
					<div class="col-sm-5">
						<input type="file" id="file_foto" name="file_foto">
						<?php if ($row1['file_foto'] != "") { echo '<span style="color:red;">'.$row1['file_foto'].'</span>'; } ?>
						<span class="help-block with-errors"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="file_foto2" class="col-md-2 control-label">Upload Foto Feedback Langganan</label>
					<div class="col-sm-5">
						<input type="file" id="file_foto2" name="file_foto2">
						<?php if ($row1['file_foto2'] != "") { echo '<span style="color:red;">'.$row1['file_foto2'].'</span>'; } ?>
						<span class="help-block with-errors"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="file_foto3" class="col-md-2 control-label">Upload Foto Inspect Report</label>
					<div class="col-sm-5">
						<input type="file" id="file_foto3" name="file_foto3">
						<?php if ($row1['file_foto3'] != "") { echo '<span style="color:red;">'.$row1['file_foto3'].'</span>'; } ?>
						<span class="help-block with-errors"></span>
					</div>
				</div>
			</div>
			<br><br><br>

			<div class="box-footer">
					<button type="submit" class="btn btn-primary pull-right" name="update" value="update"><i class="fa fa-edit"></i> Update</button>
			</div>
			<div class="box-footer">
				<a href="Reportconfrom" class="btn btn-warning pull-left" target="_blank"> Lihat Data</a>
			</div>
	</form>
</div>
	<!-- /.modal-dialog -->
	</div>
	<?php
	if ($_POST['simpan_pejabat'] == "Simpan") {
		$nama = strtoupper($_POST['nama']);
		$sqlData1 = mysqli_query($con, "INSERT INTO tbl_jabatan_qc SET 
		  nama='$nama'");
		if ($sqlData1) {
			echo "<script>swal({
                title: 'Data Telah Tersimpan',   
                text: 'Klik Ok untuk input data kembali',
                type: 'success',
                }).then((result) => {
                if (result.value) {
                        window.location.href='Laporanconfrom';
                    
                }
                });</script>";
		}
	}
	?>

	<div class="modal fade" id="DataProduksi">
		<div class="modal-dialog ">
			<div class="modal-content">
				<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Personil Produksi</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id" name="id">
						<div class="form-group">
							<label for="nama" class="col-md-3 control-label">Nama Personil</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="nama" name="nama" required>
								<span class="help-block with-errors"></span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<input type="submit" value="Simpan" name="simpan_personil" id="simpan_personil" class="btn btn-primary pull-right">
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<?php
	if ($_POST['simpan_personil'] == "Simpan") {
		$nama = strtoupper($_POST['nama']);
		$sqlData1 = mysqli_query($con, "INSERT INTO tbl_personil_produksi_conform SET 
		  nama='$nama'");
		if ($sqlData1) {
			echo "<script>swal({
                title: 'Data Telah Tersimpan',   
                text: 'Klik Ok untuk input data kembali',
                type: 'success',
                }).then((result) => {
                if (result.value) {
                        window.location.href='Laporanconfrom';
                    
                }
                });</script>";
		}
	}
	?>

	<div class="modal fade" id="DataMKT">
		<div class="modal-dialog ">
			<div class="modal-content">
				<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Personil Marketing</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id" name="id">
						<div class="form-group">
							<label for="nama" class="col-md-3 control-label">Nama Personil</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="nama" name="nama" required>
								<span class="help-block with-errors"></span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<input type="submit" value="Simpan" name="simpan_mkt" id="simpan_mkt" class="btn btn-primary pull-right">
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<?php
	if ($_POST['simpan_mkt'] == "Simpan") {
		$nama = strtoupper($_POST['nama']);
		$sqlData1 = mysqli_query($con, "INSERT INTO tbl_personil_mkt SET 
		  nama='$nama'");
		if ($sqlData1) {
			echo "<script>swal({
                            title: 'Data Telah Tersimpan',   
                            text: 'Klik Ok untuk input data kembali',
                            type: 'success',
                            }).then((result) => {
                            if (result.value) {
                                    window.location.href='Laporanconfrom';
                                
                            }
                            });</script>";
		}
	}
	?>
	<div class="modal fade" id="DataMasalah">
		<div class="modal-dialog ">
			<div class="modal-content">
				<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Masalah Dominan</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id" name="id">
						<div class="form-group">
							<label for="masalah_dominan" class="col-md-3 control-label">Jenis Masalah</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="masalah_dominan" name="masalah_dominan" required>
								<span class="help-block with-errors"></span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<input type="submit" value="Simpan" name="simpan_masalah" id="simpan_masalah" class="btn btn-primary pull-right">
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<?php
	if ($_POST['simpan_masalah'] == "Simpan") {
		$masalah = strtoupper($_POST['masalah_dominan']);
		$sqlData1 = mysqli_query($con, "INSERT INTO tbl_masalah_conform SET 
		  masalah='$masalah'");
		if ($sqlData1) {
			echo "<script>swal({
                title: 'Data Telah Tersimpan',   
                text: 'Klik Ok untuk input data kembali',
                type: 'success',
                }).then((result) => {
                if (result.value) {
                        window.location.href='Laporanconfrom';
                    
                }
                });</script>";
		}
	}
	?>
	<script>
		// script di dalam ini akan dijalankan pertama kali saat dokumen dimuat
		document.addEventListener('DOMContentLoaded', function() {
			resizeCanvas();
		})

		//script ini berfungsi untuk menyesuaikan tanda tangan dengan ukuran canvas
		function resizeCanvas() {
			var ratio = Math.max(window.devicePixelRatio || 1, 1);
			canvas.width = canvas.offsetWidth * ratio;
			canvas.height = canvas.offsetHeight * ratio;
			canvas.getContext("2d").scale(ratio, ratio);
		}


		var canvas = document.getElementById('signature-pad');

		//warna dasar signaturepad
		var signaturePad = new SignaturePad(canvas, {
			backgroundColor: 'rgb(255, 255, 255)'
		});

		//saat tombol clear diklik maka akan menghilangkan seluruh tanda tangan
		document.getElementById('clear').addEventListener('click', function() {
			signaturePad.clear();
		});

		//saat tombol undo diklik maka akan mengembalikan tanda tangan sebelumnya
		document.getElementById('undo').addEventListener('click', function() {
			var data = signaturePad.toData();
			if (data) {
				data.pop(); // remove the last dot or line
				signaturePad.fromData(data);
			}
		});

		//saat tombol change color diklik maka akan merubah warna pena
		document.getElementById('change-color').addEventListener('click', function() {

			//jika warna pena biru maka buat menjadi hitam dan sebaliknya
			if (signaturePad.penColor == "rgba(0, 0, 255, 1)") {

				signaturePad.penColor = "rgba(0, 0, 0, 1)";
			} else {
				signaturePad.penColor = "rgba(0, 0, 255, 1)";
			}
		})

		//fungsi untuk menyimpan tanda tangan dengan metode ajax
		$(document).on('click', '#btn-submit', function() {
			var signature = signaturePad.toDataURL();

			$.ajax({
				url: "proses.php",
				data: {
					foto: signature,
				},
				method: "POST",
				success: function() {
					location.reload();
					alert('Tanda Tangan Berhasil Disimpan');
				}

			})
		})
	</script>
	<script type="text/javascript">
		function confirm_delete(delete_url) {
			$('#modal_del').modal('show', {
				backdrop: 'static'
			});
			document.getElementById('delete_link').setAttribute('href', delete_url);
		}
	</script>