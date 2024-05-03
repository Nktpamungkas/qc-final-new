
 
 <?php

if (isset($_GET['excel'])) {
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kpestatus.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
$excell = '1';
}  else {
$excell = '0';
}
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
include "../../tgl_indo.php";
//--
$idkk=$_REQUEST['idkk'];
$act=$_GET['g'];
//-
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
$Dept=$_GET['dept'];
$Cancel=$_GET['cancel'];
$qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%Y-%m-%d') as tgl_skrg,DATE_FORMAT(now(),'%H:%i:%s') as jam_skrg");
$rTgl=mysqli_fetch_array($qTgl);
if($Awal!=""){$tgl=substr($Awal,0,10); $jam=$Awal;}else{$tgl=$rTgl['tgl_skrg']; $jam=$rTgl['jam_skrg'];}


function NoBonXX($tanggalawal,$tanggalakhir) { 
$output   = [];
$netto_yd = []; 
return  [$output, $netto_yd ];
}

function NoBon($tanggalawal,$tanggalakhir) { 
	$tanggalakhir = date('Y-m-d', strtotime($tanggalakhir . ' +1 day'));
	global $conn1; 
	$query = "SELECT A.*, B.BASESECONDARYQUANTITY  FROM ITXVIEW_MEMOPENTINGPPC A
			  LEFT JOIN ITXVIEW_NETTO B ON (A.DEMAND = B.CODE)
			  WHERE A.CREATIONDATETIME_SALESORDER  >=  '$tanggalawal'  AND A.CREATIONDATETIME_SALESORDER  < '$tanggalakhir'";
	$stmt = db2_exec($conn1, $query,array('cursor'=>DB2_SCROLLABLE) );

	$output   = [];
	$netto_yd = []; 

	if (db2_num_rows($stmt) > 0) {
		while ($row = db2_fetch_assoc($stmt)) {
			//PO”, “order”, “hanger”, “warna”, dan “masalah dominan
		    $subcode2 = str_replace(' ', '',$row['SUBCODE02']);
			$subcode3 = str_replace(' ', '',$row['SUBCODE03']);
			
			$po = $row['NO_PO'];
			$hanger = $subcode2.$subcode3;
			$warna = $row['WARNA'];
			
			
			
			$no_bon_order = preg_replace('/\s+/', '',$row['NO_ORDER']) ;
				if (substr($no_bon_order, 0, 1)=='R') {
					$output[$po.'/'.$hanger.'/'.$warna][$no_bon_order] = $no_bon_order ;
					$netto_yd[$po.'/'.$hanger.'/'.$warna][$no_bon_order] =  number_format($row['BASESECONDARYQUANTITY'],0);
				}
				
			
			
			
			// depannya R
			/*
			 $sql_netto_yd = db2_exec($conn1, "SELECT * FROM ITXVIEW_NETTO WHERE CODE = '$row[DEMAND]'");
             $d_netto_yd = db2_fetch_assoc($sql_netto_yd);
             $netto_yd =  number_format($d_netto_yd['BASESECONDARYQUANTITY'],0);
			 */
			 
			 $demand[] = $row['DEMAND'];
			
		} 	
	}
	
	return  [$output, $netto_yd ];
	
	
}
$tanggalawal = $Awal;
$tanggalAkhir = $Akhir ;
$no_bon = NoBon($tanggalawal,$tanggalAkhir);





?>
<?php 
if (!isset($_GET['excel'])) { ?>
	<link href="styles_cetak.css" rel="stylesheet" type="text/css">
	
<script>

// set portrait orientation

jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);

// set top margins in millimeters
jsPrintSetup.setOption('marginTop', 0);
jsPrintSetup.setOption('marginBottom', 0);
jsPrintSetup.setOption('marginLeft', 0);
jsPrintSetup.setOption('marginRight', 0);

// set page header
jsPrintSetup.setOption('headerStrLeft', '');
jsPrintSetup.setOption('headerStrCenter', '');
jsPrintSetup.setOption('headerStrRight', '');

