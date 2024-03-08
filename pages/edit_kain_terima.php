<?php
	$id = $_POST['id'];
	$sts = $_POST['sts'];	
	$penerima = str_replace("'","''", $_POST['nama_penerima']);
	$diterima = str_replace("'","''", $_POST['diterima_oleh']);
	$approved1 = str_replace("'","''", $_POST['approved1']);
    $approved2 = str_replace("'","''", $_POST['approved2']);
	$sqlupdate=mysqli_query($conlab,"UPDATE `tbl_test_qc` SET 
				`sts_qc`='$sts',
				`nama_penerima`='$penerima',
				`diterima_oleh`='$diterima',
				`approved_qc1` ='$approved1',
				`approved_qc2` ='$approved2',
				`tgl_terimakain`=now(),
				`terimakain_by`='".$_SESSION['usrid']."'
				WHERE `id`='$id' LIMIT 1");
				echo " <script>window.location='KainInLab';</script>";
?>