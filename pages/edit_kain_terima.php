<?php
	$id = $_POST['id'];
	$sts = $_POST['sts'];	
	$penerima = str_replace("'","''", $_POST['nama_penerima']);
	$diterima = str_replace("'","''", $_POST['diterima_oleh']);
	$sqlupdate=mysqli_query($conlab,"UPDATE `tbl_test_qc` SET 
				`sts_qc`='$sts',
				`sts_laborat`='In Progress',
				`nama_penerima`='$penerima',
				`diterima_oleh`='$diterima',
				`tgl_terimakain`=now(),
				`terimakain_by`='".$_SESSION['usrid']."'
				WHERE `id`='$id' LIMIT 1");
				echo " <script>window.location='KainInLab';</script>";
?>