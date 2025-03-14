<script>
function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}	
function angka(e) {
   if (!/^[0-9 .]+$/.test(e.value)) {
      e.value = e.value.substring(0,e.value.length-1);
   }
}	
</script>
<?php
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";
function nourut(){
include"koneksi.php";
$format = date("ymd");
$sql=mysqli_query($con,"SELECT nokk FROM tbl_schedule WHERE substr(nokk,1,6) like '%".$format."%' ORDER BY nokk DESC LIMIT 1 ") or die (mysqli_error());
$d=mysqli_num_rows($sql);
if($d>0){
$r=mysqli_fetch_array($sql);
$d=$r['nokk'];
$str=substr($d,6,2);
$Urut = (int)$str;
}else{
$Urut = 0;
}
$Urut = $Urut + 1;
$Nol="";
$nilai=2-strlen($Urut);
for ($i=1;$i<=$nilai;$i++){
$Nol= $Nol."0";
}
$nipbr =$format.$Nol.$Urut;
return $nipbr;
}
$nou=nourut();
$nodemand=$_GET['nodemand'];
$operation=$_GET['operation'];
$sqlDB2="SELECT
	A.CODE AS DEMANDNO,
	TRIM(B.PRODUCTIONORDERCODE) AS PRODUCTIONORDERCODE,
	TRIM(E.LEGALNAME1) AS LEGALNAME1,
	TRIM(C.ORDERPARTNERBRANDCODE) AS ORDERPARTNERBRANDCODE,
	TRIM(C.BUYER) AS BUYER,
	TRIM(C.SALESORDERCODE) AS SALESORDERCODE,
	TRIM(C.ITEMDESCRIPTION) AS ITEMDESCRIPTION,
	TRIM(A.SUBCODE05) AS NO_WARNA,
	TRIM(F.WARNA) AS WARNA,
	TRIM(A.SUBCODE01) AS SUBCODE01,
	TRIM(A.SUBCODE02) AS SUBCODE02,
	TRIM(A.SUBCODE03) AS SUBCODE03,
	TRIM(A.SUBCODE04) AS SUBCODE04,
	TRIM(A.SUBCODE05) AS SUBCODE05,
	TRIM(A.SUBCODE06) AS SUBCODE06,
	TRIM(A.SUBCODE07) AS SUBCODE07,
	TRIM(A.SUBCODE08) AS SUBCODE08,
	TRIM(A.SUBCODE09) AS SUBCODE09,
	TRIM(A.SUBCODE10) AS SUBCODE10,
	TRIM(C.EXTERNALITEMCODE) AS NO_ITEM,
	TRIM(C.PO_NUMBER) AS PO_NUMBER,
	TRIM(C.INTERNALREFERENCE) AS INTERNALREFERENCE,
	A.BASEPRIMARYQUANTITY AS QTY_NETTO,
	TRIM(A.BASEPRIMARYUOMCODE) AS BASEPRIMARYUOMCODE,
	A.BASESECONDARYQUANTITY AS QTY_NETTO_YARD,
	TRIM(A.BASESECONDARYUOMCODE) AS BASESECONDARYUOMCODE,
	C.QTY_ORDER,
	TRIM(C.QTY_ORDER_UOM) AS QTY_ORDER_UOM,
	C.QTY_PANJANG_ORDER,
	TRIM(C.QTY_PANJANG_ORDER_UOM) AS QTY_PANJANG_ORDER_UOM,
	G.USEDBASEPRIMARYQUANTITY AS QTY_BAGI_KAIN,
	C.DELIVERYDATE,
	D.NAMENAME,
	D.VALUEDECIMAL
FROM
	PRODUCTIONDEMAND A
LEFT JOIN 
	(
	SELECT
		PRODUCTIONDEMANDSTEP.PRODUCTIONORDERCODE,
		PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE
	FROM
		PRODUCTIONDEMANDSTEP PRODUCTIONDEMANDSTEP
	GROUP BY
		PRODUCTIONDEMANDSTEP.PRODUCTIONORDERCODE,
		PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE) B
ON
	A.CODE = B.PRODUCTIONDEMANDCODE
