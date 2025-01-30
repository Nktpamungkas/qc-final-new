<?PHP
ini_set("error_reporting", 1);
set_time_limit(0);
session_start();
include "koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bon Penghubung</title>

</head>
<body>
<?php
$Awal	= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	= isset($_POST['akhir']) ? $_POST['akhir'] : '';
$Order	= isset($_POST['order']) ? $_POST['order'] : '';
$Hanger	= isset($_POST['hanger']) ? $_POST['hanger'] : '';
$PO	= isset($_POST['po']) ? $_POST['po'] : '';	
$Warna	= isset($_POST['warna']) ? $_POST['warna'] : '';
$Item	= isset($_POST['item']) ? $_POST['item'] : '';
$Langganan	= isset($_POST['langganan']) ? $_POST['langganan'] : '';
$Pelanggan	= isset($_POST['pelanggan']) ? $_POST['pelanggan'] : '';
$Proses	= isset($_POST['prosesmkt']) ? $_POST['prosesmkt'] : '';
$sts_tembakdok = isset($_POST['sts_tembakdok']) ? $_POST['sts_tembakdok'] : '';
$ProdOrder	= isset($_POST['prod_order']) ? $_POST['prod_order'] : '';
$Demand	= isset($_POST['demand']) ? $_POST['demand'] : '';
	
if($_POST['gshift']=="ALL"){$shft=" ";}else{$shft=" AND b.g_shift = '$GShift' ";}	