// set empty page footer
jsPrintSetup.setOption('footerStrLeft', '');
jsPrintSetup.setOption('footerStrCenter', '');
jsPrintSetup.setOption('footerStrRight', '');

// clears user preferences always silent print value
// to enable using 'printSilent' option
jsPrintSetup.clearSilentPrint();

// Suppress print dialog (for this context only)
jsPrintSetup.setOption('printSilent', 1);

// Do Print 
// When print is submitted it is executed asynchronous and
// script flow continues after print independently of completetion of print process! 
jsPrintSetup.print();

window.addEventListener('load', function () {
    var rotates = document.getElementsByClassName('rotate');
    for (var i = 0; i < rotates.length; i++) {
        rotates[i].style.height = rotates[i].offsetWidth + 'px';
    }
});
// next commands

</script>
<style>
.hurufvertical {
 writing-mode:tb-rl;
    -webkit-transform:rotate(-90deg);
    -moz-transform:rotate(-90deg);
    -o-transform: rotate(-90deg);
    -ms-transform:rotate(-90deg);
    transform: rotate(180deg);
    white-space:nowrap;
    float:left;
}	

input{
text-align:center;
border:hidden;
}
@media print {
  ::-webkit-input-placeholder { /* WebKit browsers */
      color: transparent;
  }
  :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
      color: transparent;
  }
  ::-moz-placeholder { /* Mozilla Firefox 19+ */
      color: transparent;
  }
  :-ms-input-placeholder { /* Internet Explorer 10+ */
      color: transparent;
  }
  .pagebreak { page-break-before:always; }
  .header {display:block}
  table thead 
   {
    display: table-header-group;
   }
}	
</style>
<?php } 
?>
	

<?php 
$nmBln=array(1 => "JANUARI","FEBUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");	
?>
<div align="center">
<strong><font size="+1">SUMMARY KPE</font></strong><br />
		
		<font size="-1">Periode Tanggal: <?php echo date("d/m/Y", strtotime($Awal));?> s/d <?php echo date("d/m/Y", strtotime($Akhir));?></font>