LEFT JOIN 
	(
	SELECT
		SALESORDER.ORDERPARTNERBRANDCODE,
		SALESORDERLINE.SALESORDERCODE,
		SALESORDERLINE.ORDERLINE,
		SALESORDERLINE.ITEMDESCRIPTION,
		SALESORDERLINE.SUBCODE03,
		SALESORDERLINE.SUBCODE05,
		SALESORDERLINE.BASEPRIMARYUOMCODE AS QTY_ORDER_UOM,
		CASE
			WHEN SALESORDER.EXTERNALREFERENCE IS NULL THEN SALESORDERLINE.EXTERNALREFERENCE
			ELSE SALESORDER.EXTERNALREFERENCE
		END AS PO_NUMBER,
		SALESORDERLINE.INTERNALREFERENCE,
		SUM(SALESORDERLINE.BASEPRIMARYQUANTITY) AS QTY_ORDER,
		SUM(SALESORDERLINE.BASESECONDARYQUANTITY) AS QTY_PANJANG_ORDER,
		SALESORDERLINE.BASESECONDARYUOMCODE AS QTY_PANJANG_ORDER_UOM,
		SALESORDERDELIVERY.DELIVERYDATE,
		ITXVIEWORDERITEMLINKACTIVE.EXTERNALITEMCODE,
		ORDERPARTNERBRAND.LONGDESCRIPTION AS BUYER
	FROM
		SALESORDER SALESORDER
	LEFT JOIN SALESORDERLINE SALESORDERLINE ON
		SALESORDER.CODE = SALESORDERLINE.SALESORDERCODE
	LEFT JOIN SALESORDERDELIVERY SALESORDERDELIVERY ON
		SALESORDERLINE.SALESORDERCODE = SALESORDERDELIVERY.SALESORDERLINESALESORDERCODE
		AND SALESORDERLINE.ORDERLINE = SALESORDERDELIVERY.SALESORDERLINEORDERLINE
	LEFT JOIN ITXVIEWORDERITEMLINKACTIVE ITXVIEWORDERITEMLINKACTIVE ON
		SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE = ITXVIEWORDERITEMLINKACTIVE.ORDPRNCUSTOMERSUPPLIERCODE
		AND SALESORDERLINE.ITEMTYPEAFICODE = ITXVIEWORDERITEMLINKACTIVE.ITEMTYPEAFICODE
		AND 
	SALESORDERLINE.SUBCODE01 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE01
		AND SALESORDERLINE.SUBCODE02 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE02
		AND SALESORDERLINE.SUBCODE03 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE03
		AND
	SALESORDERLINE.SUBCODE04 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE04
		AND SALESORDERLINE.SUBCODE05 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE05
		AND SALESORDERLINE.SUBCODE06 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE06
		AND 
	SALESORDERLINE.SUBCODE07 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE07
		AND SALESORDERLINE.SUBCODE08 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE08
		AND SALESORDERLINE.SUBCODE09 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE09
		AND 
	SALESORDERLINE.SUBCODE10 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE10
	LEFT JOIN ORDERPARTNERBRAND ORDERPARTNERBRAND ON
		SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE = ORDERPARTNERBRAND.ORDPRNCUSTOMERSUPPLIERCODE
		AND SALESORDER.ORDERPARTNERBRANDCODE = ORDERPARTNERBRAND.CODE
	GROUP BY
		SALESORDER.ORDERPARTNERBRANDCODE,
		SALESORDERLINE.SALESORDERCODE,
		SALESORDERLINE.ORDERLINE,
		SALESORDERLINE.ITEMDESCRIPTION,
		SALESORDERLINE.SUBCODE03,
		SALESORDERLINE.SUBCODE05,
		SALESORDERLINE.BASEPRIMARYUOMCODE,
		SALESORDERLINE.BASESECONDARYUOMCODE,
		SALESORDER.EXTERNALREFERENCE,
		SALESORDERLINE.EXTERNALREFERENCE,
		SALESORDERLINE.INTERNALREFERENCE,
		SALESORDERDELIVERY.DELIVERYDATE,
		ITXVIEWORDERITEMLINKACTIVE.EXTERNALITEMCODE,
		ORDERPARTNERBRAND.LONGDESCRIPTION) C
ON
	A.ORIGDLVSALORDLINESALORDERCODE = C.SALESORDERCODE
	AND A.ORIGDLVSALORDERLINEORDERLINE = C.ORDERLINE
LEFT JOIN
	(
	SELECT
		PRODUCT.SUBCODE01,
		PRODUCT.SUBCODE02,
		PRODUCT.SUBCODE03,
		PRODUCT.SUBCODE04,
		PRODUCT.SUBCODE05,
		PRODUCT.SUBCODE06,
		PRODUCT.SUBCODE07,
		PRODUCT.SUBCODE08,
		PRODUCT.SUBCODE09,
		PRODUCT.SUBCODE10,
		LISTAGG(TRIM(ADSTORAGE.NAMENAME),
		',') WITHIN GROUP(
		ORDER BY ADSTORAGE.NAMENAME ASC) AS NAMENAME,
		LISTAGG(ADSTORAGE.VALUEDECIMAL,
		',') WITHIN GROUP(
		ORDER BY ADSTORAGE.NAMENAME ASC) AS VALUEDECIMAL
	FROM
		PRODUCT PRODUCT
	LEFT JOIN ADSTORAGE ADSTORAGE ON
		PRODUCT.ABSUNIQUEID = ADSTORAGE.UNIQUEID
	GROUP BY
		PRODUCT.SUBCODE01,
		PRODUCT.SUBCODE02,
		PRODUCT.SUBCODE03,
		PRODUCT.SUBCODE04,
		PRODUCT.SUBCODE05,
		PRODUCT.SUBCODE06,
		PRODUCT.SUBCODE07,
		PRODUCT.SUBCODE08,
		PRODUCT.SUBCODE09,
		PRODUCT.SUBCODE10) D
ON
	A.SUBCODE01 = D.SUBCODE01
	AND
