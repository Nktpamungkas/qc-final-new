<?php
if (isset($_GET['excel'])) {
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kpestatus.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
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
?>
<?php if (!isset($_GET['excel'])) { ?>
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
<?php } ?>	

<?php 
$nmBln=array(1 => "JANUARI","FEBUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");	
?>

<div align="center">
<strong><font size="+1">LAPORAN LEADTIME KPE</font></strong><br />
<font size="-1">Periode: <?php echo date("d/m/Y", strtotime($Awal));?> s/d <?php echo date("d/m/Y", strtotime($Akhir));?></font>
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
            <td><font size="-2">PIC</font></td>
			<td><font size="-2">Tgl Email</font></td>
			<td><font size="-2">Tgl Jawab</font></td>
			
			<td><font size="-2">HOD</font></td>
			<td><font size="-2">Langganan</font></td>
			<td><font size="-2">No Demand</font></td>
			<td><font size="-2">Lot</font></td>
			<td><font size="-2">PO</font></td>
			<td><font size="-2">Hanger</font></td>
			<td><font size="-2">Warna</font></td>
			<td><font size="-2">Qty Order</font></td>
			<td><font size="-2">Qty Kirim</font></td>
			<td><font size="-2">Qty Claim</font></td>
			<td><font size="-2">% Claim</font></td>
			<td><font size="-2">T Jawab</font></td>
			<td><font size="-2">Masalah</font></td>
			<td><font size="-2">Keterangan</font></td>
           
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
  if($Awal!=""){ $Where =" AND DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; }
  if($Awal!="" or $Order!="" or $Hanger!="" or $PO!="" or $Langganan!="" or $Demand!="" or $Prodorder!="" or $Pejabat!=""){
		$sql_cek = "SELECT * FROM tbl_aftersales_now WHERE ( solusi is null or solusi = '' ) and  no_order LIKE '%$Order%' AND po LIKE '%$PO%' AND no_hanger LIKE '%$Hanger%' AND langganan LIKE '%$Langganan%' AND nodemand LIKE '%$Demand%' AND nokk LIKE '%$Prodorder%' AND pejabat LIKE '%$Pejabat%' $Where ORDER BY tgl_email ASC";
  $qry1=mysqli_query($con,$sql_cek);
  }else{
	  $sql_cek = "SELECT * FROM tbl_aftersales_now WHERE ( solusi is null or solusi = '' ) and  no_order LIKE '$Order' AND po LIKE '$PO' AND no_hanger LIKE '$Hanger' AND langganan LIKE '$Langganan' AND nodemand LIKE '$Demand' AND nokk LIKE '$Prodorder' AND pejabat LIKE '%$Pejabat%' $Where ORDER BY tgl_email ASC";
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
		 ?>
          <tr valign="top">
            <td align="center"><font size="-2"><?php echo $no; ?></font></td>
            <td align="center"><font size="-2"><?=$row1['nama_nego']?></font></td>
			<td align="center"><font size="-2"><?php if($row1['tgl_email']=='0000-00-00') {echo '-';} else { echo $row1['tgl_email']; }?></font></td>
			<td align="center"><font size="-2"><?php if($row1['tgl_jawab']=='0000-00-00') {echo '-';} else { echo $row1['tgl_jawab']; }?></font></td>
			<td align="center"><font size="-2"><?php if($row1['hod']=='0000-00-00' or $row1['hod'] == null ) {echo '-';} else { echo $row1['hod']; }?></font></td>
			<td align="left"><font size="-2"><?=$row1['langganan']?></font></td>
			<td align="center"><font size="-2"><?=$row1['nodemand']?></font></td>
			<td align="center"><font size="-2"><?=$row1['lot']?></font></td>
			<td align="center"><font size="-2"><?=$row1['po']?></font></td>
			
			<td align="center"><font size="-2"><?=$row1['no_hanger']?></font></td>
		
			<td align="center"><font size="-2"><?=$row1['warna'];?></font></td>
			<td align="center"><font size="-2"><?=$row1['qty_order'];?></font></td>
			<td align="center"><font size="-2"><?=$row1['qty_kirim'];?></font></td>
			<td align="center"><font size="-2"><?=$row1['qty_claim'];?></font></td>
			<td align="center"><font size="-2"><?php 
					$persentase = ($row1['qty_claim']/$row1['qty_kirim'])*100; 
					if (is_float($persentase)) {
						$rounded_angka = round($persentase,2);
						echo $rounded_angka;
					} else {
					echo $persentase;
					}
				?>%</font></td>
			<td align="center"><font size="-2"><?=$tjawab;?></font></td>
			<td align="center"><font size="-2"><?=$row1['masalah'];?></font></td>
			<td align="center"><font size="-2"><?=$row1['ket'];?></font></td>
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
		  
         <tr valign="top">
             <td colspan="12" align="right">TOTAL</td>
             <td align="center"><?=$total_qty_order?></td>
			 <td align="center"><?=$total_qty_kirim?></td>
			 <td align="center"><?=$total_qty_claim?></td>
			 <td align="center">
			 <?php $total_persentase_claim = ($total_qty_claim/$total_qty_kirim)*100;
			 if (is_float($total_persentase_claim)) {
						$rounded_angka = round($total_persentase_claim,2);
						echo $rounded_angka;
					} else {
					echo $total_persentase_claim;
					}
			 
			 ?>%
			 </td>
			 <td colspan=3></td>
          </tr>
		 
			
        
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
        <td align="center"><input type=text name=nama4 placeholder="Ketik disini"></td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td align="center"><input type=text name=nama2 placeholder="Ketik disini"></td>
        <td align="center"><input type=text name=nama3 placeholder="Ketik disini"></td>
        <td align="center"><input type=text name=nama5 placeholder="Ketik disini"></td>
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

