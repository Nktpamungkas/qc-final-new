<style>
input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
 
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
$notes			= $_GET['notest'];
$notes_post		= $_POST['notest'];
$tahun			= isset($_POST['tahun']) ? $_POST['tahun'] : '';
$standar_category		= isset($_POST['standar_category']) ? $_POST['standar_category'] : '';
$season		    = isset($_POST['season']) ? $_POST['season'] : '';
$jenis_report	= isset($_POST['jenis_report']) ? $_POST['jenis_report'] : '';
$no_report		= isset($_POST['no_report']) ? $_POST['no_report'] : '';
$Nokkold		= isset($_POST['no_kkold']) ? $_POST['no_kkold'] : '';
$DateIn			= isset($_POST['date_in']) ? $_POST['date_in'] : '';
$Date_out 		= isset($_POST['date_out1']) ? $_POST['date_out1'] : '';
$Style		    = isset($_POST['style']) ? $_POST['style'] : '';
$TglKirim       = isset($_POST['issued_on']) ? $_POST['issued_on'] : '';
$Prev_Rpt       = isset($_POST['prev_rpt']) ? $_POST['prev_rpt'] : '';
$Color_Abbrev   = isset($_POST['color_abbrev']) ? $_POST['color_abbrev'] : '';
$Fabric_Finish  = isset($_POST['fabric_finish']) ? $_POST['fabric_finish'] : '';
$Extension      = isset($_POST['extension']) ? $_POST['extension'] : '';
$Protocol      	= isset($_POST['protocol']) ? $_POST['protocol'] : '';
$Enduse      	= isset($_POST['enduse']) ? $_POST['enduse'] : '';
$Jns_Kain       = isset($_POST['jns_kain']) ? $_POST['jns_kain'] : '';
$ReportLulu     = isset($_POST['no_rptlulu']) ? $_POST['no_rptlulu'] : '';
$Revisi     	= isset($_POST['revisi']) ? $_POST['revisi'] : '';
$Sts_rev     	= isset($_POST['sts_rev']) ? $_POST['sts_rev'] : '';
$ip				= $_SERVER['REMOTE_ADDR'];