A.SUBCODE02 = D.SUBCODE02
	AND
A.SUBCODE03 = D.SUBCODE03
	AND 
A.SUBCODE04 = D.SUBCODE04
	AND
A.SUBCODE05 = D.SUBCODE05
	AND 
A.SUBCODE06 = D.SUBCODE06
	AND 
A.SUBCODE07 = D.SUBCODE07
	AND 
A.SUBCODE08 = D.SUBCODE08
	AND 
A.SUBCODE09 = D.SUBCODE09
	AND 
A.SUBCODE10 = D.SUBCODE10
LEFT JOIN
	(
	SELECT
		BUSINESSPARTNER.LEGALNAME1,
		ORDERPARTNER.CUSTOMERSUPPLIERCODE
	FROM
		BUSINESSPARTNER BUSINESSPARTNER
	LEFT JOIN ORDERPARTNER ORDERPARTNER ON
		BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID) E
ON
	A.CUSTOMERCODE = E.CUSTOMERSUPPLIERCODE
LEFT JOIN (
	SELECT
		ITXVIEWCOLOR.ITEMTYPECODE,
		ITXVIEWCOLOR.SUBCODE01,
		ITXVIEWCOLOR.SUBCODE02,
		ITXVIEWCOLOR.SUBCODE03,
		ITXVIEWCOLOR.SUBCODE04,
		ITXVIEWCOLOR.SUBCODE05,
		ITXVIEWCOLOR.SUBCODE06,
		ITXVIEWCOLOR.SUBCODE07,
		ITXVIEWCOLOR.SUBCODE08,
		ITXVIEWCOLOR.SUBCODE09,
		ITXVIEWCOLOR.SUBCODE10,
		ITXVIEWCOLOR.WARNA
	FROM
		ITXVIEWCOLOR ITXVIEWCOLOR) F ON
	A.ITEMTYPEAFICODE = F.ITEMTYPECODE
	AND 
    A.SUBCODE01 = F.SUBCODE01
	AND 
    A.SUBCODE02 = F.SUBCODE02
	AND 
    A.SUBCODE03 = F.SUBCODE03
	AND 
    A.SUBCODE04 = F.SUBCODE04
	AND 
    A.SUBCODE05 = F.SUBCODE05
	AND 
    A.SUBCODE06 = F.SUBCODE06
	AND 
    A.SUBCODE07 = F.SUBCODE07
	AND 
    A.SUBCODE08 = F.SUBCODE08
	AND 
    A.SUBCODE09 = F.SUBCODE09
	AND 
    A.SUBCODE10 = F.SUBCODE10
LEFT JOIN
	(
	SELECT
		PRODUCTIONRESERVATION.ORDERCODE,
		PRODUCTIONRESERVATION.ITEMTYPEAFICODE,
		SUM(PRODUCTIONRESERVATION.USEDBASEPRIMARYQUANTITY) AS USEDBASEPRIMARYQUANTITY
	FROM
		PRODUCTIONRESERVATION 
	PRODUCTIONRESERVATION
	WHERE
		PRODUCTIONRESERVATION.ITEMTYPEAFICODE = 'KGF'
	GROUP BY
		PRODUCTIONRESERVATION.ORDERCODE,
		PRODUCTIONRESERVATION.ITEMTYPEAFICODE) G
ON
	A.CODE = G.ORDERCODE
WHERE A.CODE='$nodemand'";
$stmt=db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
$rowdb2 = db2_fetch_assoc($stmt);
$ww=explode(",",$rowdb2['NAMENAME']);
$valueww=explode(",",$rowdb2['VALUEDECIMAL']);
//GRAMASI
/*if($ww[0]=="GSM"){ $gramasi=$valueww[0];}
else if($ww[1]=="GSM"){ $gramasi=$valueww[1];}
else if($ww[2]=="GSM"){ $gramasi=$valueww[2];}
else if($ww[3]=="GSM"){ $gramasi=$valueww[3];}
$posg=strpos($gramasi,".");
$valgramasi=substr($gramasi,0,$posg);*/
//WIDTH
/*if($ww[0]=="Width"){ $lebar=$valueww[0];}
else if($ww[1]=="Width"){ $lebar=$valueww[1];}
else if($ww[2]=="Width"){ $lebar=$valueww[2];}
else if($ww[3]=="Width"){ $lebar=$valueww[3];}
$posl=strpos($lebar,".");
$vallebar=substr($lebar,0,$posl);*/

$sqlDB21=" 
SELECT
	PRODUCT.SUBCODE01,
	PRODUCT.SUBCODE02,
	PRODUCT.SUBCODE03,
	PRODUCT.SUBCODE04,
	PRODUCT.SUBCODE05,
	PRODUCT.SUBCODE06,
	PRODUCT.SUBCODE07,
	PRODUCT.SUBCODE08,
	PRODUCT.SUBCODE09,
	PRODUCT.SUBCODE10,  
	SUM(ADSTORAGE.VALUEDECIMAL) AS GSM,
	SUM(ADSTORAGE1.VALUEDECIMAL) AS WIDTH
