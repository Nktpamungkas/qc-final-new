<?php
if (isset($_GET['excell'])) {
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=cetaklolosqc-".date("His").".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
} else { ?>
	<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<?php } 
ini_set("error_reporting", 1);
session_start();
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "../../koneksi.php";
include "../../tgl_indo.php";
//--
$idkk=$_REQUEST['idkk'];
$act=$_GET['g'];
//-
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
$GShift=$_GET['shft'];
$Subdept=$_GET['subdept'];
$TotalKirim=$_GET['total'];
$TotalLot=$_GET['total_lot'];
$Lolos=$_GET['lolos'];
$Langganan=$_GET['langganan'];
$qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%Y-%m-%d') as tgl_skrg,DATE_FORMAT(now(),'%H:%i:%s') as jam_skrg");
$rTgl=mysqli_fetch_array($qTgl);
if($Awal!=""){$tgl=substr($Awal,0,10); $jam=$Awal;}else{$tgl=$rTgl['tgl_skrg']; $jam=$rTgl['jam_skrg'];}
?>



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

<?php 
$nmBln=array(1 => "JANUARI","FEBUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");	
?>

<table width="100%">
<!--
  <thead>

    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
  
  <tr>
    <td align="center"><strong><font size="+1">LAPORAN KELUHAN PELANGGAN EKSTERNAL &quot;LOLOS QC&quot;</font><br />
		<font size="-1">Periode: <?php echo date("d/m/Y", strtotime($Awal));?> s/d <?php echo date("d/m/Y", strtotime($Akhir));?></font>
          <br />
    </strong></td>
    </tr>
	
  </table>

		</td>
    </tr>
	
	</thead>-->
    <tr>
      <td><table width="100%" border="1" class="table-list1">
        <thead>
		
		<tr align="center">
			<td colspan="17">
				<strong><font size="+1">LAPORAN KELUHAN PELANGGAN EKSTERNAL &quot;LOLOS QC&quot;</font><br />
					<font size="-1">Periode: <?php echo date("d/m/Y", strtotime($Awal));?> s/d <?php echo date("d/m/Y", strtotime($Akhir));?></font>
					  <br />
				</strong>
			</td>
            
          </tr>
		  
          <tr align="center">
			<td><font size="-2"><strong>NO</strong></font></td>
            <td><font size="-2"><strong>LANGGANAN</strong></font></td>
            <td><font size="-2"><strong>ORDER</strong></font></td>
            <td><font size="-2"><strong>JENIS KAIN</strong></font></td>
            <td><font size="-2"><strong>LEBAR &amp; GRAMASI</strong></font></td>
            <td><font size="-2"><strong>LOT</strong></font></td>
            <td><font size="-2"><strong>WARNA</strong></font></td>
            <td><font size="-2"><strong>QTY KIRIM</strong></font></td>
            <td><font size="-2"><strong>QTY KELUHAN</strong></font></td>
            <td><font size="-2"><strong>MASALAH</strong></font></td>
            <td><font size="-2"><strong>TGL PROSES</strong></font></td>
            <td><font size="-2"><strong>SOLUSI</strong></font></td>
            <td><font size="-2"><strong>PENYEBAB</strong></font></td>
            <td><font size="-2"><strong>PERSONIL</strong></font></td>
            <td><font size="-2"><strong>SHIFT</strong></font></td>
            <td><font size="-2"><strong>KETERANGAN</strong></font></td>
            <td><font size="-2"><strong>&nbsp;</strong></font></td>
          </tr>
		</thead>
		<tbody>  
		<?php
	$no=1;
	//$Awal=$_GET['awal'];
  //$Akhir=$_GET['akhir'];
  //$GShift=$_GET['shft'];
  if($_GET['awal']!=""){ $Where ="AND DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' AND sts_revdis='0' "; }
  if($_GET['shft']=="ALL" or $_GET['shft']==""){ $shft=" ";}else{$shft=" AND shift='$_GET[shft]' OR shift2='$_GET[shft]' ";}
  if($_GET['subdept']!=""){ $subdpt=" AND subdept='$_GET[subdept]' "; }else{$subdpt=" ";}
  if($Lolos=="1"){ $lolos=" AND sts='1' "; }else{ $lolos=" ";}
  if($Awal!="" or $GShift!="" or $Subdept!="" or $Lolos=="1" or $Langganan!=""){
  $qry1=mysqli_query($con,"SELECT * FROM tbl_aftersales_now WHERE langganan LIKE '%$_GET[langganan]%' $Where $lolos $shft $subdpt ORDER BY pejabat,personil ASC");
  }else{
  $qry1=mysqli_query($con,"SELECT * FROM tbl_aftersales_now WHERE langganan LIKE '$_GET[langganan]' $Where $lolos $shft $subdpt ORDER BY pejabat,personil ASC");
  }
  $tkirim=0;
  $tclaim=0;
			while($row1=mysqli_fetch_array($qry1)){
        // $qryQCF=mysqli_query($con,"SELECT a.nokk, a.nodemand, a.masalah_dominan, b.tgl_fin, b.tgl_ins, b.tgl_masuk, b.ket from tbl_aftersales_now a left join tbl_qcf b on a.nodemand=b.nodemand WHERE a.nodemand='$row1[nodemand]'");
        // $rQCF=mysqli_fetch_array($qryQCF);
        $sqlFIN="SELECT
        PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE,
        PRODUCTIONDEMANDSTEP.OPERATIONCODE,
        PRODUCTIONDEMANDSTEP.MINBEGINQUEUE AS TGL_FIN 
        FROM PRODUCTIONDEMANDSTEP PRODUCTIONDEMANDSTEP
        WHERE PRODUCTIONDEMANDSTEP.OPERATIONCODE ='FNJ1' AND PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE ='$row1[nodemand]'";
        $stmt=db2_exec($conn1,$sqlFIN, array('cursor'=>DB2_SCROLLABLE));
        $rFIN=db2_fetch_assoc($stmt);

        $sqlINS="SELECT
        PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE,
        PRODUCTIONDEMANDSTEP.OPERATIONCODE,
        PRODUCTIONDEMANDSTEP.MINBEGINQUEUE AS TGL_INS 
        FROM PRODUCTIONDEMANDSTEP PRODUCTIONDEMANDSTEP
        WHERE PRODUCTIONDEMANDSTEP.OPERATIONCODE ='INS3' AND PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE ='$row1[nodemand]'";
        $stmt1=db2_exec($conn1,$sqlINS, array('cursor'=>DB2_SCROLLABLE));
        $rINS=db2_fetch_assoc($stmt1);

        $sqlPACK="SELECT
        PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE,
        PRODUCTIONDEMANDSTEP.OPERATIONCODE,
        PRODUCTIONDEMANDSTEP.MINBEGINQUEUE AS TGL_INS 
        FROM PRODUCTIONDEMANDSTEP PRODUCTIONDEMANDSTEP
        WHERE PRODUCTIONDEMANDSTEP.OPERATIONCODE ='CNP1' AND PRODUCTIONDEMANDSTEP.PRODUCTIONDEMANDCODE ='$row1[nodemand]'";
        $stmt2=db2_exec($conn1,$sqlPACK, array('cursor'=>DB2_SCROLLABLE));
        $rPACK=db2_fetch_assoc($stmt2);

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
		 ?>
          <tr valign="top">
            <td align="center"><font size="-2"><?php echo $no; ?></font></td>
            <td><font size="-2"><?php echo substr(strtoupper($row1['langganan']),0,15)."<br>".substr(strtoupper($row1['langganan']),15,15)."<br>".substr(strtoupper($row1['langganan']),30,15)."<br>".substr(strtoupper($row1['langganan']),45,15);?></font></td>
            <td align="center"><font size="-2"><?php echo strtoupper($row1['no_order']);?></font></td>
            <td><font size="-2"><?php echo substr(strtoupper($row1['jenis_kain']),0,30)."...";?></font></td>
            <td align="center"><font size="-2"><?php echo $row1['lebar']."x".$row1['gramasi'];?></font></td>
            <td align="center"><font size="-2"><?php echo strtoupper($row1['lot']);?></font></td>
            <td align="center"><font size="-2"><?php echo strtoupper($row1['warna']);?></font></td>
            <td align="right"><font size="-2"><?php echo strtoupper($row1['qty_kirim']);?></font></td>
            <td align="right"><font size="-2"><?php echo strtoupper($row1['qty_claim']);?></font></td>
            <td valign="top"><font size="-2"><?php echo $row1['masalah'];?></font></td>
            <td valign="top"><font size="-2"><?php if($row1['masalah_dominan']=="Salah Sticker" OR $row1['masalah_dominan']=="Salah Proses" or $row1['masalah_dominan']=="Short Yard"){echo $rPACK['TGL_PACK'];}else if($row1['masalah_dominan']=="Beda Warna"){echo $rFIN['TGL_FIN'];}else if($row1['masalah_dominan']!="Beda Warna"){echo $rINS['TGL_INS'];}?></font></td>
            <!-- <?php if(strpos($rQCF['ket'],'AKJ') !== false){echo $rQCF['tgl_masuk'];}else if($rQCF['masalah_dominan']=="Beda Warna"){echo $rQCF['tgl_fin'];}else if($rQCF['masalah_dominan']!="Beda Warna"){echo $rQCF['tgl_ins'];}?> -->
            <td valign="top"><font size="-2"><?php echo $row1['solusi'];?></font></td>
            <td valign="top"><font size="-2"><?php echo $row1['penyebab'];?></font></td>
            <td valign="top"><font size="-2"><?php if($row1['pejabat']!=""){echo $row1['pejabat'];}else if($row1['personil4']!=""){echo $row1['personil'].",".$row1['personil2'].",".$row1['personil3'].",".$row1['personil4'];}else if($row1['personil3']!=""){echo $row1['personil'].",".$row1['personil2'].",".$row1['personil3'];}else if($row1['personil2']!=""){echo $row1['personil'].",".$row1['personil2'];}else{echo $row1['personil'];}?></font></td>
            <td valign="top"><font size="-2"><?php if($row1['shift4']!=""){echo $row1['shift'].",".$row1['shift2'].",".$row1['shift3'].",".$row1['shift4'];}else if($row1['shift3']!=""){echo $row1['shift'].",".$row1['shift2'].",".$row1['shift3'];}else if($row1['shift2']!=""){echo $row1['shift'].",".$row1['shift2'];}else{echo $row1['shift'];}?></font></td>
            <td valign="top"><font size="-2"><?php echo $row1['ket'];?></font></td>
            <td valign="top"><font size="-2"><?php if($row1['sts_check']=="Ceklis"){echo "&#10004";}else{echo "X";}?></font></td>
          </tr>
		<?php	$no++; 
				$tkirim=$tkirim+$row1['qty_kirim'];
				$tclaim=$tclaim+$row1['qty_claim'];
			} ?>	
          <tr valign="top">
            <td colspan="7" align="right"><strong>TOTAL</strong></td>
            <td align="right"><strong><?php echo $tkirim;?></strong></td>
            <td align="right"><strong><?php echo $tclaim;?></strong></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
			
        </tbody>
      </table></td>
    </tr>
	<!--xxx-->
	<?php  if (!isset($_GET['excell'])) { ?>
    <tr>
      <td><table width="100%" border="0" class="table-list1">
        <tr>
          <td align="left" style="border-top:0px #000000 solid; 
                                            border-bottom:0px #000000 solid;
                                            border-left:0px #000000 solid; 
                                            border-right:0px #000000 solid;" width="50%"><strong>LOLOS QC</strong></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td align="left" style="border-top:0px #000000 solid; 
                                            border-bottom:0px #000000 solid;
                                            border-left:0px #000000 solid; 
                                            border-right:0px #000000 solid;"><table width="100%">
        <tr>
          <td style="border-top:0px #000000 solid; 
                                            border-bottom:0px #000000 solid;
                                            border-left:0px #000000 solid; 
                                            border-right:0px #000000 solid;"><table width="50%" border="1" class="table-list1">
            <?php
            if($_GET['langganan']!=""){ $lgn =" AND langganan LIKE '%$_GET[langganan]%' "; }else{$lgn = " ";}
            //Shift A
            $qryjml1=mysqli_query($con,"SELECT COUNT(*) as jml_a FROM tbl_aftersales_now WHERE
            DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
            AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='A' OR shift2='A' OR shift3='A' OR shift4='A') $lgn");
            $rowjml1=mysqli_fetch_array($qryjml1);
            //Shift B
            $qryjml2=mysqli_query($con,"SELECT COUNT(*) as jml_b FROM tbl_aftersales_now WHERE
            DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
            AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='B' OR shift2='B' OR shift3='B' OR shift4='B') $lgn");
            $rowjml2=mysqli_fetch_array($qryjml2);
            //Shift C
            $qryjml3=mysqli_query($con,"SELECT COUNT(*) as jml_c FROM tbl_aftersales_now WHERE
            DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
            AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='C' OR shift2='C' OR shift3='C' OR shift4='C') $lgn");
            $rowjml3=mysqli_fetch_array($qryjml3);
            //Shift Non Shift
            $qryjml4=mysqli_query($con,"SELECT COUNT(*) as jml_non FROM tbl_aftersales_now WHERE
            DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
            AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='Non-Shift' OR shift2='Non-Shift' OR shift3='Non-Shift' OR shift4='Non-Shift') $lgn");
            $rowjml4=mysqli_fetch_array($qryjml4);
            //QC2
            $qryjml5=mysqli_query($con,"SELECT COUNT(*) as jml_qc2 FROM tbl_aftersales_now WHERE
            DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
            AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='QC2' OR shift2='QC2' OR shift3='QC2' OR shift4='QC2') $lgn");
            $rowjml5=mysqli_fetch_array($qryjml5);
            //TQ
            $qryjml6=mysqli_query($con,"SELECT COUNT(*) as jml_tq FROM tbl_aftersales_now WHERE
            DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
            AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='Test Quality' OR shift2='Test Quality' OR shift3='Test Quality' OR shift4='Test Quality') $lgn");
            $rowjml6=mysqli_fetch_array($qryjml6);
            ?>
            <tr>
                <td align="center" rowspan ="3" width="25%"><strong>Shift</strong></td>
                <td align="center" rowspan ="3" width="25%"><strong>Qty Keluhan</strong></td>
                <td align="center" rowspan ="3" width="10%"><strong>% (Qty Keluhan)</strong></td>
                <td align="center" rowspan ="3" width="25%"><strong>Total Kasus</strong></td>
                <td align="center" rowspan ="3" width="10%"><strong>% (Total Kasus)</strong></td>
                <td align="center" colspan="4" width="25%"><strong>Lolos QC (Kasus)</strong></td>
            </tr>
            <tr>
                <td align="center" width="25%" colspan="2"><strong>Defect</strong></td>
                <td align="center" width="10%" colspan="2"><strong>BW</strong></td>
            </tr>
            <tr>
                <td align="center" width="25%"><strong>Kasus</strong></td>
                <td align="center" width="10%"><strong>Qty</strong></td>
                <td align="center" width="25%"><strong>Kasus</strong></td>
                <td align="center" width="10%"><strong>Qty</strong></td>
            </tr>
            <tr>
              <?php
              if($_GET['langganan']!=""){ $lgn =" AND langganan LIKE '%$_GET[langganan]%' "; }else{$lgn = " ";}
              $qry1=mysqli_query($con,"SELECT shift, shift2, shift3, shift4, IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim))) AS qty_claim_a FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='A' OR shift2='A' OR shift3='A' OR shift4='A') $lgn"); 
              //DEFECT LOLOS QC
              $qrylqcdefa=mysqli_query($con,"SELECT count(*) as jml_def, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan != 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='A' OR shift2='A' OR shift3='A' OR shift4='A')");
              $rlqcdefa=mysqli_fetch_array($qrylqcdefa);
              //BEDA WARNA LOLOS QC
              $qrylqcbwa=mysqli_query($con,"SELECT count(*) as jml_bw, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan = 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='A' OR shift2='A' OR shift3='A' OR shift4='A')");
              $rlqcbwa=mysqli_fetch_array($qrylqcbwa);
              $tot_a=0;
              while($row1=mysqli_fetch_array($qry1)){
              $tot_a=$tot_a+$row1['qty_claim_a']; }?>
                <td align="left">A</td>
                <td align="right"><?php echo number_format($tot_a,2)." Kg";?></td>
                <td align="center"><?php echo number_format(($tot_a/$TotalKirim)*100,2)." %";?></td>
                <td align="center"><?php echo $rowjml1['jml_a']." Kasus"; ?></td>
                <td align="center"><?php echo number_format(($rowjml1['jml_a']/$TotalLot)*100,2)." %";?></td>
                <td align="center"><?php echo $rlqcdefa['jml_def'];?></td>
                <td align="center"><?php echo number_format($rlqcdefa['qty_kg'],2)." Kg";?></td>
                <td align="center"><?php echo $rlqcbwa['jml_bw'];?></td>
                <td align="center"><?php echo number_format($rlqcbwa['qty_kg'],2)." Kg";?></td>
            </tr>
            <tr>
            <?php
              $qry2=mysqli_query($con,"SELECT shift, shift2, shift3, shift4, IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim))) AS qty_claim_b FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='B' OR shift2='B' OR shift3='B' OR shift4='B') $lgn"); 
              //DEFECT LOLOS QC
              $qrylqcdefb=mysqli_query($con,"SELECT count(*) as jml_def, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan != 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='B' OR shift2='B' OR shift3='B' OR shift4='B')");
              $rlqcdefb=mysqli_fetch_array($qrylqcdefb);
              //BEDA WARNA LOLOS QC
              $qrylqcbwb=mysqli_query($con,"SELECT count(*) as jml_bw, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan = 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='B' OR shift2='B' OR shift3='B' OR shift4='B')");
              $rlqcbwb=mysqli_fetch_array($qrylqcbwb);
              $tot_b=0;
              while($row2=mysqli_fetch_array($qry2)){
              $tot_b=$tot_b+$row2['qty_claim_b']; }?>
                <td align="left">B</td>
                <td align="right"><?php echo number_format($tot_b,2)." Kg";?></td>
                <td align="center"><?php echo number_format(($tot_b/$TotalKirim)*100,2)." %";?></td>
                <td align="center"><?php echo $rowjml2['jml_b']." Kasus"; ?></td>
                <td align="center"><?php echo number_format(($rowjml2['jml_b']/$TotalLot)*100,2)." %";?></td>
                <td align="center"><?php echo $rlqcdefb['jml_def'];?></td>
                <td align="center"><?php echo number_format($rlqcdefb['qty_kg'],2)." Kg";?></td>
                <td align="center"><?php echo $rlqcbwb['jml_bw'];?></td>
                <td align="center"><?php echo number_format($rlqcbwb['qty_kg'],2)." Kg";?></td>
            </tr>
            <tr>
            <?php
              $qry3=mysqli_query($con,"SELECT shift, shift2, shift3, shift4, IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim))) AS qty_claim_c FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='C' OR shift2='C' OR shift3='C' OR shift4='C') $lgn"); 
              //DEFECT LOLOS QC
              $qrylqcdefc=mysqli_query($con,"SELECT count(*) as jml_def, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan != 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='C' OR shift2='C' OR shift3='C' OR shift4='C')");
              $rlqcdefc=mysqli_fetch_array($qrylqcdefc);
              //BEDA WARNA LOLOS QC
              $qrylqcbwc=mysqli_query($con,"SELECT count(*) as jml_bw, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan = 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='C' OR shift2='C' OR shift3='C' OR shift4='C')");
              $rlqcbwc=mysqli_fetch_array($qrylqcbwc);
              $tot_c=0;
              while($row3=mysqli_fetch_array($qry3)){
              $tot_c=$tot_c+$row3['qty_claim_c']; }?>
                <td align="left">C</td>
                <td align="right"><?php echo number_format($tot_c,2)." Kg";?></td>
                <td align="center"><?php echo number_format(($tot_c/$TotalKirim)*100,2)." %";?></td>
                <td align="center"><?php echo $rowjml3['jml_c']." Kasus"; ?></td>
                <td align="center"><?php echo number_format(($rowjml3['jml_c']/$TotalLot)*100,2)." %";?></td>
                <td align="center"><?php echo $rlqcdefc['jml_def'];?></td>
                <td align="center"><?php echo number_format($rlqcdefc['qty_kg'],2)." Kg";?></td>
                <td align="center"><?php echo $rlqcbwc['jml_bw'];?></td>
                <td align="center"><?php echo number_format($rlqcbwc['qty_kg'],2)." Kg";?></td>
            </tr>
            <tr>
            <?php
              $qry4=mysqli_query($con,"SELECT shift, shift2, shift3, shift4, IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim))) AS qty_claim_non FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='Non-Shift' OR shift2='Non-Shift' OR shift3='Non-Shift' OR shift4='Non-Shift') $lgn"); 
              //DEFECT LOLOS QC
              $qrylqcdefn=mysqli_query($con,"SELECT count(*) as jml_def, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan != 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='Non-Shift' OR shift2='Non-Shift' OR shift3='Non-Shift' OR shift4='Non-Shift')");
              $rlqcdefn=mysqli_fetch_array($qrylqcdefn);
              //BEDA WARNA LOLOS QC
              $qrylqcbwn=mysqli_query($con,"SELECT count(*) as jml_bw, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan = 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='Non-Shift' OR shift2='Non-Shift' OR shift3='Non-Shift' OR shift4='Non-Shift')");
              $rlqcbwn=mysqli_fetch_array($qrylqcbwn);
              $tot_non=0;
              while($row4=mysqli_fetch_array($qry4)){
              $tot_non=$tot_non+$row4['qty_claim_non']; }?>
                <td align="left">Non-Shift</td>
                <td align="right"><?php echo number_format($tot_non,2)." Kg";?></td>
                <td align="center"><?php echo number_format(($tot_non/$TotalKirim)*100,2)." %";?></td>
                <td align="center"><?php echo $rowjml4['jml_non']." Kasus"; ?></td>
                <td align="center"><?php echo number_format(($rowjml4['jml_non']/$TotalLot)*100,2)." %";?></td>
                <td align="center"><?php echo $rlqcdefn['jml_def'];?></td>
                <td align="center"><?php echo number_format($rlqcdefn['qty_kg'],2)." Kg";?></td>
                <td align="center"><?php echo $rlqcbwn['jml_bw'];?></td>
                <td align="center"><?php echo number_format($rlqcbwn['qty_kg'],2)." Kg";?></td>
            </tr>
            <tr>
              <?php
              $qry5=mysqli_query($con,"SELECT shift, shift2, shift3, shift4, IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim))) AS qty_claim_qc2 FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='QC2' OR shift2='QC2' OR shift3='QC2' OR shift4='QC2') $lgn"); 
              //DEFECT LOLOS QC
              $qrylqcdefqc2=mysqli_query($con,"SELECT count(*) as jml_def, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan != 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='QC2' OR shift2='QC2' OR shift3='QC2' OR shift4='QC2')");
              $rlqcdefqc2=mysqli_fetch_array($qrylqcdefqc2);
              //BEDA WARNA LOLOS QC
              $qrylqcbwqc2=mysqli_query($con,"SELECT count(*) as jml_bw, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and (masalah_dominan = 'Beda Warna' or masalah_dominan = 'BELANG/SHADING') and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='QC2' OR shift2='QC2' OR shift3='QC2' OR shift4='QC2')");
              $rlqcbwqc2=mysqli_fetch_array($qrylqcbwqc2);
              $tot_qc2=0;
              while($row5=mysqli_fetch_array($qry5)){
              $tot_qc2=$tot_qc2+$row5['qty_claim_qc2']; }?>
                <td align="left">QC2</td>
                <td align="right"><?php echo number_format($tot_qc2,2)." Kg";?></td>
                <td align="center"><?php echo number_format(($tot_qc2/$TotalKirim)*100,2)." %";?></td>
                <td align="center"><?php echo $rowjml5['jml_qc2']." Kasus"; ?></td>
                <td align="center"><?php echo number_format(($rowjml5['jml_qc2']/$TotalLot)*100,2)." %";?></td>
                <td align="center"><?php echo $rlqcdefqc2['jml_def'];?></td>
                <td align="center"><?php echo number_format($rlqcdefqc2['qty_kg'],2)." Kg";?></td>
                <td align="center"><?php echo $rlqcbwqc2['jml_bw'];?></td>
                <td align="center"><?php echo number_format($rlqcbwqc2['qty_kg'],2)." Kg";?></td>
              </tr>
              <tr>
              <?php
              $qry6=mysqli_query($con,"SELECT shift, shift2, shift3, shift4, IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim))) AS qty_claim_tq FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='Test Quality' OR shift2='Test Quality' OR shift3='Test Quality' OR shift4='Test Quality') $lgn"); 
              //DEFECT LOLOS QC
              $qrylqcdeftq=mysqli_query($con,"SELECT count(*) as jml_def, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan != 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='Test Quality' OR shift2='Test Quality' OR shift3='Test Quality' OR shift4='Test Quality')");
              $rlqcdeftq=mysqli_fetch_array($qrylqcdeftq);
              //BEDA WARNA LOLOS QC
              $qrylqcbwtq=mysqli_query($con,"SELECT count(*) as jml_bw, SUM(qty_claim) as qty_kg from tbl_aftersales_now where sts_check ='Ceklis' and masalah_dominan = 'Beda Warna' and 
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (shift='Test Quality' OR shift2='Test Quality' OR shift3='Test Quality' OR shift4='Test Quality')");
              $rlqcbwtq=mysqli_fetch_array($qrylqcbwtq);
              $tot_tq=0;
              while($row6=mysqli_fetch_array($qry6)){
              $tot_tq=$tot_tq+$row6['qty_claim_tq']; }?>
                <td align="left">Test Quality</td>
                <td align="right"><?php echo number_format($tot_tq,2)." Kg";?></td>
                <td align="center"><?php echo number_format(($tot_tq/$TotalKirim)*100,2)." %";?></td>
                <td align="center"><?php echo $rowjml6['jml_tq']." Kasus"; ?></td>
                <td align="center"><?php echo number_format(($rowjml6['jml_tq']/$TotalLot)*100,2)." %";?></td>
                <td align="center"><?php echo $rlqcdeftq['jml_def'];?></td>
                <td align="center"><?php echo number_format($rlqcdeftq['qty_kg'],2)." Kg";?></td>
                <td align="center"><?php echo $rlqcbwtq['jml_bw'];?></td>
                <td align="center"><?php echo number_format($rlqcbwtq['qty_kg'],2)." Kg";?></td>
              </tr>
            <?php 
            $total=$tot_a+$tot_b+$tot_c+$tot_non+$tot_qc2+$tot_tq; 
            $totalkasus=$rowjml1['jml_a']+$rowjml2['jml_b']+$rowjml3['jml_c']+$rowjml4['jml_non']+$rowjml5['jml_qc2']+$rowjml6['jml_tq'];
            $totallqcdef=$rlqcdefa['jml_def']+$rlqcdefb['jml_def']+$rlqcdefc['jml_def']+$rlqcdefn['jml_def']+$rlqcdefqc2['jml_def']+$rlqcdeftq['jml_def'];
            $totalqtylqcdef=$rlqcdefa['qty_kg']+$rlqcdefb['qty_kg']+$rlqcdefc['qty_kg']+$rlqcdefn['qty_kg']+$rlqcdefqc2['qty_kg']+$rlqcdeftq['qty_kg'];
            $totallqcbw=$rlqcbwa['jml_bw']+$rlqcbwb['jml_bw']+$rlqcbwc['jml_bw']+$rlqcbwn['jml_bw']+$rlqcbwqc2['jml_bw']+$rlqcbwtq['jml_bw'];
            $totalqtylqcbw=$rlqcbwa['qty_kg']+$rlqcbwb['qty_kg']+$rlqcbwc['qty_kg']+$rlqcbwn['qty_kg']+$rlqcbwqc2['qty_kg']+$rlqcbwtq['qty_kg'];
            ?>
            <tr>
                <td align="left"><strong>Total</strong></td>
                <td align="right"><strong><?php echo number_format($total,2)." Kg"; ?></strong></td>
                <td align="center"><strong><?php echo number_format(($total/$TotalKirim)*100,2)." %";?></strong></td>
                <td align="center"><strong><?php echo $totalkasus." Kasus"; ?></strong></td>
                <td align="center"><strong><?php echo number_format(($totalkasus/$TotalLot)*100,2)." %";?></strong></td>
                <td align="center"><strong><?php echo $totallqcdef." Kasus"; ?></strong></td>
                <td align="center"><strong><?php echo number_format($totalqtylqcdef,2)." Kg";?></strong></td>
                <td align="center"><strong><?php echo $totallqcbw." Kasus"; ?></strong></td>
                <td align="center"><strong><?php echo number_format($totalqtylqcbw,2)." Kg";?></strong></td>
            </tr>
            
            <tr>
                <td align="left"><strong>Total Kirim</strong></td>
                <td align="right"><strong><?php echo number_format($TotalKirim,2)." Kg"; ?></strong></td>
            </tr>
            <tr>
                <td align="left"><strong>Total Lot Kain</strong></td>
                <td align="right"><strong><?php echo $TotalLot; ?></strong></td>
            </tr>
          </table><td>
        </tr>
      </table></td>
    </tr>

    <tr>
      <td><table width="100%" border="0" class="table-list1">
        <tr>
          <td align="left" style="border-top:0px #000000 solid; 
                                            border-bottom:0px #000000 solid;
                                            border-left:0px #000000 solid; 
                                            border-right:0px #000000 solid;" width="55%"><strong>DETAIL LOLOS QC</strong></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td align="left" style="border-top:0px #000000 solid; 
                                            border-bottom:0px #000000 solid;
                                            border-left:0px #000000 solid; 
                                            border-right:0px #000000 solid;"><table width="100%">
        <tr>
          <td style="border-top:0px #000000 solid; 
                                            border-bottom:0px #000000 solid;
                                            border-left:0px #000000 solid; 
                                            border-right:0px #000000 solid;" valign="top"><table width="60%" border="1" class="table-list1">
            <tr>
                <td align="center" width="15%"><strong>Nama</strong></td>
                <td align="center" width="5%"><strong>Shift</strong></td>
                <td align="center" width="10%"><strong>Qty Keluhan</strong></td>
                <td align="center" width="5%"><strong>% (Qty Keluhan)</strong></td>
                <td align="center" width="5%"><strong>Total Kasus</strong></td>
                <td align="center" width="5%"><strong>% (Total Kasus)</strong></td>
            </tr>
            <tr>
              <?php
              if($_GET['langganan']!=""){ $lgn =" AND langganan LIKE '%$_GET[langganan]%' "; }else{$lgn = " ";}
              if($_GET['subdept']!=""){ $subdpt=" AND subdept='$_GET[subdept]' "; }else{$subdpt=" ";}
              // $qry1=mysqli_query($con,"SELECT personil, pejabat, shift FROM 
              // (SELECT DISTINCT personil, pejabat, shift FROM tbl_aftersales_now WHERE
              // DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              // AND '$Akhir' AND sts='1' AND sts_revdis='0' $lgn $subdpt ORDER BY shift ASC) AS A
              // UNION 
              // SELECT personil2 AS personil, '' AS pejabat, shift2 AS shift FROM 
              // (SELECT personil2, shift2 FROM tbl_aftersales_now WHERE
              // DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              // AND '$Akhir' AND sts='1' AND sts_revdis='0' AND personil2!='' $lgn $subdpt GROUP BY personil2, shift2 ORDER BY shift2 ASC) AS B
              // ORDER BY shift ASC");

              $qry1=mysqli_query($con,"SELECT personil, pejabat, shift, qty_claim FROM 
              (SELECT DISTINCT personil, pejabat, shift, SUM(IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim)))) AS qty_claim FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' $lgn $subdpt GROUP BY personil, shift ORDER BY shift ASC) AS A
              UNION 
              SELECT personil2 AS personil, '' AS pejabat, shift2 AS shift, qty_claim2 AS qty_claim FROM 
              (SELECT personil2, shift2, SUM(IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim)))) AS qty_claim2 FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' AND personil2!='' $lgn $subdpt GROUP BY personil2, shift2 ORDER BY shift2 ASC) AS B
              UNION 
              SELECT personil3 AS personil, '' AS pejabat, shift3 AS shift, qty_claim3 AS qty_claim FROM 
              (SELECT personil3, shift3, SUM(IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim)))) AS qty_claim3 FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' AND personil3!='' $lgn $subdpt GROUP BY personil3, shift3 ORDER BY shift3 ASC) AS C
              UNION 
              SELECT personil4 AS personil, '' AS pejabat, shift4 AS shift, qty_claim4 AS qty_claim FROM 
              (SELECT personil4, shift4, SUM(IF(shift4!='',qty_claim/4,IF(shift3!='',qty_claim/3,IF(shift2!='',qty_claim/2,qty_claim)))) AS qty_claim4 FROM tbl_aftersales_now WHERE
              DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
              AND '$Akhir' AND sts='1' AND sts_revdis='0' AND personil4!='' $lgn $subdpt GROUP BY personil4, shift4 ORDER BY shift4 ASC) AS D
              ORDER BY shift ASC");
               
              while($row1=mysqli_fetch_array($qry1)){
                //PERSONIL & PEJABAT
                $qryD=mysqli_query($con,"SELECT if(shift2!='',qty_claim/2,qty_claim) as qty_claim FROM tbl_aftersales_now WHERE
                DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
                AND '$Akhir' AND sts='1' AND sts_revdis='0' AND IF(pejabat!='',pejabat='$row1[pejabat]',IF(personil2!='',personil2='$row1[personil]',personil='$row1[personil]')) AND IF(shift2!='',shift2='$row1[shift]',shift='$row1[shift]') $lgn $subdpt");
                //PERSONIL 2
                $qryD2=mysqli_query($con,"SELECT if(shift2!='',qty_claim/2,qty_claim) as qty_claim FROM tbl_aftersales_now WHERE
                DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
                AND '$Akhir' AND sts='1' AND sts_revdis='0' AND personil2='$row1[personil]' AND shift2='$row1[shift]' $lgn $subdpt");
                //$rD=mysqli_fetch_array($qryD);
                $tot=0;
                while($rD=mysqli_fetch_array($qryD)){
                  $tot=$tot+$rD['qty_claim'];
                }
                $tot2=0;
                while($rD2=mysqli_fetch_array($qryD2)){
                  $tot2=$tot2+$rD2['qty_claim'];
                }
                $qryjml1=mysqli_query($con,"SELECT COUNT(*) as jml FROM tbl_aftersales_now WHERE
                DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
                AND '$Akhir' AND sts='1' AND sts_revdis='0' AND (IF(pejabat!='',pejabat='$row1[pejabat]',personil='$row1[personil]') OR personil2='$row1[personil]' OR personil3='$row1[personil]' OR personil4='$row1[personil]') AND (shift='$row1[shift]' OR shift2='$row1[shift]' OR shift3='$row1[shift]' OR shift4='$row1[shift]') $lgn $subdpt");
                $rowjml1=mysqli_fetch_array($qryjml1);
                // $qryjml2=mysqli_query($con,"SELECT COUNT(*) as jml FROM tbl_aftersales_now WHERE
                // DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' 
                // AND '$Akhir' AND sts='1' AND sts_revdis='0' AND personil2='$row1[personil]' AND shift2='$row1[shift]' $lgn $subdpt");
                // $rowjml2=mysqli_fetch_array($qryjml2);
              ?>
                <!--<td align="left"><?php if($row1['pejabat']!=''){echo $row1['pejabat'];}else{echo $row1['personil'];}?></td>
                <td align="center"><?php echo $row1['shift'];?></td>
                <td align="right"><?php if($rD2['qty_claim']!=''){echo number_format($tot2,2)." Kg";}else{echo number_format($tot,2)." Kg";}?></td>
                <td align="center"><?php if($rD2['qty_claim']!=''){echo number_format(($tot2/$TotalKirim)*100,2)." %";}else{echo number_format(($tot/$TotalKirim)*100,2)." %";}?></td>
                <td align="center"><?php if($rowjml2['jml']!=''){echo $rowjml2['jml']." Kasus";}else{echo $rowjml1['jml']." Kasus";} ?></td>
                <td align="center"><?php if($rowjml2['jml']!=''){echo number_format(($rowjml2['jml']/$TotalLot)*100,2)." %";}else{echo number_format(($rowjml1['jml']/$TotalLot)*100,2)." %";}?></td>-->
                <td align="left"><?php if($row1['pejabat']!=''){echo $row1['pejabat'];}else{echo $row1['personil'];}?></td>
                <td align="center"><?php echo $row1['shift'];?></td>
                <td align="right"><?php echo number_format($row1['qty_claim'],2)." Kg";?></td>
                <td align="center"><?php echo number_format(($row1['qty_claim']/$TotalKirim)*100,2)." %";?></td>
                <td align="center"><?php echo $rowjml1['jml']." Kasus";?></td>
                <td align="center"><?php echo number_format(($rowjml1['jml']/$TotalLot)*100,2)." %";?></td>
            </tr>
              <?php } ?>
            <tr>
                <td align="left"><strong>Total Kirim</strong></td>
                <td align="left" colspan="5"><strong><?php echo number_format($TotalKirim,2)." Kg"; ?></strong></td>
            </tr>
            <tr>
                <td align="left"><strong>Total Lot Kain</strong></td>
                <td align="left" colspan="5"><strong><?php echo $TotalLot; ?></strong></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>

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
        <td align="center"><input type=text name=nama1 placeholder="Ketik disini"></td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td align="center"><input type=text name=nama2 placeholder="Ketik disini"></td>
        <td align="center"><input type=text name=nama3 placeholder="Ketik disini"></td>
        <td align="center"><input type=text name=nama1 placeholder="Ketik disini"></td>
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
  <!--xxx-->
	<?php  } ?>
</table>

<script>
//alert('cetak');window.print();
</script> 