</div>
<table width="100%">
  <thead>
    <tr>
      <td>

		</td>
    </tr> 
	</thead>
	
    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
		  <thead>
          <tr align="center">
            <td><font size="-2">NO</font></td>
            <!-- <td><font size="-2">Tanggal </font></td> -->
			<td><font size="-2">Buyer </font></td>
			<td><font size="-2">Brand</font></td>
			<td><font size="-2">PO</font></td>
			<td><font size="-2">Hanger</font></td>
			<td><font size="-2">Lebar & Gramasi</font></td>
			<td><font size="-2">Warna</font></td>
			<td><font size="-2">Qty Order</font></td>
			<td><font size="-2">Qty Claim </font></td>
			<td><font size="-2">% Claim</font></td>
			<td><font size="-2">Masalah Dominan</font></td>
			<td><font size="-2">Solusi</font></td>
			<td><font size="-2">Qty Cutting Loss </font></td>
			<td><font size="-2">Waktu pengerjaan </font></td>
			<td><font size="-2">Incharge</font></td>
			<td><font size="-2">Note </font></td>
			<td><font size="-2">Status</font></td>
			<td><font size="-2">No Bon Order</font></td>
           
          </tr>
		  </thead>	  
		  <tbody>
		<?php
	$no=1;
	$Awal=$_GET['awal'];
  $Akhir=$_GET['akhir'];
  $Order=$_GET['order'];
  $Hanger=$_GET['hanger'];
  $PO=$_GET['po'];
  $Langganan=$_GET['langganan'];
  $Demand=$_GET['demand'];
  $Prodorder=$_GET['prodorder'];
  $Pejabat=$_GET['pejabat'];
  if($Awal!=""){ $Where =" AND tgl_buat BETWEEN '$Awal' AND '$Akhir' "; }
  if($Awal!="" or $Order!="" or $Hanger!="" or $PO!="" or $Langganan!="" or $Demand!="" or $Prodorder!="" or $Pejabat!=""){
		$sql_cek = "SELECT *, sum(qty_claim) as qty_claim_gabung FROM tbl_aftersales_now WHERE   no_order LIKE '%$Order%' AND po LIKE '%$PO%' AND no_hanger LIKE '%$Hanger%' AND langganan LIKE '%$Langganan%' AND nodemand LIKE '%$Demand%' AND nokk LIKE '%$Prodorder%' AND pejabat LIKE '%$Pejabat%'
		$Where
		group by po, no_hanger, warna, masalah_dominan, qty_order
		ORDER BY tgl_buat ASC";
  $qry1=mysqli_query($con,$sql_cek);

  
  }else{
	  $sql_cek = "SELECT *, sum(qty_claim) as qty_claim_gabung FROM tbl_aftersales_now WHERE  and no_order LIKE '$Order' AND po LIKE '$PO' AND no_hanger LIKE '$Hanger' AND langganan LIKE '$Langganan' AND nodemand LIKE '$Demand' AND nokk LIKE '$Prodorder' AND pejabat LIKE '%$Pejabat%'  
	  $Where 
	  group by po, no_hanger, warna, masalah_dominan, qty_order
	  ORDER BY tgl_buat ASC";
  $qry1=mysqli_query($con,$sql_cek); 
  } ;
  
 
  
  $total_qty_order = 0;
  $total_qty_kirim = 0;
  $total_qty_claim = 0;

			while($row1=mysqli_fetch_array($qry1)){
				if($row1['t_jawab']!="" and $row1['t_jawab1']!="" and $row1['t_jawab2']!=""){ $tjawab=$row1['t_jawab'].",".$row1['t_jawab1'].", ".$row1['t_jawab2'];
				}else if($row1['t_jawab']!="" and $row1['t_jawab1']!="" and $row1['t_jawab2']==""){
				$tjawab=$row1['t_jawab'].",".$row1['t_jawab1'];	
				}else if($row1['t_jawab']!="" and $row1['t_jawab1']=="" and $row1['t_jawab2']!=""){
				$tjawab=$row1['t_jawab'].",".$row1['t_jawab2'];	
				}else if($row1['t_jawab']=="" and $row1['t_jawab1']!="" and $row1['t_jawab2']!=""){
				$tjawab=$row1['t_jawab1'].",".$row1['t_jawab2'];	
				}else if($row1['t_jawab']!="" and $row1['t_jawab1']=="" and $row1['t_jawab2']==""){
				$tjawab=$row1['t_jawab'];
				}else if($row1['t_jawab']=="" and $row1['t_jawab1']!="" and $row1['t_jawab2']==""){
				$tjawab=$row1['t_jawab1'];
				}else if($row1['t_jawab']=="" and $row1['t_jawab1']=="" and $row1['t_jawab2']!=""){
				$tjawab=$row1['t_jawab2'];	
				}else if($row1['t_jawab']=="" and $row1['t_jawab1']=="" and $row1['t_jawab2']==""){
				$tjawab="";	
				}
				
			   $total_qty_order+=$row1['qty_order'];
			   $total_qty_kirim+=$row1['qty_kirim'];
			   $total_qty_claim+=$row1['qty_claim'];
			   
			   $po = $row1['po'];
			   $hanger =$row1['no_hanger'];
			   $warna = $row1['warna'];
			
			   $key_bon = $po.'/'.$hanger.'/'.$warna;
			
			
		 ?>
          <tr valign="top">
            <td align="center"><font size="-2"><?php echo $no; ?></font></td>
            <!-- <td align="center"><font size="-2"><?=''//$row1['tgl_email']?></font></td> -->
			<td align="center"><font size="-2"><?=$row1['pelanggan']?></font></td>
			<td align="center"><font size="-2"><?php $exp = explode('/',$row1['langganan']); echo  $exp[1]  ?></font></td>
			
			
			<td align="center"><font size="-2"><?=$row1['po']?></font></td>
			<td align="center"><font size="-2"><?=$row1['no_hanger']?></font></td>
			<td align="center"><font size="-2"><?=$row1['lebar']?>x<?=$row1['gramasi']?></font></td>
			<td align="center"><font size="-2"><?=$row1['warna']?></font></td>
			<td align="center"><font size="-2"><?=$row1['qty_order']?></font></td>
			<td align="center"><font size="-2"><?=$row1['qty_claim_gabung']?></font></td>
			<td align="center"><font size="-2"><?php 
					$persentase = ($row1['qty_claim_gabung']/$row1['qty_order'])*100; 
					if (is_float($persentase)) {
						$rounded_angka = round($persentase,2);
						echo $rounded_angka;
					} else {
					echo $persentase;
					}
				?>%</font>
			</td>
			<td align="center"><font size="-2"><?=$row1['masalah_dominan']?></font></td>
			<td align="center"><font size="-2"><?=$row1['solusi']?></font></td>
			<td align="center"><font size="-2">
			
			<?php  if (array_key_exists($key_bon,$no_bon[1])) {
						$urutan = 1;
						foreach ($no_bon[1][$key_bon] as $dbon) {
						if ($urutan > 1) {
							echo '/'.$dbon ;
						} else {
							echo $dbon ;
						}
							
						$urutan++;
						}
				 }?>
			
			
			</font></td>
			
			<td align="center"><font size="-2"><?php if($row1['tgl_solusi_akhir'] !='0000-00-00' and $row1['tgl_solusi_akhir'] !=null and $row1['tgl_solusi_akhir'] !='') 
			{  ?>
				 <?=$row1['tgl_solusi_akhir'];?>
			<?php } ?>
		</font></td>
			<td align="center"><font size="-2"><?=$row1['nama_nego']?></font></td>
			<td align="center"><font size="-2"><?=$row1['ket']?></font></td>
			<td align="center">
				<?php if($row1['tgl_solusi_akhir'] !='0000-00-00' and $row1['tgl_solusi_akhir'] !=null and $row1['tgl_solusi_akhir'] !='') 
				{  ?>
					<?php if ($excell==1){ echo 'closed';} else {?>
						<img width=15px src="../../dist/img/check_mark.png"> 
					<?php } ?>
				<?php } ?>
			</td>
			<td align="center">
				<?php if (array_key_exists($key_bon,$no_bon[0])) {
					$urutan = 1;
					foreach ($no_bon[0][$key_bon] as $dbon) {
					if ($urutan > 1) {
						echo '/'.$dbon ;
					} else {
						echo $dbon ;
					}
						
					$urutan++;
					}
				}?>
			</font></td>
			
			
		
          </tr>
		<?php	$no++;  
			if($row1['status']!="Cancel"){
				$rol   =$row1['rol'];
				$berat =$row1['berat'];
				$lot   ="1";
			}else{
				$rol   ="0";
				$berat ="0";
				$lot   ="0";
			}
				
				//$tkirim=$tkirim+$row1['qty_kirim'];
				//$tclaim=$tclaim+$row1['qty_claim'];
			} ?>
		  
        
		 
			
        
      </table></td>
    </tr>
	</tbody>
    <tr>
      <td><table width="100%" border="0" class="table-list1">
      <tr align="center">
        <td>&nbsp;</td>
        <td>Diserahkan Oleh :</td>
        <td>Diketahui Oleh :</td>
        <td> Diketahui Oleh :</td>
      </tr>
      <tr>
        <td>Nama</td>
        <td align="center"><input type=text name=nama placeholder="Ketik disini"></td>
        <td align="center"><input type=text name=nama1 placeholder="Ketik disini"></td>
        <td align="center">Agung Cahyono</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td align="center"><input type=text name=nama2 placeholder="Ketik disini"></td>
        <td align="center"><input type=text name=nama3 placeholder="Ketik disini"></td>
        <td align="center">Manager</td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td align="center">
          <?php echo date("l, d F Y", strtotime($rTgl['tgl_skrg']));?>
        </td>
        <td align="center">
          <?php echo date("l, d F Y", strtotime($rTgl['tgl_skrg']));?>
        </td>
        <td align="center">
          <?php echo date("l, d F Y", strtotime($rTgl['tgl_skrg']));?>
        </td>
      </tr>
      <tr>
        <td height="60" valign="top">Tanda Tangan</td>
        <td>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    </tr>
  
</table>