FROM
	PRODUCT PRODUCT
LEFT JOIN ADSTORAGE ADSTORAGE ON
	PRODUCT.ABSUNIQUEID = ADSTORAGE.UNIQUEID AND ADSTORAGE.NAMENAME='GSM'
LEFT JOIN ADSTORAGE ADSTORAGE1 ON
	PRODUCT.ABSUNIQUEID = ADSTORAGE1.UNIQUEID AND ADSTORAGE1.NAMENAME='Width'	
WHERE 	
	PRODUCT.SUBCODE01='".$rowdb2['SUBCODE01']."' AND
	PRODUCT.SUBCODE02='".$rowdb2['SUBCODE02']."' AND
	PRODUCT.SUBCODE03='".$rowdb2['SUBCODE03']."' AND
	PRODUCT.SUBCODE04='".$rowdb2['SUBCODE04']."' AND
	PRODUCT.SUBCODE05='".$rowdb2['SUBCODE05']."' AND
	PRODUCT.SUBCODE06='".$rowdb2['SUBCODE06']."' AND
	PRODUCT.SUBCODE07='".$rowdb2['SUBCODE07']."' AND
	PRODUCT.SUBCODE08='".$rowdb2['SUBCODE08']."' AND
	PRODUCT.SUBCODE09='".$rowdb2['SUBCODE09']."' AND
	PRODUCT.SUBCODE10='".$rowdb2['SUBCODE10']."'
GROUP BY
	PRODUCT.SUBCODE01,
	PRODUCT.SUBCODE02,
	PRODUCT.SUBCODE03,
	PRODUCT.SUBCODE04,
	PRODUCT.SUBCODE05,
	PRODUCT.SUBCODE06,
	PRODUCT.SUBCODE07,
	PRODUCT.SUBCODE08,
	PRODUCT.SUBCODE09,
	PRODUCT.SUBCODE10
";
$stmt1=db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
$rowdb21 = db2_fetch_assoc($stmt1);

$sqlroll="SELECT 
STOCKTRANSACTION.ORDERCODE,
COUNT(STOCKTRANSACTION.ITEMELEMENTCODE) AS JML_ROLL
FROM STOCKTRANSACTION STOCKTRANSACTION
WHERE STOCKTRANSACTION.ORDERCODE ='$rowdb2[PRODUCTIONORDERCODE]' AND STOCKTRANSACTION.TEMPLATECODE ='120'
AND STOCKTRANSACTION.ITEMTYPECODE ='KGF'
GROUP BY 
STOCKTRANSACTION.ORDERCODE";
$stmt1=db2_exec($conn1,$sqlroll, array('cursor'=>DB2_SCROLLABLE));
$rowr = db2_fetch_assoc($stmt1);

$sqlCek=mysqli_query($con,"SELECT * FROM tbl_schedule WHERE nokk='$nodemand' ORDER BY id DESC LIMIT 1");
$cek=mysqli_num_rows($sqlCek);
$rcek=mysqli_fetch_array($sqlCek);
$sqlCek1=mysqli_query($con,"SELECT * FROM tbl_schedule WHERE nokk='$nodemand' AND not status='selesai' ORDER BY id DESC LIMIT 1");
$cek1=mysqli_num_rows($sqlCek1);

