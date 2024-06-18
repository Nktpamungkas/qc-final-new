<?PHP
ini_set("error_reporting", 1);
set_time_limit(0);
session_start();
include"koneksi.php";

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
//$sts_pbon = isset($_POST['sts_pbon']) ? $_POST['sts_pbon'] : '';		
	
if($_POST['gshift']=="ALL"){$shft=" ";}else{$shft=" AND b.g_shift = '$GShift' ";}	

function suratJalan($prodOrder, $po) {
  global $conn1;

  $sqlDB2 = "SELECT
              SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE AS SJ,
              CASE
                WHEN SALESDOCUMENT.GOODSISSUEDATE IS NULL THEN SALESDOCUMENT.PROVISIONALDOCUMENTDATE
                  ELSE SALESDOCUMENT.GOODSISSUEDATE
                END AS TGL_KIRIM
            FROM
              SALESDOCUMENTLINE SALESDOCUMENTLINE
            LEFT JOIN ALLOCATION ALLOCATION ON SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE = ALLOCATION.ORDERCODE AND SALESDOCUMENTLINE.ORDERLINE = ALLOCATION.ORDERLINE 
            LEFT JOIN SALESDOCUMENT SALESDOCUMENT ON SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE = SALESDOCUMENT.PROVISIONALCODE 
            LEFT JOIN SALESORDER SALESORDER ON SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE = SALESORDER.CODE 
            LEFT JOIN SALESORDERLINE SALESORDERLINE ON SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE = SALESORDERLINE.SALESORDERCODE AND SALESDOCUMENTLINE.DLVSALESORDERLINEORDERLINE = SALESORDERLINE.ORDERLINE
            LEFT JOIN (
              SELECT
                ALLOCATION.CODE,
                ALLOCATION.LOTCODE,
                COUNT(ALLOCATION.ITEMELEMENTCODE) AS ROLL,
                SUM(ALLOCATION.USERPRIMARYQUANTITY) AS USERPRIMARYQUANTITY,
                ALLOCATION.USERPRIMARYUOMCODE,
                SUM(ALLOCATION.USERSECONDARYQUANTITY) AS USERSECONDARYQUANTITY,
                ALLOCATION.USERSECONDARYUOMCODE
              FROM
                ALLOCATION ALLOCATION
              WHERE
                ALLOCATION.DETAILTYPE = '0'
              GROUP BY
                ALLOCATION.CODE,
                ALLOCATION.LOTCODE,
                ALLOCATION.USERPRIMARYUOMCODE,
                ALLOCATION.USERSECONDARYUOMCODE
              ) A ON ALLOCATION.CODE = A.CODE 
            WHERE
              A.LOTCODE = '$prodOrder' 
              AND (SALESORDER.EXTERNALREFERENCE LIKE '%$po%' OR SALESORDERLINE.EXTERNALREFERENCE LIKE '%$po%')
            GROUP BY
              SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE,
              A.LOTCODE,
              SALESDOCUMENT.PROVISIONALDOCUMENTDATE,
              SALESDOCUMENT.GOODSISSUEDATE
            LIMIT 1";

  $stmt=db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
  $row1=db2_fetch_assoc($stmt);

  return $row1;
}
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
        <div class="col-sm-3">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="awal" type="date" class="form-control pull-right" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off"/>
          </div>
        </div>
        <div class="col-sm-3">
            <input name="order" type="text" class="form-control pull-right" id="order" placeholder="No Order" value="<?php echo $Order;  ?>" autocomplete="off"/>
          </div>
        <div class="col-sm-3">
            <input name="hanger" type="text" class="form-control pull-right" id="hanger" placeholder="No Hanger" value="<?php echo $Hanger;  ?>" autocomplete="off"/>
          </div>
          <div class="col-sm-3">
            <input name="warna" type="text" class="form-control pull-right" id="warna" placeholder="Warna" value="<?php echo $Warna;  ?>" autocomplete="off"/>
          </div>
        <!-- /.input group -->
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="akhir" type="date" class="form-control pull-right" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" autocomplete="off"/>
          </div>
        </div>
        <div class="col-sm-3">
            <input name="po" type="text" class="form-control pull-right" id="po" placeholder="No PO" value="<?php echo $PO;  ?>" autocomplete="off"/>
          </div>
       
        <div class="col-sm-3">
            <input name="item" type="text" class="form-control pull-right" id="item" placeholder="No Item" value="<?php echo $Item;  ?>" autocomplete="off"/>
          </div>
          <div class="col-sm-3">
            <input name="pelanggan" type="text" class="form-control pull-right" id="pelanggan" placeholder="Pelanggan" value="<?php echo $Pelanggan;  ?>" autocomplete="off"/>
          </div>
        <!-- /.input group -->
      </div>
	  <div class="form-group">
       
        
        <!--<div class="col-sm-2">
            <input name="langganan" type="text" class="form-control pull-right" id="langganan" placeholder="Langganan/Buyer" value="<?php echo $Langganan;  ?>" autocomplete="off"/>
          </div>-->
        <!-- <div class="col-sm-2">
            <select name="langganan" class="form-control select2">
            <option value="">Pilih</option> 
            <?php  /*
            $sql=sqlsrv_query($conn,"select distinct partnername from partners where Status<>'2'");
            while($r=sqlsrv_fetch_array($sql)){
            ?>
              <option value="<?php echo $r['partnername'];?>" <?php if($Langganan==$r['partnername']){ echo "SELECTED";}?>><?php echo $r['partnername'];?></option>
            <?php }  */ ?> 
            </select>
        </div> -->
        <!-- /.input group -->
      </div>
      <!-- <div class="form-group">
            <div class="col-sm-2">
                <select name="prosesmkt" class="form-control select2">
                  <option value="">Pilih</option> 
                	<option value="Proses" <?php if($Proses=="Proses"){ echo "SELECTED";}?>>Proses</option>
                	<option value="Hold" <?php if($Proses=="Hold"){ echo "SELECTED";}?>>Hold</option>
                	<option value="Tidak Proses" <?php if($Proses=="Tidak Proses"){ echo "SELECTED";}?>>Tidak Proses</option>
                  <option value="Siapkan Greig" <?php if($Proses=="Siapkan Greig"){ echo "SELECTED";}?>>Siapkan Greig</option>
                </select>
            </div>			 
        </div>
        <div class="form-group">
          <label for="sts_tembakdok" class="col-sm-0 control-label"></label>		  
            <div class="col-sm-3">
              <input type="checkbox" name="sts_tembakdok" id="sts_tembakdok" value="1" <?php  if($sts_tembakdok=="1"){ echo "checked";} ?>>  
              <label> Tembak Dokumen</label>
            </div>		  	
		  </div> -->
    <!--<div class="form-group">
		  <label for="sts_pbon" class="col-sm-0 control-label"></label>		  
        <div class="col-sm-3">
        <input type="checkbox" name="sts_pbon" id="sts_pbon" value="1" <?php  if($sts_pbon=="1"){ echo "checked";} ?>>  
        <label> Bon Penghubung</label>
          
        </div>		  	
		</div>-->	
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
			  <th  rowspan=2><div align="center" valign="middle">CUSTOMER</div></th>
			  <th  rowspan=2><div align="center" valign="middle">BUYER</div></th>
			  <th  rowspan=2><div align="center" valign="middle">PO</div></th>
			  <th  rowspan=2><div align="center" valign="middle">ORDER</div></th>
			   <th  rowspan=2><div align="center" valign="middle">HANGER</div></th>
			   <th  rowspan=2><div align="center" valign="middle">ITEM</div></th>
			   <th  rowspan=2><div align="center" valign="middle">COLOR</div></th>
			   <th  rowspan=2><div align="center" valign="middle">LOT</div></th>
         <th  rowspan=2><div align="center" valign="middle">DEMAND</div></th>
			   
			   <th colspan=3 ><div align="center" valign="middle">QTY</div></th>
         <th colspan=2 ><div align="center" valign="middle">QTY FOC</div></th>
         <th colspan=2 ><div align="center" valign="middle">QTY SISA</div></th>
			   <th  rowspan=2><div align="center" valign="middle">ISSUE</div></th>
			   <th  rowspan=2><div align="center" valign="middle">NOTES</div></th>
			   <th  rowspan=2><div align="center" valign="middle">ADVICE FROM PRODUCTION/QC</div></th>
			   <th  rowspan=2><div align="center" valign="middle">RESPONSIBILITY</div></th>

         <th colspan=3 ><div align="center" valign="middle">QTY KIRIM</div></th>

         <!-- <th rowspan="2"><div align="center" valign="middle">Tanggal Surat Jalan</div></th>
         <th rowspan="2"><div align="center" valign="middle">Nomor Surat Jalan</div></th> -->

      </tr>
			<tr>  
              
			    <th><div align="center" valign="middle">ROLL</div></th>
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>

        <!-- <th><div align="center" valign="middle">ROLL</div></th> -->
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>

        <th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>

        <th><div align="center" valign="middle">ROLL</div></th>
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>
				
				
				
            </tr>
         
          </thead>
          <tbody>
          <?php
            $no=1;
            if($Awal!=""){ $Where =" AND DATE_FORMAT( tgl_masuk, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; }
            if($sts_tembakdok=="1"){ $Sts =" AND sts_tembakdok='1' "; }
            if($Proses!=""){ $prs=" AND sts_aksi='$Proses' ";}else{$prs=" ";}
            if($Awal!="" or $Order!="" or $Warna!="" or $Hanger!="" or $Item!="" or $PO!="" or $Pelanggan!=""){
				$sql_code = "SELECT  tq.*, tli.qty_loss AS qty_sisa, tli.satuan AS satuan_sisa FROM tbl_qcf tq 
                      LEFT JOIN tbl_lap_inspeksi tli ON tq.nodemand = tli.nodemand and tq.no_order = tli.no_order 
                      WHERE tq.sts_pbon!='10' AND tq.no_order LIKE '%$Order%' AND tq.no_po LIKE '%$PO%' AND tq.no_hanger LIKE '%$Hanger%' AND tq.no_item LIKE '%$Item%' AND tq.warna LIKE '%$Warna%' AND tq.pelanggan LIKE '%$Pelanggan%' $Where $prs $Sts AND (tq.penghubung_masalah !='' or tq.penghubung_keterangan !='' or tq.penghubung_roll1 !='' or tq.penghubung_roll2 !='' or tq.penghubung_roll3 !=''  or tq.penghubung_dep !='' or tq.penghubung_dep_persen !='') 
                      GROUP BY tq.no_order, tq.no_po, tq.no_hanger, tq.no_item, tq.warna, tq.pelanggan, tq.tgl_masuk";
                $sql=mysqli_query($con,$sql_code);
            }else{
				$sql_code = "SELECT  tq.*, tli.qty_loss AS qty_sisa, tli.satuan AS satuan_sisa FROM tbl_qcf tq 
                    LEFT JOIN tbl_lap_inspeksi tli ON tq.nodemand = tli.nodemand and tq.no_order = tli.no_order 
                    WHERE tq.sts_pbon!='10' AND tq.no_order LIKE '$Order' AND tq.no_po LIKE '$PO' AND tq.no_hanger LIKE '$Hanger%' AND tq.no_item LIKE '$Item' AND tq.warna LIKE '$Warna' AND tq.pelanggan LIKE '$Pelanggan' $Where $prs $Sts AND (tq.penghubung_masalah !='' or tq.penghubung_keterangan !='' or tq.penghubung_roll1 !='' or tq.penghubung_roll2 !='' or tq.penghubung_roll3 !=''  or tq.penghubung_dep !='' or tq.penghubung_dep_persen !='')  
                    GROUP BY tq.no_order, tq.no_po, tq.no_hanger, tq.no_item, tq.warna, tq.pelanggan, tq.tgl_masuk";
                $sql=mysqli_query($con,$sql_code);
            }
			/*
			echo '<pre>';
					print_r($sql_code);
				  echo '</pre>'; */
				  ?>
          <div style="display: flex; justify-content: end">
              <form action="pages/cetak/cetak_newbonpenghubung_mkt.php" method="POST" target="_blank">
                <input type="hidden" name="sql" value="<?= $sql_code ?>">
                <input type="submit" value="CETAK EXCEL TO MKT">
              </form>
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
			<td align="center"><?php echo explode('/', $row1['pelanggan'])[0];?></td>
			<td align="center"><?php echo explode('/', $row1['pelanggan'])[1];?></td>
			 <td align="center"><?php echo $row1['no_po'];?></td>
			 <td align="center"><?php echo $row1['no_order'];?></td>
			 <td align="center"><?php echo $row1['no_hanger'];?></td>
			  <td align="center"><?php echo $row1['no_item'];?></td>
			  <td align="center"><?php echo $row1['warna'];?></td>
			  <td align="center"><?php echo $row1['lot'];?></td>
        <td align="center"><?php echo $row1['nodemand'];?></td>
			  <td align="center"><?php echo $row1['penghubung_roll1'];?></td>
			  <td align="center"><?php echo $row1['penghubung_roll2'];?></td>
			  <td align="center"><?php echo $row1['penghubung_roll3'];?></td>

        <!-- Tambahan -->
        <td align="center"><?php echo $row1['berat_extra'];?></td>
			  <td align="center"><?php echo $row1['panjang_extra'];?></td>
			  <!-- <td align="center"><?php echo $row1['penghubung_foc3'];?></td> -->

        <!-- Nanti ganti -->
        <td align="center"><?php echo $row1['qty_sisa'];?></td>
			  <td align="center"><?php echo $row1['satuan_sisa'];?></td>

			   <td align="center"><?php echo $row1['penghubung_masalah'];?></td>
			    <td align="center"><?php echo $row1['penghubung_keterangan'];?></td>
			    <td align="center"><?php echo $row1['advice1'];?></td>
				<td align="center">
				<?php if ($row1['penghubung_dep'] !='') {
						$arrayA = explode(',', $row1['penghubung_dep']);
						$no_depp = 1;
						foreach ($arrayA as $key=>$element) {			
							if (array_key_exists($key,$array_persen ?? [] )) {
								
								if ($no_depp >=2) {
									echo ',';
								}
								
								echo $element.' ' ;
								echo $array_persen [$key];
								
								
								echo ' ';
								
							}  
						$no_depp++;
						}
				  }   ?>
				</td>	 
                <!-- // QTY KIRIM UNTUK YANG FOC -->
        <?php
            $q_ket_foc  = db2_exec($conn1, "SELECT 
                                                COUNT(QUALITYREASONCODE) AS ROLL,
                                                SUM(FOC_KG) AS KG,
                                                SUM(FOC_YARDMETER) AS YARD_MTR,
                                                KET_YARDMETER
                                            FROM
                                                ITXVIEW_SURATJALAN_EXIM2A
                                            WHERE 
                                                QUALITYREASONCODE = 'FOC'
                                                AND PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]'
                                            GROUP BY 
                                                KET_YARDMETER");
            $d_ket_foc  = db2_fetch_assoc($q_ket_foc);
        ?>
        <td><?= number_format($d_ket_foc['KG'], 2); ?></td> 
        <td><?= number_format($d_ket_foc['YARD_MTR'], 2); ?></td> 



        <!-- // QTY KIRIM UNTUK YANG BUKAN FOC -->
        <?php
            if($rowdb2['CODE'] == 'EXPORT'){
                // <!-- UNTUK YANG EXPORT -->
                $q_roll     = db2_exec($conn1, "SELECT
                                                    ise.ITEMTYPEAFICODE,
                                                    COUNT(ise.COUNTROLL) AS ROLL,
                                                    SUM(ise.QTY_KG) AS QTY_SJ_KG,
                                                    SUM(ise.QTY_YARDMETER) AS QTY_SJ_YARD,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM
                                                FROM
                                                    ITXVIEW_SURATJALAN_EXIM2A ise 
                                                LEFT JOIN ITXVIEW_NO_PROJECTS_EXIM inpe ON inpe.PROVISIONALCODE = ise.PROVISIONALCODE 
                                                WHERE 
                                                    ise.PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]' AND ise.ITEMTYPEAFICODE = '$rowdb2[ITEMTYPEAFICODE]'
                                                GROUP BY 
                                                    ise.ITEMTYPEAFICODE,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM");
                $d_roll     = db2_fetch_assoc($q_roll);
                if($d_ket_foc['ROLL'] > 0 AND $d_ket_foc['KG'] > 0 AND $d_ket_foc['YARD_MTR'] > 0) { // MENGHITUNG JIKA FOC SEBAGIAN, MAKA ROLL UNTUK FOC DIPISAH DARI KESELURUHAN
                    echo $d_roll['ROLL'] - $d_ket_foc['ROLL'];
                }else{
                    echo $d_roll['ROLL'];
                }
            }else{
                // <!-- UNTUK YANG LOCAL -->
                $q_roll     = db2_exec($conn1, "SELECT COUNT(CODE) AS ROLL,
                                                        SUM(BASEPRIMARYQUANTITY) AS QTY_SJ_KG,
                                                        SUM(BASESECONDARYQUANTITY) AS QTY_SJ_YARD,
                                                        LOTCODE
                                                FROM 
                                                    ITXVIEWALLOCATION0 
                                                WHERE 
                                                    CODE = '$rowdb2[CODE]' AND LOTCODE = '$rowdb2[LOTCODE]'
                                                GROUP BY 
                                                    LOTCODE");
                $d_roll     = db2_fetch_assoc($q_roll);
                echo $d_roll['ROLL'];
            }
        ?>
        <td><?= number_format($d_roll['QTY_SJ_KG'], 2); ?></td>
        <!-- <td><?= $sj['TGL_KIRIM'] ?></td>
        <td><?= $sj['SJ'] ?></td> -->
          </tr>
		  
		  <?php if($row1['penghubung2_roll1'] and  $row1['penghubung2_roll1'] !='')  
		  {  
		  ?>
		  
		  
		  <tr bgcolor="<?php echo $bgcolor; ?>">
        <td align="center"><?php echo $row1['tgl_masuk'];?></td>
        <td align="center"><?php echo explode('/', $row1['pelanggan'])[0];?></td>
        <td align="center"><?php echo explode('/', $row1['pelanggan'])[1];?></td>
        <td align="center"><?php echo $row1['no_po'];?></td>
        <td align="center"><?php echo $row1['no_order'];?></td>
        <td align="center"><?php echo $row1['no_hanger'];?></td>
			  <td align="center"><?php echo $row1['no_item'];?></td>
			  <td align="center"><?php echo $row1['warna'];?></td>
			  <td align="center"><?php echo $row1['lot'];?></td>
        <td align="center"><?php echo $row1['nodemand'];?></td>
			  <td align="center"><?php echo $row1['penghubung2_roll1'];?></td>
			  <td align="center"><?php echo $row1['penghubung2_roll2'];?></td>
			  <td align="center"><?php echo $row1['penghubung2_roll3'];?></td>

     <!-- Tambahan -->
     <!-- <td align="center"><?php echo $row1['berat_extra'];?></td> -->
     <!-- <td align="center"><?php echo $row1['panjang_extra'];?></td> -->
     <td align="center"></td>
     <td align="center"></td>
			  
			  <!-- <td align="center"><?php echo $row1['penghubung_foc3'];?></td> -->

        <!-- Nanti ganti -->
        <!-- <td align="center"><?php echo $row1['qty_sisa'];?></td>
			  <td align="center"><?php echo $row1['satuan_sisa'];?></td> -->
        <td align="center"></td>
        <td align="center"></td>

			   <td align="center"><?php echo $row1['penghubung2_masalah'];?></td>
			    <td align="center"><?php echo $row1['penghubung2_keterangan'];?></td>
			    <td align="center"><?php echo $row1['advice2'];?></td>
				<td align="center">
				<?php if ($row1['penghubung2_dep'] !='') {
						$arrayA = explode(',', $row1['penghubung2_dep']);
						$no_depp = 1;
						foreach ($arrayA as $key=>$element) {			
							if (array_key_exists($key,$array_persen )) {
								
								if ($no_depp >=2) {
									echo ',';
								}
								
								echo $element.' ' ;
								echo $array_persen [$key];
								
								
								echo ' ';
								
							}
						$no_depp++;
						}
				  }   ?>
				</td>	
        
                   <!-- // QTY KIRIM UNTUK YANG FOC -->
                   <?php
            $q_ket_foc  = db2_exec($conn1, "SELECT 
                                                COUNT(QUALITYREASONCODE) AS ROLL,
                                                SUM(FOC_KG) AS KG,
                                                SUM(FOC_YARDMETER) AS YARD_MTR,
                                                KET_YARDMETER
                                            FROM
                                                ITXVIEW_SURATJALAN_EXIM2A
                                            WHERE 
                                                QUALITYREASONCODE = 'FOC'
                                                AND PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]'
                                            GROUP BY 
                                                KET_YARDMETER");
            $d_ket_foc  = db2_fetch_assoc($q_ket_foc);
        ?>
        <td><?= number_format($d_ket_foc['KG'], 2); ?></td> 
        <td><?= number_format($d_ket_foc['YARD_MTR'], 2); ?></td> 
                
                
                
        <!-- // QTY KIRIM UNTUK YANG BUKAN FOC -->
        <?php
            if($rowdb2['CODE'] == 'EXPORT'){
                // <!-- UNTUK YANG EXPORT -->
                $q_roll     = db2_exec($conn1, "SELECT
                                                    ise.ITEMTYPEAFICODE,
                                                    COUNT(ise.COUNTROLL) AS ROLL,
                                                    SUM(ise.QTY_KG) AS QTY_SJ_KG,
                                                    SUM(ise.QTY_YARDMETER) AS QTY_SJ_YARD,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM
                                                FROM
                                                    ITXVIEW_SURATJALAN_EXIM2A ise 
                                                LEFT JOIN ITXVIEW_NO_PROJECTS_EXIM inpe ON inpe.PROVISIONALCODE = ise.PROVISIONALCODE 
                                                WHERE 
                                                    ise.PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]' AND ise.ITEMTYPEAFICODE = '$rowdb2[ITEMTYPEAFICODE]'
                                                GROUP BY 
                                                    ise.ITEMTYPEAFICODE,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM");
                $d_roll     = db2_fetch_assoc($q_roll);
                if($d_ket_foc['ROLL'] > 0 AND $d_ket_foc['KG'] > 0 AND $d_ket_foc['YARD_MTR'] > 0) { // MENGHITUNG JIKA FOC SEBAGIAN, MAKA ROLL UNTUK FOC DIPISAH DARI KESELURUHAN
                    echo $d_roll['ROLL'] - $d_ket_foc['ROLL'];
                }else{
                    echo $d_roll['ROLL'];
                }
            }else{
                // <!-- UNTUK YANG LOCAL -->
                $q_roll     = db2_exec($conn1, "SELECT COUNT(CODE) AS ROLL,
                                                        SUM(BASEPRIMARYQUANTITY) AS QTY_SJ_KG,
                                                        SUM(BASESECONDARYQUANTITY) AS QTY_SJ_YARD,
                                                        LOTCODE
                                                FROM 
                                                    ITXVIEWALLOCATION0 
                                                WHERE 
                                                    CODE = '$rowdb2[CODE]' AND LOTCODE = '$rowdb2[LOTCODE]'
                                                GROUP BY 
                                                    LOTCODE");
                $d_roll     = db2_fetch_assoc($q_roll);
                echo $d_roll['ROLL'];
            }
        ?>
        <td><?= number_format($d_roll['QTY_SJ_KG'], 2); ?></td>
        <!-- <td></td>
        <td></td> -->
          </tr>
		  
		  
		  <?php  } ?>
		  
		  
		   <?php if($row1['penghubung3_roll1'] and  $row1['penghubung3_roll1'] !='')  
		  {  
		  ?>
		  
		  
		   <tr bgcolor="<?php echo $bgcolor; ?>">
        <td align="center"><?php echo $row1['tgl_masuk'];?></td>
        <td align="center"><?php echo explode('/', $row1['pelanggan'])[0];?></td>
        <td align="center"><?php echo explode('/', $row1['pelanggan'])[1];?></td>
        <td align="center"><?php echo $row1['no_po'];?></td>
        <td align="center"><?php echo $row1['no_order'];?></td>
        <td align="center"><?php echo $row1['no_hanger'];?></td>
			  <td align="center"><?php echo $row1['no_item'];?></td>
			  <td align="center"><?php echo $row1['warna'];?></td>
			  <td align="center"><?php echo $row1['lot'];?></td>
			  <td align="center"><?php echo $row1['nodemand'];?></td>
			  <td align="center"><?php echo $row1['penghubung3_roll1'];?></td>
			  <td align="center"><?php echo $row1['penghubung3_roll2'];?></td>
			  <td align="center"><?php echo $row1['penghubung3_roll3'];?></td>
       <!-- Tambahan -->
       <!-- <td align="center"><?php echo $row1['berat_extra'];?></td> -->
     <!-- <td align="center"><?php echo $row1['panjang_extra'];?></td> -->
     <td align="center"></td>
     <td align="center"></td>
			  <!-- <td align="center"><?php echo $row1['penghubung_foc3'];?></td> -->

        <!-- Nanti ganti -->
        <!-- <td align="center"><?php echo $row1['qty_sisa'];?></td>
			  <td align="center"><?php echo $row1['satuan_sisa'];?></td> -->
        <td align="center"></td>
        <td align="center"></td>
        
			   <td align="center"><?php echo $row1['penghubung3_masalah'];?></td>
			    <td align="center"><?php echo $row1['penghubung3_keterangan'];?></td>
			    <td align="center"><?php echo $row1['advice3'];?></td>
				<td align="center">
				<?php if ($row1['penghubung3_dep'] !='') {
						$arrayA = explode(',', $row1['penghubung3_dep']);
						$no_depp = 1;
						foreach ($arrayA as $key=>$element) {			
							if (array_key_exists($key,$array_persen )) {
								
								if ($no_depp >=2) {
									echo ',';
								}
								
								echo $element.' ' ;
								echo $array_persen [$key];
								
								
								echo ' ';
								
							}
						$no_depp++;
						}
				  }   ?>
				</td>	 	
        
                   <!-- // QTY KIRIM UNTUK YANG FOC -->
                   <?php
            $q_ket_foc  = db2_exec($conn1, "SELECT 
                                                COUNT(QUALITYREASONCODE) AS ROLL,
                                                SUM(FOC_KG) AS KG,
                                                SUM(FOC_YARDMETER) AS YARD_MTR,
                                                KET_YARDMETER
                                            FROM
                                                ITXVIEW_SURATJALAN_EXIM2A
                                            WHERE 
                                                QUALITYREASONCODE = 'FOC'
                                                AND PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]'
                                            GROUP BY 
                                                KET_YARDMETER");
            $d_ket_foc  = db2_fetch_assoc($q_ket_foc);
        ?>
        <td><?= number_format($d_ket_foc['KG'], 2); ?></td> 
        <td><?= number_format($d_ket_foc['YARD_MTR'], 2); ?></td> 
                
                
                
        <!-- // QTY KIRIM UNTUK YANG BUKAN FOC -->
        <?php
            if($rowdb2['CODE'] == 'EXPORT'){
                // <!-- UNTUK YANG EXPORT -->
                $q_roll     = db2_exec($conn1, "SELECT
                                                    ise.ITEMTYPEAFICODE,
                                                    COUNT(ise.COUNTROLL) AS ROLL,
                                                    SUM(ise.QTY_KG) AS QTY_SJ_KG,
                                                    SUM(ise.QTY_YARDMETER) AS QTY_SJ_YARD,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM
                                                FROM
                                                    ITXVIEW_SURATJALAN_EXIM2A ise 
                                                LEFT JOIN ITXVIEW_NO_PROJECTS_EXIM inpe ON inpe.PROVISIONALCODE = ise.PROVISIONALCODE 
                                                WHERE 
                                                    ise.PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]' AND ise.ITEMTYPEAFICODE = '$rowdb2[ITEMTYPEAFICODE]'
                                                GROUP BY 
                                                    ise.ITEMTYPEAFICODE,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM");
                $d_roll     = db2_fetch_assoc($q_roll);
                if($d_ket_foc['ROLL'] > 0 AND $d_ket_foc['KG'] > 0 AND $d_ket_foc['YARD_MTR'] > 0) { // MENGHITUNG JIKA FOC SEBAGIAN, MAKA ROLL UNTUK FOC DIPISAH DARI KESELURUHAN
                    echo $d_roll['ROLL'] - $d_ket_foc['ROLL'];
                }else{
                    echo $d_roll['ROLL'];
                }
            }else{
                // <!-- UNTUK YANG LOCAL -->
                $q_roll     = db2_exec($conn1, "SELECT COUNT(CODE) AS ROLL,
                                                        SUM(BASEPRIMARYQUANTITY) AS QTY_SJ_KG,
                                                        SUM(BASESECONDARYQUANTITY) AS QTY_SJ_YARD,
                                                        LOTCODE
                                                FROM 
                                                    ITXVIEWALLOCATION0 
                                                WHERE 
                                                    CODE = '$rowdb2[CODE]' AND LOTCODE = '$rowdb2[LOTCODE]'
                                                GROUP BY 
                                                    LOTCODE");
                $d_roll     = db2_fetch_assoc($q_roll);
                echo $d_roll['ROLL'];
            }
        ?>
        <td><?= number_format($d_roll['QTY_SJ_KG'], 2); ?></td>
        <!-- <td></td>
        <td></td> -->
          </tr>
		  
		  <?php  } ?>
		  
		  
		  
		  
          <?php	$no++;  } ?>
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