$sqlCek1=mysqli_query($con,"SELECT 
								n.*
							FROM 
								tbl_kaken_mizuno n
							WHERE 
								(no_test='$notes' OR no_test='$notes_post') 
							ORDER BY 
								id_kaken DESC 
							LIMIT 1");
$cek=mysqli_num_rows($sqlCek1);
$rcek1=mysqli_fetch_array($sqlCek1);

$sqlCek=mysqli_query($con,"SELECT 
								n.*
							FROM 
								tbl_tq_nokk n
							WHERE 
								(no_test='$notes' OR no_test='$notes_post') 
							ORDER BY 
								id DESC 
							LIMIT 1");
$cek33=mysqli_num_rows($sqlCek);
$rcek=mysqli_fetch_array($sqlCek);

$sqlDB2 = "SELECT
				A.CODE AS DEMANDNO,
				TRIM(B.PRODUCTIONORDERCODE) AS PRODUCTIONORDERCODE,
				TRIM(E.LEGALNAME1) AS LEGALNAME1,
				TRIM(C.ORDERPARTNERBRANDCODE) AS ORDERPARTNERBRANDCODE,
				TRIM(C.BUYER) AS BUYER,
				TRIM(C.SALESORDERCODE) AS SALESORDERCODE,
				TRIM(C.ITEMDESCRIPTION) AS ITEMDESCRIPTION,
				TRIM(A.SUBCODE05) AS NO_WARNA,
				TRIM(F.WARNA) AS WARNA,
				TRIM(A.SUBCODE02) AS SUBCODE02,
				TRIM(A.SUBCODE03) AS SUBCODE03,
				CASE 
					WHEN TRIM(C.LONGDESCRIPTION) <> '' THEN TRIM(C.LONGDESCRIPTION)
					ELSE TRIM(A.SUBCODE02)||TRIM(A.SUBCODE03) 
				END AS NO_ITEM,
				TRIM(C.PO_NUMBER) AS PO_NUMBER,
				TRIM(C.STYL) AS STYL
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
					CASE
						WHEN SALESORDER.INTERNALREFERENCE IS NULL THEN SALESORDERLINE.INTERNALREFERENCE
						ELSE SALESORDER.INTERNALREFERENCE
					END AS STYL,
					SUM(SALESORDERLINE.BASEPRIMARYQUANTITY) AS QTY_ORDER,
					SUM(SALESORDERLINE.BASESECONDARYQUANTITY) AS QTY_PANJANG_ORDER,
					SALESORDERLINE.BASESECONDARYUOMCODE AS QTY_PANJANG_ORDER_UOM,
					SALESORDERDELIVERY.DELIVERYDATE,
					ORDERITEMORDERPARTNERLINK.LONGDESCRIPTION,
					ORDERPARTNERBRAND.LONGDESCRIPTION AS BUYER
				FROM
					SALESORDER SALESORDER
				LEFT JOIN SALESORDERLINE SALESORDERLINE ON
					SALESORDER.CODE = SALESORDERLINE.SALESORDERCODE
				LEFT JOIN SALESORDERDELIVERY SALESORDERDELIVERY ON
					SALESORDERLINE.SALESORDERCODE = SALESORDERDELIVERY.SALESORDERLINESALESORDERCODE
					AND SALESORDERLINE.ORDERLINE = SALESORDERDELIVERY.SALESORDERLINEORDERLINE
				LEFT JOIN ORDERITEMORDERPARTNERLINK ORDERITEMORDERPARTNERLINK ON
					SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE = ORDERITEMORDERPARTNERLINK.ORDPRNCUSTOMERSUPPLIERCODE
					AND SALESORDERLINE.ITEMTYPEAFICODE = ORDERITEMORDERPARTNERLINK.ITEMTYPEAFICODE
					AND SALESORDERLINE.SUBCODE01 = ORDERITEMORDERPARTNERLINK.SUBCODE01
					AND SALESORDERLINE.SUBCODE02 = ORDERITEMORDERPARTNERLINK.SUBCODE02
					AND SALESORDERLINE.SUBCODE03 = ORDERITEMORDERPARTNERLINK.SUBCODE03
					AND SALESORDERLINE.SUBCODE04 = ORDERITEMORDERPARTNERLINK.SUBCODE04
					AND SALESORDERLINE.SUBCODE05 = ORDERITEMORDERPARTNERLINK.SUBCODE05
					AND SALESORDERLINE.SUBCODE06 = ORDERITEMORDERPARTNERLINK.SUBCODE06
					AND SALESORDERLINE.SUBCODE07 = ORDERITEMORDERPARTNERLINK.SUBCODE07
					AND SALESORDERLINE.SUBCODE08 = ORDERITEMORDERPARTNERLINK.SUBCODE08
					AND SALESORDERLINE.SUBCODE09 = ORDERITEMORDERPARTNERLINK.SUBCODE09
					AND SALESORDERLINE.SUBCODE10 = ORDERITEMORDERPARTNERLINK.SUBCODE10
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
					SALESORDER.INTERNALREFERENCE,
					SALESORDERLINE.INTERNALREFERENCE,
					SALESORDERDELIVERY.DELIVERYDATE,
					ORDERITEMORDERPARTNERLINK.LONGDESCRIPTION,
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
				ON A.SUBCODE01 = D.SUBCODE01
				AND A.SUBCODE02 = D.SUBCODE02
				AND A.SUBCODE03 = D.SUBCODE03
				AND A.SUBCODE04 = D.SUBCODE04
				AND A.SUBCODE05 = D.SUBCODE05
				AND A.SUBCODE06 = D.SUBCODE06
				AND A.SUBCODE07 = D.SUBCODE07
				AND A.SUBCODE08 = D.SUBCODE08
				AND A.SUBCODE09 = D.SUBCODE09
				AND A.SUBCODE10 = D.SUBCODE10
			LEFT JOIN
				(
				SELECT
					BUSINESSPARTNER.LEGALNAME1,
					ORDERPARTNER.CUSTOMERSUPPLIERCODE
				FROM
					BUSINESSPARTNER BUSINESSPARTNER
				LEFT JOIN ORDERPARTNER ORDERPARTNER 
				ON BUSINESSPARTNER.NUMBERID = ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID
				) E
				ON A.CUSTOMERCODE = E.CUSTOMERSUPPLIERCODE
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
					ITXVIEWCOLOR ITXVIEWCOLOR
					) F 
				ON A.ITEMTYPEAFICODE = F.ITEMTYPECODE
				AND A.SUBCODE01 = F.SUBCODE01
				AND A.SUBCODE02 = F.SUBCODE02
				AND A.SUBCODE03 = F.SUBCODE03
				AND A.SUBCODE04 = F.SUBCODE04
				AND A.SUBCODE05 = F.SUBCODE05
				AND A.SUBCODE06 = F.SUBCODE06
				AND A.SUBCODE07 = F.SUBCODE07
				AND A.SUBCODE08 = F.SUBCODE08
				AND A.SUBCODE09 = F.SUBCODE09
				AND A.SUBCODE10 = F.SUBCODE10
			LEFT JOIN
				(
				SELECT
					PRODUCTIONRESERVATION.PRODUCTIONORDERCODE,
					PRODUCTIONRESERVATION.ITEMTYPEAFICODE,
					SUM(PRODUCTIONRESERVATION.USEDUSERPRIMARYQUANTITY) AS USEDUSERPRIMARYQUANTITY
				FROM
					PRODUCTIONRESERVATION 
				PRODUCTIONRESERVATION
				WHERE
					PRODUCTIONRESERVATION.ITEMTYPEAFICODE = 'KGF'
				GROUP BY
					PRODUCTIONRESERVATION.PRODUCTIONORDERCODE,
					PRODUCTIONRESERVATION.ITEMTYPEAFICODE) G
			ON
				B.PRODUCTIONORDERCODE = G.PRODUCTIONORDERCODE
					WHERE A.CODE='$rcek[nodemand]'";
    $stmt = db2_exec($conn1, $sqlDB2, array('cursor' => DB2_SCROLLABLE));
	// echo $sqlDB2;
    $rowdb2 = db2_fetch_assoc($stmt);

// print_r($rowdb2);
?>	
<?php
	$data = $rcek['warna'];
	$parts = explode(', ', $data);
	$colorcode = trim($parts[0]);
	$colorname = trim($parts[1]);
?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form0" id="form0">
<div class="box box-info">
   	<div class="box-header with-border">
    	<h3 class="box-title">Report Kaken Mizuno</h3>
		<div class="box-tools pull-right">
	</div>
</div>
  	<div class="box-body"> 
	 	<div class="col-md-6">
     		<div class="form-group">
	  			<input name="no_id" type="hidden" class="form-control" id="no_id" value="<?php echo $rcek['id'];?>" placeholder="No ID">
                  <label for="nodemand" class="col-sm-3 control-label">No Demand</label>
                  	<div class="col-sm-4">
						<div class="input-group">	  
							<input name="nodemand" type="text" class="form-control" id="nodemand" 
							onchange="window.location='ReportKakenMizunoNoTest-'+this.value" value="<?php if($rcek['nodemand_new']!=''){echo $rcek['nodemand_new'];}else if($rcek['nodemand_new']==''){echo $rcek['nodemand'];}else{echo $_GET['nodemand'];} ?>" placeholder="No Demand" required <?php if($_SESSION['lvl_id']=="TQ"){echo "readonly";}?>>
						</div>	  
		  			</div>
            </div>
			<?php if($rcek['nodemand_new']!=''){?>
			<div class="form-group">
				<label for="nodemand_old" class="col-sm-3 control-label">No Demand Old</label>
					<div class="col-sm-5">
						<input name="nodemand_old" type="text" class="form-control" id="nodemand_old" placeholder="No Demand Old"
						value="<?php if($rcek['nodemand_new']!=''){echo $rcek['nodemand'];} ?>" readonly="readonly" >
					</div>
            </div>
			<?php } ?>
			<div class="form-group">
				<label for="no_test" class="col-sm-3 control-label">No Test</label>
				<div class="col-sm-4">
					<input name="no_test" type="text" class="form-control" id="no_test" placeholder="No Test" autocomplete="off" 
					onchange="window.location='ReportKakenMizunoNoTest-'+this.value" value="<?php if($_GET['notest']!=""){echo $_GET['notest'];}else{echo $notes_post;}?>" >
				</div>				   
			</div>
	        <div class="form-group">
                <label for="no_order" class="col-sm-3 control-label">No Order</label>
                <div class="col-sm-4">
                	<input name="no_order" type="text" class="form-control" id="no_order" placeholder="No Order" 
                    value="<?php echo $rowdb2['SALESORDERCODE'];?>" readonly="readonly">
                </div>				   
            </div>
		 	<div class="form-group">
                <label for="no_po" class="col-sm-3 control-label">Pelanggan</label>
                <div class="col-sm-8">
                    <input name="pelanggan" type="text" class="form-control" id="no_po" placeholder="Pelanggan" 
                    value="<?php echo $rowdb2['LEGALNAME1'];?>" readonly="readonly" >
                </div>				   
            </div>
	        <div class="form-group">
                <label for="no_po" class="col-sm-3 control-label">PO</label>
                <div class="col-sm-5">
                    <input name="no_po" type="text" class="form-control" id="no_po" placeholder="PO" 
                    value="<?php echo $rowdb2['PO_NUMBER'];?>" readonly="readonly" >
                </div>				   
            </div>
		 	<div class="form-group">
                <label for="no_hanger" class="col-sm-3 control-label">No Hanger / No Item</label>
                <div class="col-sm-3">
                    <input name="no_hanger" type="text" class="form-control" id="no_hanger" placeholder="No Hanger" 
                    value="<?php echo $rowdb2['SUBCODE02'].'-'.$rowdb2['SUBCODE03'];?>" readonly="readonly">  
                </div>
				<div class="col-sm-3">
				  	<input name="no_item" type="text" class="form-control" id="no_item" placeholder="No Item" 
                    value="<?php echo $rcek['no_item'];?>" readonly="readonly">
				</div>	
            </div>
			<div class="form-group">
                <label for="l_g" class="col-sm-3 control-label">Lebar X Gramasi</label>
                <div class="col-sm-2">
                    <input name="lebar" type="text" required class="form-control" id="lebar" placeholder="0" 
                    value="<?php if($cek>0){echo $rcek1['lebar'];}else{echo round($rcek['lebar']);} ?>" readonly="readonly">
                </div>
				<div class="col-sm-2">
                    <input name="gramasi" type="text" required class="form-control" id="gramasi" placeholder="0" 
                    value="<?php if($cek>0){echo $rcek1['gramasi'];}else{echo round($rcek['gramasi']);} ?>" readonly="readonly">
                </div>		
            </div>
			<!-- tahun -->
			<div class="form-group">
				<label for="tahun" class="col-sm-3 control-label">Tahun</label>
				<div class="col-sm-4">
					<input name="tahun" type="text" class="form-control" id="tahun" placeholder="Tahun" value="<?php if($cek>0){echo $rcek1['tahun'];}else{echo $tahun;} ?>" required>
				</div>
			</div>
            <div class="form-group">
				<label for="standar_category" class="col-sm-3 control-label">Standar Category</label>
				<div class="col-sm-8">
					<input name="standar_category" type="text" class="form-control" id="standar_category" 
					value="<?php if($rcek1['standar_category']!=""){echo $rcek1['standar_category'];}else{echo $standar_category;} ?>" placeholder="Standar Category" required>
				</div>				   
            </div> 
            <div class="form-group">
                <label for="jns_kain" class="col-sm-3 control-label">Jenis Kain</label>
                <div class="col-sm-8">
					<textarea name="jns_kain" class="form-control" id="jns_kain" placeholder="Jenis Kain"><?php if($cek>0){echo $rcek1['jenis_kain'];}else{echo $rcek['jenis_kain'];}?></textarea>
				</div>
            </div>
			<div class="form-group">
                <label for="warna" class="col-sm-3 control-label">Warna NOW</label>
                <div class="col-sm-8">
                	<textarea name="warna" readonly="readonly" class="form-control" id="warna" placeholder="Warna"><?php echo $rowdb2['WARNA'];?></textarea>
                </div>				   
            </div>
		 	<div class="form-group">
                <label for="no_warna" class="col-sm-3 control-label">No Warna</label>
                <div class="col-sm-8">
                    <textarea name="no_warna" readonly="readonly" class="form-control" id="no_warna" placeholder="No Warna"><?php echo $rowdb2['NO_WARNA'];?></textarea>
                </div>				   
            </div> 				
	  	</div>
	  	<!-- col --> 
	  	<div class="col-md-6">
			<div class="form-group">
				<label for="season" class="col-sm-3 control-label">Season</label>
				<div class="col-sm-6">
					<div class="input-group col-sm-6">
						<select class="form-control select2" name="season" id="season" required>
							<option value="">Pilih</option>
							<option value="S/S" <?php if($rcek1['season']=='S/S' || $season=='S/S'){echo "SELECTED";}?>>S/S</option>
							<option value="A/W" <?php if($rcek1['season']=='A/W' || $season=='A/W'){echo "SELECTED";}?>>A/W</option>
						</select>
					</div>
				</div>			   
            </div>
			<div class="form-group">
                <label for="jenis_report" class="col-sm-3 control-label">Jenis Report</label>
                <div class="col-sm-6">					  
					<div class="input-group col-sm-6">
						<select class="form-control select2" name="jenis_report" id="jenis_report" required>
							<option value="">Pilih</option>
							<option value="Sample" <?php if($rcek1['jenis_report']=='Sample' || $jenis_report=='Sample'){echo "SELECTED";}?>>Sample</option>
							<option value="Bulk"   <?php if($rcek1['jenis_report']=='Bulk'   || $jenis_report=='Bulk'){echo "SELECTED";}?>>Bulk</option>
						</select>
					</div>
				</div>
            </div>
            <div class="form-group">
                <label for="issued_on" class="col-sm-3 control-label">Issued On</label>
                <div class="col-sm-4">					  
					<div class="input-group date">
						<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
						<input name="issued_on" type="date" class="form-control pull-right" value="<?php if($rcek1['issued_on']!="" OR $rcek1['issued_on']!=NULL){echo $rcek1['issued_on'];}else{echo $TglKirim;} ?>" required autocomplete="off"/>
					</div>
				</div>
            </div> 		  
		 	<div class="form-group">
                <label for="lot" class="col-sm-3 control-label">Prod. Order / Lot</label>
                <div class="col-sm-2">
                    <input name="lot" type="text" class="form-control" id="lot" placeholder="Lot" 
                    value="<?php if($cek>0){echo $rcek1['lot'];}else{echo $rcek['lot'];} ?>" readonly="readonly" >
                </div>				   
            </div>
			<?php if($rcek['lot_new']!=''){?>
			<div class="form-group">
                <label for="lot_new" class="col-sm-3 control-label">Prod. Order/ Lot New</label>
                <div class="col-sm-3">
                    <input name="lot_new" type="text" class="form-control" id="lot_new" placeholder="Lot New" 
                    value="<?php if($cek>0){echo $rcek['lot_new'];} ?>" readonly="readonly" >
                </div>				   
            </div>
			<?php } ?>
            <div class="form-group">
          		<label for="buyer" class="col-sm-3 control-label">Buyer</label>
          		<div class="col-sm-5">
			  		<input name="buyer" type="text" class="form-control" id="buyer" placeholder="Buyer"
			  		value="<?php if($cek>0){echo $rcek1['buyer'];}else{echo $rcek['buyer'];} ?>" readonly="readonly">
		  		</div>
    		</div>
			<div class="form-group">
                <label for="colorname" class="col-sm-3 control-label">Warna</label>
                <div class="col-sm-8">
                	<textarea name="colorname" class="form-control" id="colorname" placeholder="colorname"><?php if($cek>0){echo $rcek1['colorname'];}else{echo $colorname;}?></textarea>
                </div>				   
            </div>
			<div class="form-group">
                <label for="colorcode" class="col-sm-3 control-label">No Warna</label>
                <div class="col-sm-8">
                	<textarea name="colorcode" class="form-control" id="colorcode" placeholder="colorcode"><?php if($cek>0){echo $rcek1['colorcode'];}else{echo $colorcode;}?></textarea>
                </div>				   
            </div>
            <div class="form-group">
				<label for="no_report" class="col-sm-3 control-label">No Report</label>
				<div class="col-sm-5">
					<input name="no_report" type="text" class="form-control" id="no_report" 
					value="<?php if($rcek1['no_report']!="" OR $rcek1['no_report']!=NULL){echo $rcek1['no_report'];}else{echo $no_report;} ?>" placeholder="No Report" required>
				</div>				   
            </div>
            <div class="form-group">
				<label for="comments" class="col-sm-3 control-label">Comments</label>
					<div class="col-sm-6">
						<textarea class="form-control" name="comments" maxlength="50" rows="3"><?php echo $rcek1['comments'];?></textarea>
					</div>
            </div>
		
	 	</div>
	</div>	
   	<div class="box-footer"> 
        <?php if($notes!="" OR $notes_post!=""){ ?>
			<button type="submit" class="btn btn-primary pull-right" name="save1" value="save"><i class="fa fa-save"></i>Simpan</button>
		<?php } ?>
		<?php if($cek>0){ ?>
			<a href="pages/cetak/cetak_report_mizunotq.php?id_nokk=<?php echo $rcek1['id_nokk'];?>&no_test=<?php echo $rcek1['no_test'];?>&nohanger=<?php echo $rcek['no_hanger'];?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Report Full Test</a>
		<?php } ?>
		<?php if($cek>0){ ?>
			<a href="pages/cetak/cetak_report_mizunotq2.php?id_nokk=<?php echo $rcek1['id_nokk'];?>&no_test=<?php echo $rcek1['no_test'];?>&nohanger=<?php echo $rcek['no_hanger'];?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Print Report Add Collor</a>
		<?php } ?>
   	</div>
   	<div class="box-footer"> 
   	</div>
    <!-- /.box-footer -->
</div>

</form>

           
			</div>
		</div>
	</div>
</div>

<?php 
if(isset($_POST['save1'])){

    $no_id          = $_POST['no_id'];
    $nodemand       = $_POST['nodemand'];
    $nodemand_old   = $_POST['nodemand_old'];
    $no_test        = $_POST['no_test'];
    $lebar          = $_POST['lebar'];
    $gramasi        = $_POST['gramasi'];
    $tahun          = $_POST['tahun'];
    $standar_category = $_POST['standar_category'];
    $jenis_kain     = str_replace("'", "''", $_POST['jns_kain']);
    $season         = $_POST['season'];
    $jenis_report   = $_POST['jenis_report'];
    $issued_on      = $_POST['issued_on'];
    $lot            = $_POST['lot'];
    $lot_new        = $_POST['lot_new'];
    $buyer          = $_POST['buyer'];
	$colorname      = $_POST['colorname'];
	$colorcode      = $_POST['colorcode'];
	$no_report      = $_POST['no_report'];
	$comments       = $_POST['comments'];
	$no_hanger       = $_POST['no_hanger'];
	$no_item       = $_POST['no_item'];

    $ip   = $_SERVER['REMOTE_ADDR'];
    $notes = $no_test; // bisa diganti sesuai variabel aslimu

    // cek data apakah sudah ada
    $cek=mysqli_query($con,"SELECT id_kaken FROM tbl_kaken_mizuno WHERE id_nokk='$no_id'");
    $ada=mysqli_num_rows($cek);

    if($ada==0){
        // ===================== INSERT =====================
        $sqlKK = mysqli_query($con,"INSERT INTO 
										tbl_kaken_mizuno (
											id_nokk, 
											nodemand, 
											nodemand_old, 
											no_test, 
											lebar, 
											gramasi, 
											tahun, 
											standar_category,
											jenis_kain, 
											season, 
											jenis_report, 
											issued_on,
											lot, 
											lot_new, 
											buyer, 
											ip_insert, 
											insert_date, 
											colorname,
											colorcode, 
											no_report, 
											comments,
											no_hanger,
											no_item
										) VALUES (
										'$no_id', 
										'$nodemand', 
										'$nodemand_old', 
										'$no_test',
										'$lebar', 
										'$gramasi', 
										'$tahun', 
										'$standar_category',
										'$jenis_kain', 
										'$season', 
										'$jenis_report', 
										'$issued_on',
										'$lot', 
										'$lot_new', 
										'$buyer', 
										'$ip', 
										NOW(),
										'$colorname',
										'$colorcode',
										'$no_report', 
										'$comments',
										'$no_hanger',
										'$no_item'
        )");

        if($sqlKK){
            echo "<script>
            swal({
                title: 'Data Berhasil Disimpan',
                text: 'Klik Ok untuk input data kembali',
                type: 'success',
            }).then((result) => {
                if (result.value) {
                    window.location.href='ReportKakenMizunoNoTest-$notes'; 
                }
            });
            </script>";
        }else{
            echo "<script>
            swal('Gagal!', 'Data gagal disimpan: ".mysqli_error($con)."', 'error');
            </script>";
        }

    }else{
        // ===================== UPDATE =====================
        $sqlKK = mysqli_query($con,"UPDATE tbl_kaken_mizuno SET
								nodemand='$nodemand',
								nodemand_old='$nodemand_old',
								no_test='$no_test',
								lebar='$lebar',
								gramasi='$gramasi',
								tahun='$tahun',
								standar_category='$standar_category',
								jenis_kain='$jenis_kain',
								season='$season',
								jenis_report='$jenis_report',
								issued_on='$issued_on',
								lot='$lot',
								lot_new='$lot_new',
								buyer='$buyer',
								ip_update='$ip',
								update_date=NOW(),
								colorname='$colorname',
								colorcode='$colorcode',
								no_report='$no_report',
								comments='$comments',
								no_hanger='$no_hanger',
								no_item='$no_item'
            WHERE id_nokk='$no_id'
        ");

        if($sqlKK){
            echo "<script>
            swal({
                title: 'Data KK Berhasil di Update',   
                text: 'Klik Ok untuk input data kembali',
                type: 'success',
            }).then((result) => {
                if (result.value) {
                    window.location.href='ReportKakenMizunoNoTest-$notes'; 
                }
            });
            </script>";
        }else{
            echo "<script>
            swal('Gagal!', 'Data gagal diupdate: ".mysqli_error($con)."', 'error');
            </script>";
        }
    }
}
?>