?>	
<?php
$Kapasitas	= isset($_POST['kapasitas']) ? $_POST['kapasitas'] : '';
$TglMasuk	= isset($_POST['tglmsk']) ? $_POST['tglmsk'] : '';
$Item		= isset($_POST['item']) ? $_POST['item'] : '';
$Warna		= isset($_POST['warna']) ? $_POST['warna'] : '';
$Langganan	= isset($_POST['langganan']) ? $_POST['langganan'] : '';
?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1">
 <div class="box box-info">
  	<div class="box-header with-border">
    <h3 class="box-title">Input Data Kartu Kerja</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
 	<div class="box-body"> 
	  <div class="col-md-6">
		<div class="form-group">
                  <label for="nodemand" class="col-sm-3 control-label">No Demand</label>
                  <div class="col-sm-4">
				  <input name="nodemand" type="text" class="form-control" id="nodemand" 
                     onchange="window.location='FormSchedule-'+this.value" value="<?php echo $_GET['nodemand'];?>" placeholder="No Demand" required >
				</div>
		</div>
		<div class="form-group">
                  <label for="nokk" class="col-sm-3 control-label">No Production Order</label>
                  <div class="col-sm-8">
                    <input name="nokk" type="text" class="form-control" id="nokk" 
                    value="<?php if($cek>0){echo $rcek['nokk'];}else{echo $rowdb2['PRODUCTIONORDERCODE'];}?>" placeholder="No Production Order">
                  </div>				   
                </div>
		<div class="form-group">
                  <label for="langganan" class="col-sm-3 control-label">Langganan</label>
                  <div class="col-sm-8">
                    <input name="langganan" type="text" class="form-control" id="langganan" 
                    value="<?php if($cek>0){echo $rcek['langganan'];}else{echo $rowdb2['LEGALNAME1'];}?>" placeholder="Langganan">
                  </div>				   
                </div>
		<div class="form-group">
                  <label for="buyer" class="col-sm-3 control-label">Buyer</label>
                  <div class="col-sm-8">
                    <input name="buyer" type="text" class="form-control" id="buyer" 
                    value="<?php if($cek>0){echo $rcek['buyer'];}else{echo $rowdb2['BUYER'];}?>" placeholder="Buyer">
                  </div>				   
                </div>
	    <div class="form-group">
                  <label for="no_order" class="col-sm-3 control-label">No Order</label>
                  <div class="col-sm-4">
                    <input name="no_order" type="text" class="form-control" id="no_order" 
                    value="<?php if($cek>0){echo $rcek['no_order'];}else{if($rowdb2['SALESORDERCODE']!=""){echo $rowdb2['SALESORDERCODE'];}} ?>" placeholder="No Order">
                  </div>				   
                </div>
	    <div class="form-group">
                  <label for="no_po" class="col-sm-3 control-label">PO</label>
                  <div class="col-sm-5">
                    <input name="no_po" type="text" class="form-control" id="no_po" 
                    value="<?php if($cek>0){echo $rcek['po'];}else{echo $rowdb2['PO_NUMBER'];} ?>" placeholder="PO" >
                  </div>				   
                </div>
		<div class="form-group">
                  <label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
                  <div class="col-sm-3">
                    <input name="no_hanger" type="text" class="form-control" id="no_hanger" 
                    value="<?php if($cek>0){echo $rcek['no_hanger'];}else{if($rowdb2['SUBCODE02']!=""){echo trim($rowdb2['SUBCODE02']).'-'.trim($rowdb2['SUBCODE03']);}}?>" placeholder="No Hanger">  
                  </div>
				  <div class="col-sm-3">
				  <input name="no_item" type="text" class="form-control" id="no_item" 
                    value="<?php if($rcek['no_item']!=""){echo $rcek['no_item'];}else if($rowdb2['NO_ITEM']!=""){echo $rowdb2['NO_ITEM'];}else{ if($rowdb2['SUBCODE02']!=""){echo trim($rowdb2['SUBCODE02']).'-'.trim($rowdb2['SUBCODE03']);} }?>" placeholder="No Item">
				  </div>	
                </div>
	    <div class="form-group">
                  <label for="jns_kain" class="col-sm-3 control-label">Jenis Kain</label>
                  <div class="col-sm-8">
					  <textarea name="jns_kain" class="form-control" id="jns_kain" placeholder="Jenis Kain"><?php if($cek>0){echo $rcek['jenis_kain'];}else{if($rowdb2['ITEMDESCRIPTION']!=""){echo $rowdb2['ITEMDESCRIPTION'];} }?></textarea>
					  </div>
                  </div>
		<div class="form-group">
        <label for="tgl_delivery" class="col-sm-3 control-label">Tgl. Delivery</label>
        <div class="col-sm-4">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="tgl_delivery" type="text" class="form-control pull-right" id="datepicker2" placeholder="0000-00-00" value="<?php if($cek>0){echo $rcek['tgl_delivery'];}else{if($rowdb2['DELIVERYDATE']!=""){echo date('Y-m-d', strtotime($rowdb2['DELIVERYDATE']));}}?>" required/>
          </div>
        </div>
	  </div>
		<div class="form-group">
			  <label for="l_g" class="col-sm-3 control-label">Lebar X Gramasi</label>
			  <div class="col-sm-2">
				<input name="lebar" type="text" class="form-control" id="lebar" 
				value="<?php if($cek>0){echo $rcek['lebar'];}else{echo round($rowdb21['WIDTH']);} ?>" placeholder="0" required>
			  </div>
			  <div class="col-sm-2">
				<input name="grms" type="text" class="form-control" id="grms" 
				value="<?php if($cek>0){echo $rcek['gramasi'];}else{echo round($rowdb21['GSM']);} ?>" placeholder="0" required>
			  </div>		
			</div>
		<div class="form-group">
			  <label for="warna" class="col-sm-3 control-label">Warna</label>
			  <div class="col-sm-8">
				<input name="warna" type="text" class="form-control" id="warna" 
				value="<?php if($cek>0){echo $rcek['warna'];}else{if($rowdb2['WARNA']!=""){echo $rowdb2['WARNA'];} }?>" placeholder="Warna">  
			  </div>				   
			</div>
		    
		
	  </div>
	  		<!-- col --> 
	  <div class="col-md-6">
		 <div class="form-group">
			  <label for="no_warna" class="col-sm-3 control-label">No Warna</label>
			  <div class="col-sm-8">
				<input name="no_warna" type="text" class="form-control" id="no_warna" 
				value="<?php if($cek>0){echo $rcek['no_warna'];}else{if($rowdb2['NO_WARNA']!=""){echo $rowdb2['NO_WARNA'];}}?>" placeholder="No Warna">  
			  </div>				   
			</div> 
		 <div class="form-group">
                  <label for="qty_order" class="col-sm-3 control-label">Qty Order</label>
                  <div class="col-sm-3">
					<div class="input-group">  
                    <input name="qty1" type="text" class="form-control" id="qty1" 
                    value="<?php if($cek>0){echo $rcek['qty_order'];}else{echo round($rowdb2['QTY_ORDER'],2);} ?>" placeholder="0.00" required>
					  <span class="input-group-addon">KGs</span></div>  
                  </div>
				  <div class="col-sm-4">
					<div class="input-group">  
                    <input name="qty2" type="text" class="form-control" id="qty2" 
                    value="<?php if($cek>0){echo $rcek['pjng_order'];}else{echo round($rowdb2['QTY_PANJANG_ORDER'],2);}?>" placeholder="0.00" style="text-align: right;" required>
                    <span class="input-group-addon">
							  <select name="satuan1" style="font-size: 12px;" id="satuan1">
								  <option value="">Pilih</option>
								  <option value="Yard" <?php if($rowdb2['QTY_PANJANG_ORDER_UOM']=="yd"){ echo "SELECTED"; }?>>Yard</option>
								  <option value="Meter" <?php if($rowdb2['QTY_PANJANG_ORDER_UOM']=="m"){ echo "SELECTED"; }?>>Meter</option>
								  <option value="PCS" <?php if($rowdb2['QTY_PANJANG_ORDER_UOM']=="un"){ echo "SELECTED"; }?>>PCS</option>
							  </select>
					    </span>
					</div>	
                  </div>	
			 	<div class="col-sm-2">
                    <input name="lot" type="text" class="form-control" id="lot" 
                    value="<?php if($cek>0){echo $rcek['lot'];}else{echo $rowdb2['PRODUCTIONORDERCODE'];} ?>" placeholder="Lot" >
                  </div>
                </div>
		<div class="form-group">
			  <label for="jml_bruto" class="col-sm-3 control-label">Roll &amp; Qty</label>
			  <div class="col-sm-2">
				<input name="qty3" type="text" class="form-control" id="qty3" 
				value="<?php if($cek>0){echo $rcek['rol'];}else{if($rowr['JML_ROLL'] != 0){echo $rowr['JML_ROLL'];}} ?>" placeholder="0.00" required>
			  </div>
			  <div class="col-sm-3">
				<div class="input-group">  
				<input name="qty4" type="text" class="form-control" id="qty4" 
				value="<?php if($cek>0){echo $rcek['bruto'];}else{echo round($rowdb2['QTY_BAGI_KAIN'],2);} ?>" placeholder="0.00" style="text-align: right;" required>
				<span class="input-group-addon">KGs</span>
				</div>	
			  </div>		
			</div>
		
		<div class="form-group">
                  <label for="no_mc" class="col-sm-3 control-label">No MC</label>
                  <div class="col-sm-3">					  
						  <select name="no_mc" class="form-control" id="no_mc" required>
							  	<option value="">Pilih</option>							 
							  <?php 
							  $sqlKap=mysqli_query($con,"SELECT no_mesin FROM tbl_mesin ORDER BY no_mesin ASC");
							  while($rK=mysqli_fetch_array($sqlKap)){
							  ?>
								  <option value="<?php echo $rK['no_mesin']; ?>"><?php echo $rK['no_mesin']; ?></option>
							 <?php } ?>	

					  </select>
				  </div>
				  <label for="t_jawab" class="col-sm-3 control-label">Tanggung Jawab</label>
				  <div class="col-sm-3">					  
						  <select name="t_jawab" class="form-control" id="t_jawab" required>
							  	<option value="">Pilih</option>							 
								<option value="Asst. SPV">Asst. SPV</option>
								<option value="Leader">Leader</option>
					  </select>
				  </div>
		</div>
		<div class="form-group">
                  <label for="no_urut" class="col-sm-3 control-label">No Urut</label>
                  <div class="col-sm-2">					  
						  <select name="no_urut" class="form-control" id="no_urut" required>
							  	<option value="">Pilih</option>
							  <?php 
							  $sqlKap=mysqli_query($con,"SELECT no_urut FROM tbl_urut ORDER BY no_urut ASC");
							  while($rK=mysqli_fetch_array($sqlKap)){
							  ?>
								  <option value="<?php echo $rK['no_urut']; ?>"><?php echo $rK['no_urut']; ?></option>
							 <?php } ?>	  
					  </select>
				  </div>
					  
		</div>   
		<!--<div class="form-group">
                  <label for="shift" class="col-sm-3 control-label">Shift</label>
                  <div class="col-sm-2">					  
						  <select name="shift" class="form-control" required>
							  	<option value="">Pilih</option>
							  	<option value="1">1</option>
							    <option value="2">2</option>
							  	<option value="3">3</option>
					  </select>
				  </div>
					  
		</div>-->
		<!--<div class="form-group">
                  <label for="g_shift" class="col-sm-3 control-label">Group Shift</label>
                  <div class="col-sm-2">					  
						  <select name="g_shift" class="form-control" required>
							  	<option value="">Pilih</option>
							  	<option value="A">A</option>
							    <option value="B">B</option>
							  	<option value="C">C</option>
					  </select>
				  </div>
					  
		</div>--> 
		<div class="form-group">
                  <label for="proses" class="col-sm-3 control-label">Proses</label>
                  <div class="col-sm-5">					  
						  <select name="proses" class="form-control" id="proses" onChange="cekpro(); cekpro1(); cekpro2(); aktif_staff();" required>
							  	<option value="">Pilih</option>
							  <?php 
							  $sqlKap=mysqli_query($con,"SELECT proses FROM tbl_proses ORDER BY proses ASC");
							  while($rK=mysqli_fetch_array($sqlKap)){
							  ?>
								  <option value="<?php echo $rK['proses']; ?>"><?php echo $rK['proses']; ?></option>
							 <?php } ?>	  
					  </select>
				  </div>
				  	<div class="col-sm-2">
						<input type="checkbox" name="lembur" id="lembur" value="1" <?php  if($rcek['lembur']=="1"){ echo "checked";} ?>>  
						<label> Lembur</label>
					</div> 
		    </div>  
		<div class="form-group">
                  <label for="target" class="col-md-3 control-label">Std Target</label>
                  <div class="col-md-3">
				  <div class="input-group">	  
				  <input name="target" type="text" class="form-control" id="target" 
                    value="" placeholder="0" style="text-align: right;">
				  <span class="input-group-addon">Jam</span>	  
                  <span class="help-block with-errors"></span>
				  </div>	  
                  </div>
                  </div>  
		<div class="form-group">
                  <label for="personil" class="col-sm-3 control-label">Personil</label>
                  <div class="col-sm-5">					  
				  <input name="personil" type="text" class="form-control" id="personil" 
                    value="<?php echo $_SESSION['nama1'];?>" placeholder="personil" readonly>		  
				  </div>
					  
		    </div>              
		<div class="form-group">
                  <label for="ket" class="col-sm-3 control-label">Keterangan</label>
                  <div class="col-sm-5">					  
						  <select name="ket" class="form-control" id="ket" required>
							  	<option value="">Pilih</option>
							    <option value="Inspect Biasa">Inspect Biasa</option>
							  	<option value="Pisah Kain">Pisah Kain</option>
							  	<option value="Cek Beda Rol + Obras Tailing">Cek Beda Rol + Obras Tailing</option>
							  	<option value="Cek Gramasi Tiap Rol">Cek Gramasi Tiap Rol</option>						  
							  	<option value="Cek Bowing">Cek Bowing</option>
							  	<option value="Perbaikan Grade/Potong Buang">Perbaikan Grade/Potong Buang</option>
							  	<option value="Tandain Defect">Tandain Defect</option>
							    <option value="Cabut/Totol">Cabut/Totol</option>
							  	<option value="Ukur Repeat Printing">Ukur Repeat Printing</option>
							  	<option value="Lukis">Lukis</option>
							  	<option value="Lipat">Lipat</option>
							    <option value="Perbaikan grade">Perbaikan grade</option>
							  	<option value="Inspect Ulang">Inspect Ulang</option>					  	
							  	<option value="Packing + Mutasi">Packing + Mutasi</option>
							  	<option value="Packing BS">Packing BS</option>
                      </select>
				  </div>
				  <div class="col-sm-4">
			<select name="ket_kain" id="ket_kain" class="form-control" required>
				  <option value="">Pilih</option>
				  <option value="Normal">Normal</option>	
				  <option value="Sudah Dokumen">Sudah Dokumen</option>
				  <option value="Urgent">Urgent</option>
				  <option value="Top Urgent">Top Urgent</option>
				  </select>	  
			</div>	
					  
		</div> 
	  <div class="form-group">
                  <label for="catatan" class="col-sm-3 control-label">Catatan</label>
                  <div class="col-sm-8">		  
				  <textarea name="catatan" class="form-control" id="catatan" placeholder="catatan..."></textarea>		  
				  </div>			  
					  
		</div>	  
      </div>
	  		
	 
		  <input type="hidden" value="<?php if($cek>0){echo $rcek['no_ko'];}else{echo $rKO['KONo'];}?>" name="no_ko">
		  
 	</div>
   	<div class="box-footer">
   <button type="button" class="btn btn-default pull-left" name="back" value="kembali" onClick="window.location='Schedule'">Kembali <i class="fa fa-arrow-circle-o-left"></i></button>		
  	   
   <button type="submit" class="btn btn-primary pull-right" name="save" value="save">Simpan <i class="fa fa-save"></i></button> 
   </div>
    <!-- /.box-footer -->
 </div>