?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"> Filter Bon Penghubung</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
    <div class="box-body">
    <div class="form-group">
        <div class="col-sm-2">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="awal" type="date" class="form-control pull-right" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off"/>
          </div>
        </div>
        <div class="col-sm-2">
            <input name="order" type="text" class="form-control pull-right" id="order" placeholder="No Order" value="<?php echo $Order;  ?>" autocomplete="off"/>
          </div>
        <div class="col-sm-2">
            <input name="hanger" type="text" class="form-control pull-right" id="hanger" placeholder="No Hanger" value="<?php echo $Hanger;  ?>" autocomplete="off"/>
          </div>
          <div class="col-sm-2">
            <input name="warna" type="text" class="form-control pull-right" id="warna" placeholder="Warna" value="<?php echo $Warna;  ?>" autocomplete="off"/>
          </div>
          <div class="col-sm-2">
            <input name="prod_order" type="text" class="form-control pull-right" id="prod_order" placeholder="Production Order" value="<?php echo $ProdOrder;  ?>" autocomplete="off"/>
          </div>
        <!-- /.input group -->
      </div>
      <div class="form-group">
        <div class="col-sm-2">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="akhir" type="date" class="form-control pull-right" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" autocomplete="off"/>
          </div>
        </div>
        <div class="col-sm-2">
            <input name="po" type="text" class="form-control pull-right" id="po" placeholder="No PO" value="<?php echo $PO;  ?>" autocomplete="off"/>
          </div>
       
        <div class="col-sm-2">
            <input name="item" type="text" class="form-control pull-right" id="item" placeholder="No Item" value="<?php echo $Item;  ?>" autocomplete="off"/>
          </div>
          <div class="col-sm-2">
            <input name="pelanggan" type="text" class="form-control pull-right" id="pelanggan" placeholder="Pelanggan" value="<?php echo $Pelanggan;  ?>" autocomplete="off"/>
          </div>
          <div class="col-sm-2">
            <input name="demand" type="text" class="form-control pull-right" id="demand" placeholder="Demand" value="<?php echo $Demand;  ?>" autocomplete="off"/>
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
        <h3 class="box-title">Summary Order</h3><br>
		    <!--
            <div class="pull-right">
                <a href="pages/cetak/excel_summaryorder.php?order=<?php echo $_POST['order']; ?>&hanger=<?php echo $_POST['hanger']; ?>&po=<?php echo $_POST['po']; ?>&warna=<?php echo $_POST['warna']; ?>&item=<?php echo $_POST['item']; ?>&awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&langganan=<?php echo $_POST['langganan']; ?>&proses=<?php echo $_POST['prosesmkt']; ?>" class="btn btn-primary" target="_blank">Excel</a> 
            </div>
			-->
	    </div>
      <div class="box-body">
	  
	  
	  
	  
        <table class="table table-bordered table-hover table-striped nowrap" id="example3" style="width:100%">
          <thead class="bg-blue">
            <tr>  
              <th rowspan=2><div align="center" valign="middle">DATE</div></th>
			  <th  rowspan=2><div align="center" valign="middle">STATUS</div></th>
			  <th  rowspan=2><div align="center" valign="middle">CUSTOMER</div></th>
			  <th  rowspan=2><div align="center" valign="middle">BUYER</div></th>
			  <th  rowspan=2><div align="center" valign="middle">PO</div></th>
			  <th  rowspan=2><div align="center" valign="middle">ORDER</div></th>
			   <th  rowspan=2><div align="center" valign="middle">HANGER</div></th>
			   <th  rowspan=2><div align="center" valign="middle">ITEM</div></th>
			   <th  rowspan=2><div align="center" valign="middle">COLOR</div></th>
			   <th  rowspan=2><div align="center" valign="middle">LOT-LEGACY</div></th>
			   <th  rowspan=2><div align="center" valign="middle">LOT</div></th>
         <th  rowspan=2><div align="center" valign="middle">DEMAND</div></th>

         <th colspan=2><div align="center" valign="middle">QTY-ORDER</div></th>
			   <th colspan=3 ><div align="center" valign="middle">QTY-PACKING</div></th>
         <th colspan=2 ><div align="center" valign="middle">QTY-FOC</div></th>
         <th colspan=2 ><div align="center" valign="middle">ESTIMASI FOC</div></th>
         <th colspan=3 ><div align="center" valign="middle">QTY-BERMASALAH</div></th>

			   <th  rowspan=2><div align="center" valign="middle">ISSUE</div></th>
			   <th  rowspan=2><div align="center" valign="middle">NOTES</div></th>
			   <th  rowspan=2><div align="center" valign="middle">ADVICE FROM PRODUCTION/QC</div></th>
			   <th  rowspan=2><div align="center" valign="middle">RESPONSIBILITY</div></th>
			   <th  rowspan=2><div align="center" valign="middle">ACTUAL DELIVERY</div></th>

         <!-- <th rowspan="2"><div align="center" valign="middle">Tanggal Surat Jalan</div></th>
         <th rowspan="2"><div align="center" valign="middle">Nomor Surat Jalan</div></th> -->

      </tr>
			<tr>  
              
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>

			    <th><div align="center" valign="middle">ROLL</div></th>
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>

        <!-- <th><div align="center" valign="middle">ROLL</div></th> -->
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>
        <!-- ESTIMASI -->
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>
        <!-- MASALAH -->
        <th><div align="center" valign="middle">ROLL</div></th>
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>
				
				
				
            </tr>
         
          </thead>
          <tbody>
          <?php
          if(($Awal != "" && $Akhir != "") || $Order != "" || $PO != "" || $Hanger != "" || $Item != "" || $Warna != "" || $Pelanggan != "" || $ProdOrder != "" || $Demand != "" || $Proses != ""){
            $no=1;

            $fields = [];

            if($Awal != "" && $Akhir != ""){ 
              $fields[] = " DATE_FORMAT( tgl_masuk, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; 
            }
            if($Order != ""){ 
              $fields[] = " tq.no_order LIKE '%$Order%' "; 
            }
            if($PO != ""){ 
              $fields[] = " tq.no_po LIKE '%$PO%' "; 
            }
            if($Hanger != ""){ 
              $fields[] = " tq.no_hanger LIKE '%$Hanger%' "; 
            }
            if($Item != ""){ 
              $fields[] = " tq.no_item LIKE '%$Item%' "; 
            }
            if($Warna != ""){ 
              $fields[] = " tq.warna LIKE '%$Warna%' "; 
            }
            if($Pelanggan != ""){ 
              $fields[] = " tq.pelanggan LIKE '%$Pelanggan%' "; 
            }
            if($ProdOrder != ""){ 
              $fields[] = " tq.nokk LIKE '%$ProdOrder%' "; 
            }
            if($Demand != ""){ 
              $fields[] = " tq.nodemand LIKE '%$Demand%' "; 
            }
            if($Proses != ""){ 
              $fields[] = " sts_aksi='$Proses' "; 
            }
            if($sts_tembakdok=="1"){ 
              $fields[] = " sts_tembakdok='1' "; 
            }
            
            $default_fields = " AND tq.sts_pbon!='10' AND (tq.penghubung_masalah !='' or tq.penghubung_keterangan !='' or tq.penghubung_roll1 !='' or tq.penghubung_roll2 !='' or tq.penghubung_roll3 !=''  or tq.penghubung_dep !='' or tq.penghubung_dep_persen !='') ";
            $group_by_fields = " GROUP BY tq.no_order, tq.no_po, tq.no_hanger, tq.no_item, tq.warna, tq.pelanggan, tq.tgl_masuk; ";

            $sql_code = "SELECT  tq.*, tli.qty_loss AS qty_sisa, tli.satuan AS satuan_sisa FROM tbl_qcf tq 
                      LEFT JOIN tbl_lap_inspeksi tli ON tq.nodemand = tli.nodemand and tq.no_order = tli.no_order ";

            if(count($fields) > 0) {
              $sql_code .= "WHERE " . implode("AND", $fields) . $default_fields . $group_by_fields;
            }
            $sql=mysqli_query($con,$sql_code);
            
			/*
			echo '<pre>';
					print_r($sql_code);
				  echo '</pre>'; */
				  ?>
          <div style="display: flex; justify-content: end">
              <?php if($_SESSION['usrid'] != 'ppc'): ?>
              <form action="pages/cetak/cetak_newbonpenghubung_mkt.php" method="POST" target="_blank">
                <input type="hidden" name="sql" value="<?= $sql_code ?>">
                <input type="submit" value="CETAK EXCEL TO MKT">
              </form>
              <?php endif; ?>
              &nbsp;&nbsp;&nbsp;
              <form action="pages/cetak/cetak_newbonpenghubung.php" method="POST" target="_blank">
                <input type="hidden" name="sql" value="<?= $sql_code ?>">
                <input type="submit" value="CETAK EXCELL">
              </form>
            </div>
            <br>
			<?php 
                while($row1=mysqli_fetch_array($sql)){
                  $dtArr=$row1['t_jawab'];
                  $data = explode(",",$dtArr);
                  $dtArr1=$row1['persen'];
                  $data1 = explode(",",$dtArr1);
				  
				 if ($row1['penghubung_dep_persen'] !='') {
					 $array_persen = array();
					  $arrayA = explode(',', $row1['penghubung_dep_persen']);
						foreach ($arrayA as $element) {
							 $array_persen[] = $element ;
						}
				  }

          // $sj = suratJalan($row1['lot'], $row1['no_po']);
?>
              
		 
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo $row1['tgl_masuk'];?></td>
            <td align="center"><?php $rsts= mysqli_query($con,"SELECT * FROM tbl_bonpenghubung_mail WHERE nodemand='$row1[nodemand]'");
            $dtsts = mysqli_fetch_assoc($rsts);
            if($dtsts['status_approve']==1){
              echo 'APPROVE OLEH'.$dtsts['approve_mkt'];
            }else if($dtsts['status_approve']==99){
              echo 'REJECT OLEH'.$dtsts['approve_mkt'];
            }else if($dtsts['status_approve']==2){
              echo 'CLOSED OLEH'.$dtsts['closed_ppc'];
            } else {
              echo '';
            }?></td>
			<td align="center"><?php echo explode('/', $row1['pelanggan'])[0];?></td>
			<td align="center"><?php echo explode('/', $row1['pelanggan'])[1];?></td>
			 <td align="center"><?php echo $row1['no_po'];?></td>
			 <td align="center"><?php echo $row1['no_order'];?></td>
			 <td align="center"><?php echo $row1['no_hanger'];?></td>
			  <td align="center"><?php echo $row1['no_item'];?></td>
			  <td align="center"><?php echo $row1['warna'];?></td>
			  <td align="center"><?php echo $row1['lot_legacy'];?></td>
			  <td align="center"><?php echo $row1['lot'];?></td>
        <td align="center"><?php echo $row1['nodemand'];?></td>

			  <td align="center"><?php echo $row1['berat_order'];?></td>
			  <td align="center"><?php echo $row1['panjang_order'];?></td>

			  <td align="center"><?php echo $row1['rol'];?></td>
			  <td align="center"><?php echo $row1['netto'];?></td>
			  <td align="center"><?php echo $row1['panjang'];?></td>

        <!-- Tambahan -->
        <td align="center"><?php echo $row1['berat_extra'];?></td>
			  <td align="center"><?php echo $row1['panjang_extra'];?></td>
			  <!-- <td align="center"><?php echo $row1['penghubung_foc3'];?></td> -->

        <!-- ESTIMASI -->
        <td align="center"><?php echo $row1['estimasi'];?></td>
			  <td align="center"><?php echo $row1['panjang_estimasi'];?></td>

        <td align="center"><?php echo $row1['penghubung_roll1'];?></td>
			  <td align="center"><?php echo $row1['penghubung_roll2'];?></td>
			  <td align="center"><?php echo $row1['penghubung_roll3'];?></td>

			   <td align="center"><?php echo $row1['penghubung_masalah'];?></td>
			    <td align="center"><?php echo $row1['penghubung_keterangan'];?></td>
			    <td align="center"><?php echo $row1['advice1'];?></td>
				<td align="center">
				<?php if ($row1['penghubung_dep'] !='') {
						$arrayA = explode(',', $row1['penghubung_dep']);
						$no_depp = 1;
            echo $row1['penghubung_dep'].' ' ;
						foreach ($arrayA as $key=>$element) {			
							if (array_key_exists($key,$array_persen ?? [] )) {
								
								if ($no_depp >=2) {
									echo ',';
								}
								
								// echo $element.' ' ;
								echo $array_persen [$key];
								
								
								echo ' ';
								
							}  
						$no_depp++;
						}
				  }   ?>
				</td>
        <td> <?php 
        $qDemand =db2_exec($conn1, "SELECT 
	CASE 
		WHEN p.DLVSALORDERLINESALESORDERCODE IS NULL THEN p.ORIGDLVSALORDLINESALORDERCODE
		ELSE p.DLVSALORDERLINESALESORDERCODE
	END AS SALESORDERCODE,
	CASE 
		WHEN p.DLVSALESORDERLINEORDERLINE IS NULL THEN p.ORIGDLVSALORDERLINEORDERLINE 
		ELSE p.DLVSALESORDERLINEORDERLINE
	END AS ORDERLINE
	FROM PRODUCTIONDEMAND p 
	WHERE p.CODE ='$row1[nodemand]'");
        $rowdb2 = db2_fetch_assoc($qDemand);
        $q_actual_delivery      = db2_exec($conn1, "SELECT
        COALESCE(s2.CONFIRMEDDELIVERYDATE, s.CONFIRMEDDUEDATE) AS ACTUAL_DELIVERY
    FROM
        SALESORDER s 
    LEFT JOIN SALESORDERDELIVERY s2 ON s2.SALESORDERLINESALESORDERCODE = s.CODE AND s2.SALORDLINESALORDERCOMPANYCODE = s.COMPANYCODE AND s2.SALORDLINESALORDERCOUNTERCODE = s.COUNTERCODE 
    WHERE
        s2.SALESORDERLINESALESORDERCODE = '$rowdb2[SALESORDERCODE]'
        AND s2.SALESORDERLINEORDERLINE = '$rowdb2[ORDERLINE]'");
$row_actual_delivery    = db2_fetch_assoc($q_actual_delivery);
echo $row_actual_delivery['ACTUAL_DELIVERY'];?></td>	 
        

          </tr>
		  
		  <?php if($row1['penghubung2_roll1'] and  $row1['penghubung2_roll1'] !='')  
		  {  
		  ?>
		  
		  
		  <tr bgcolor="<?php echo $bgcolor; ?>">
        <td align="center"><?php echo $row1['tgl_masuk'];?></td>
        <td align="center"><?php $rsts= mysqli_query($con,"SELECT * FROM tbl_bonpenghubung_mail WHERE nodemand='$row1[nodemand]'");
            $dtsts = mysqli_fetch_assoc($rsts);
            if($dtsts['status_approve']==1){
              echo 'APPROVE OLEH'.$dtsts['approve_mkt'];
            }else if($dtsts['status_approve']==99){
              echo 'REJECT OLEH'.$dtsts['approve_mkt'];
            }else if($dtsts['status_approve']==2){
              echo 'CLOSED OLEH'.$dtsts['closed_ppc'];
            } else {
              echo '';
            }?></td>
        <td align="center"><?php echo explode('/', $row1['pelanggan'])[0];?></td>
        <td align="center"><?php echo explode('/', $row1['pelanggan'])[1];?></td>
        <td align="center"><?php echo $row1['no_po'];?></td>
        <td align="center"><?php echo $row1['no_order'];?></td>
        <td align="center"><?php echo $row1['no_hanger'];?></td>
			  <td align="center"><?php echo $row1['no_item'];?></td>
			  <td align="center"><?php echo $row1['warna'];?></td>
			  <td align="center"><?php echo $row1['lot_legacy'];?></td>
			  <td align="center"><?php echo $row1['lot'];?></td>
        <td align="center"><?php echo $row1['nodemand'];?></td>



			  <td align="center"><?php echo $row1['berat_order'];?></td>
			  <td align="center"><?php echo $row1['panjang_order'];?></td>


			  <td align="center"><?php echo $row1['rol'];?></td>
			  <td align="center"><?php echo $row1['netto'];?></td>
			  <td align="center"><?php echo $row1['panjang'];?></td>

     <!-- Tambahan -->
     <!-- <td align="center"><?php echo $row1['berat_extra'];?></td> -->
     <!-- <td align="center"><?php echo $row1['panjang_extra'];?></td> -->
     <td align="center"></td>
     <td align="center"></td>

     <!-- ESTINASI -->
     <td align="center"></td>
     <td align="center"></td>

     <td align="center"><?php echo $row1['penghubung2_roll1'];?></td>
			  <td align="center"><?php echo $row1['penghubung2_roll2'];?></td>
			  <td align="center"><?php echo $row1['penghubung2_roll3'];?></td>
			  
			  <!-- <td align="center"><?php echo $row1['penghubung_foc3'];?></td> -->

			   <td align="center"><?php echo $row1['penghubung2_masalah'];?></td>
			    <td align="center"><?php echo $row1['penghubung2_keterangan'];?></td>
			    <td align="center"><?php echo $row1['advice2'];?></td>
				<td align="center">
				<?php if ($row1['penghubung2_dep'] !='') {
						$arrayA = explode(',', $row1['penghubung2_dep']);
						$no_depp = 1;
            echo $row1['penghubung2_dep'].' ' ;
						foreach ($arrayA as $key=>$element) {			
							if (array_key_exists($key,$array_persen )) {
								
								if ($no_depp >=2) {
									echo ',';
								}
								
								// echo $element.' ' ;
								echo $array_persen [$key];
								
								
								echo ' ';
								
							}
						$no_depp++;
						}
				  }   ?>
				</td>	
        <td> <?php 
        $qDemand =db2_exec($conn1, "SELECT 
	CASE 
		WHEN p.DLVSALORDERLINESALESORDERCODE IS NULL THEN p.ORIGDLVSALORDLINESALORDERCODE
		ELSE p.DLVSALORDERLINESALESORDERCODE
	END AS SALESORDERCODE,
	CASE 
		WHEN p.DLVSALESORDERLINEORDERLINE IS NULL THEN p.ORIGDLVSALORDERLINEORDERLINE 
		ELSE p.DLVSALESORDERLINEORDERLINE
	END AS ORDERLINE
	FROM PRODUCTIONDEMAND p 
	WHERE p.CODE ='$row1[nodemand]'");
        $rowdb2 = db2_fetch_assoc($qDemand);
        $q_actual_delivery      = db2_exec($conn1, "SELECT
        COALESCE(s2.CONFIRMEDDELIVERYDATE, s.CONFIRMEDDUEDATE) AS ACTUAL_DELIVERY
    FROM
        SALESORDER s 
    LEFT JOIN SALESORDERDELIVERY s2 ON s2.SALESORDERLINESALESORDERCODE = s.CODE AND s2.SALORDLINESALORDERCOMPANYCODE = s.COMPANYCODE AND s2.SALORDLINESALORDERCOUNTERCODE = s.COUNTERCODE 
    WHERE
        s2.SALESORDERLINESALESORDERCODE = '$rowdb2[SALESORDERCODE]'
        AND s2.SALESORDERLINEORDERLINE = '$rowdb2[ORDERLINE]'");
$row_actual_delivery    = db2_fetch_assoc($q_actual_delivery);
echo $row_actual_delivery['ACTUAL_DELIVERY'];?></td>	
        	
          </tr>
		  
		  
		  <?php  } ?>
		  
		  
		   <?php if($row1['penghubung3_roll1'] and  $row1['penghubung3_roll1'] !='')  
		  {  
		  ?>
		  
		  
		   <tr bgcolor="<?php echo $bgcolor; ?>">
        <td align="center"><?php echo $row1['tgl_masuk'];?></td>
        <td align="center"><?php $rsts= mysqli_query($con,"SELECT * FROM tbl_bonpenghubung_mail WHERE nodemand='$row1[nodemand]'");
            $dtsts = mysqli_fetch_assoc($rsts);
            if($dtsts['status_approve']==1){
              echo 'APPROVE OLEH: '.$dtsts['approve_mkt'];
            }else if($dtsts['status_approve']==99){
              echo 'REJECT OLEH: '.$dtsts['approve_mkt'];
            }else if($dtsts['status_approve']==2){
              echo 'CLOSED OLEH: '.$dtsts['closed_ppc'];
            } else {
              echo '';
            }?></td>
        <td align="center"><?php echo explode('/', $row1['pelanggan'])[0];?></td>
        <td align="center"><?php echo explode('/', $row1['pelanggan'])[1];?></td>
        <td align="center"><?php echo $row1['no_po'];?></td>
        <td align="center"><?php echo $row1['no_order'];?></td>
        <td align="center"><?php echo $row1['no_hanger'];?></td>
			  <td align="center"><?php echo $row1['no_item'];?></td>
			  <td align="center"><?php echo $row1['warna'];?></td>
			  <td align="center"><?php echo $row1['lot_legacy'];?></td>
			  <td align="center"><?php echo $row1['lot'];?></td>
			  <td align="center"><?php echo $row1['nodemand'];?></td>

			  <td align="center"><?php echo $row1['berat_order'];?></td>
			  <td align="center"><?php echo $row1['panjang_order'];?></td>
			  
        <td align="center"><?php echo $row1['rol'];?></td>
			  <td align="center"><?php echo $row1['netto'];?></td>
			  <td align="center"><?php echo $row1['panjang'];?></td>
       <!-- Tambahan -->
       <!-- <td align="center"><?php echo $row1['berat_extra'];?></td> -->
     <!-- <td align="center"><?php echo $row1['panjang_extra'];?></td> -->
     <td align="center"></td>
     <td align="center"></td>

     <!-- ESTIMASI -->
     <td align="center"></td>
     <td align="center"></td>

     
      <td align="center"><?php echo $row1['penghubung3_roll1'];?></td>
      <td align="center"><?php echo $row1['penghubung3_roll2'];?></td>
      <td align="center"><?php echo $row1['penghubung3_roll3'];?></td>
        
			   <td align="center"><?php echo $row1['penghubung3_masalah'];?></td>
			    <td align="center"><?php echo $row1['penghubung3_keterangan'];?></td>
			    <td align="center"><?php echo $row1['advice3'];?></td>
				<td align="center">
<?php if ($row1['penghubung3_dep'] !='') {
						$arrayA = explode(',', $row1['penghubung3_dep']);
						$no_depp = 1;
            echo $row1['penghubung3_dep'];
						foreach ($arrayA as $key=>$element) {			
							if (array_key_exists($key,$array_persen )) {
								
								if ($no_depp >=2) {
									echo ',';
								}
								
								// echo $element.' ' ;
								echo $array_persen [$key];
								
								
								echo ' ';
								
							}
						$no_depp++;
						}
				  }   ?>
				</td>	 	
        <td> <?php 
        $qDemand =db2_exec($conn1, "SELECT 
	CASE 
		WHEN p.DLVSALORDERLINESALESORDERCODE IS NULL THEN p.ORIGDLVSALORDLINESALORDERCODE
		ELSE p.DLVSALORDERLINESALESORDERCODE
	END AS SALESORDERCODE,
	CASE 
		WHEN p.DLVSALESORDERLINEORDERLINE IS NULL THEN p.ORIGDLVSALORDERLINEORDERLINE 
		ELSE p.DLVSALESORDERLINEORDERLINE
	END AS ORDERLINE
	FROM PRODUCTIONDEMAND p 
	WHERE p.CODE ='$row1[nodemand]'");
        $rowdb2 = db2_fetch_assoc($qDemand);
        $q_actual_delivery      = db2_exec($conn1, "SELECT
        COALESCE(s2.CONFIRMEDDELIVERYDATE, s.CONFIRMEDDUEDATE) AS ACTUAL_DELIVERY
    FROM
        SALESORDER s 
    LEFT JOIN SALESORDERDELIVERY s2 ON s2.SALESORDERLINESALESORDERCODE = s.CODE AND s2.SALORDLINESALORDERCOMPANYCODE = s.COMPANYCODE AND s2.SALORDLINESALORDERCOUNTERCODE = s.COUNTERCODE 
    WHERE
        s2.SALESORDERLINESALESORDERCODE = '$rowdb2[SALESORDERCODE]'
        AND s2.SALESORDERLINEORDERLINE = '$rowdb2[ORDERLINE]'");
$row_actual_delivery    = db2_fetch_assoc($q_actual_delivery);
echo $row_actual_delivery['ACTUAL_DELIVERY'];?></td>	
        
          </tr>
		  
		  <?php  } ?>
		  
		  
		  
		  
          <?php	$no++;  } } ?>
        </tbody>
      </table>
	  
	  
	  
	  
	  
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
<div id="StsAksiEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>			
<div id="StsAksiPPCEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>			
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