</form>
    
						
                    

<?php 
	if($_POST['save']=="save"){
	  $qryCek=mysqli_query($con,"SELECT * from tbl_schedule WHERE `status`='sedang jalan' and  no_mesin='$_POST[no_mc]'");
	  $row=mysqli_num_rows($qryCek);
	  $qryCekN=mysqli_query($con,"SELECT * from tbl_schedule WHERE nodemand='$_POST[nodemand]' and  no_mesin='$_POST[no_mc]' and not `status`='selesai'");
	  $rowN=mysqli_num_rows($qryCekN);
	  $qryCekS=mysqli_query($con,"SELECT * from tbl_schedule WHERE no_urut='$_POST[no_urut]' and  no_mesin='$_POST[no_mc]' and not `status`='selesai'");
	  $rowS=mysqli_num_rows($qryCekS);	
	  if($row>0 and $_POST['no_urut']=="1"){
		echo "<script> swal({
            title: 'Tidak bisa input urutan ke-`1`, mesin masih jalan',
            text: ' Klik OK untuk Input No Urut kembali',
            type: 'warning'
        }, function(){
            window.location='';
        });</script>";  
	  }	else if($rowN>0 ){	  
		 echo "<script> swal({
            title: 'Tidak bisa input, No Demand sudah di mesin ini',
            text: ' Klik OK untuk Input No Urut kembali',
            type: 'warning'
        }, function(){
            window.location='';
        });</script>"; }else if($rowS>0 ){	  
		 echo "<script> swal({
            title: 'Tidak bisa input, No Urut sudah di mesin ini',
            text: ' Klik OK untuk Input No Urut kembali',
            type: 'warning'
        }, function(){
            window.location='';
        });</script>"; 
	  }	else {
	  if($_POST['nokk']!=""){$kartu=$_POST['nokk'];}else{$kartu=$nou;}	
	  $warna=str_replace("'","''",$_POST['warna']);
	  $nowarna=str_replace("'","''",$_POST['no_warna']);	
	  $jns=str_replace("'","''",$_POST['jns_kain']);
	  $po=str_replace("'","''",$_POST['no_po']);
	  $catatan=str_replace("'","''",$_POST['catatan']);	  
	  $lot=trim($_POST['lot']);
	  if($_POST['lembur']=="1"){$lembur="1";}else{ $lembur="0";}	
  	  $sqlData=mysqli_query($con,"INSERT INTO tbl_schedule SET
		  nokk='$kartu',
		  nodemand='$_POST[nodemand]',
		  langganan='$_POST[langganan]',
		  buyer='$_POST[buyer]',
		  no_order='$_POST[no_order]',
		  po='$po',
		  no_hanger='$_POST[no_hanger]',
		  no_item='$_POST[no_item]',
		  jenis_kain='$jns',
		  tgl_delivery='$_POST[tgl_delivery]',
		  lebar='$_POST[lebar]',
		  gramasi='$_POST[grms]',
		  warna='$warna',
		  no_warna='$nowarna',
		  qty_order='$_POST[qty1]',
		  pjng_order='$_POST[qty2]',
		  satuan_order='$_POST[satuan1]',
		  lot='$lot',
		  rol='$_POST[qty3]',
		  bruto='$_POST[qty4]',
		  no_mesin='$_POST[no_mc]',
		  no_urut='$_POST[no_urut]',
		  no_sch='$_POST[no_urut]',
		  proses='$_POST[proses]',
		  revisi='$_POST[revisi]',
		  ket_status='$_POST[ket]',
		  ket_kain='$_POST[ket_kain]',
		  tgl_masuk=now(),
		  personil='$_POST[personil]',
		  target='$_POST[target]',
		  catatan='$catatan',
		  t_jawab='$_POST[t_jawab]',
		  lembur='$lembur',
		  tgl_update=now()");	 	  
	  
		if($sqlData){
			// echo "<script>alert('Data Tersimpan');</script>";
			// echo "<script>window.location.href='?p=Input-Data-KJ;</script>";
			echo "<script>swal({
  title: 'Data Tersimpan',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
    
	 window.location.href='Schedule'; 
  }
});</script>";
		}
	  }
			
	}
    if($_POST['update']=="update"){
	  $warna=str_replace("'","''",$_POST['warna']);
	  $nowarna=str_replace("'","''",$_POST['no_warna']);	
	  $jns=str_replace("'","''",$_POST['jns_kain']);
	  $po=str_replace("'","''",$_POST['no_po']);
	  $catatan=str_replace("'","''",$_POST['catatan']);	
	  $lot=trim($_POST['lot']);		
  	  $sqlData=mysqli_query($con,"UPDATE tbl_schedule SET 
		  no_mesin='$_POST[no_mc]',
		  no_urut='$_POST[no_urut]',
		  no_sch='$_POST[no_urut]',
		  proses='$_POST[proses]',
		  revisi='$_POST[revisi]',
		  ket_status='$_POST[ket]',
		  personil='$_POST[personil]',
		  target='$_POST[target]',
		  catatan='$catatan',
		  tgl_stop=now(),
		  tgl_update=now()
		  WHERE nokk='$_POST[nokk]'");	 	  
	  
		if($sqlData){
			// echo "<script>alert('Data Telah Diubah');</script>";
			// echo "<script>window.location.href='?p=Input-Data-KJ;</script>";
			echo "<script>swal({
  title: 'Data Telah DiUbah',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
    
	 window.location.href='Schedule'; 
  }
});</script>";
		}
		
			
	}
?>
