<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
include "../../tgl_indo.php";
//--
// $idkk=$_REQUEST['idkk'];
// $act=$_GET['g'];
// //-
// $Awal=$_GET['awal'];
// $Akhir=$_GET['akhir'];
// $Dept=$_GET['dept'];
// $Cancel=$_GET['cancel'];
// $qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%Y-%m-%d') as tgl_skrg,DATE_FORMAT(now(),'%H:%i:%s') as jam_skrg");
// $rTgl=mysqli_fetch_array($qTgl);
// if($Awal!=""){$tgl=substr($Awal,0,10); $jam=$Awal;}else{$tgl=$rTgl['tgl_skrg']; $jam=$rTgl['jam_skrg'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak Perbaikan Garment</title>
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
</head>
<?php 
$nmBln=array(1 => "JANUARI","FEBUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");	
?>
<body>
<table width="100%">
  <thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
  <tr>
    <td align="center"><strong><font size="+1">Laporan Debit Note</font><br />
		<!-- <font size="-1">Periode: <?php echo date("d/m/Y", strtotime($Awal));?> s/d <?php echo date("d/m/Y", strtotime($Akhir));?></font>
          <br />
		<font size="-1">FW-06-QCF-01/04</font></strong></td> -->
    </tr>
  </table>

		</td>
    </tr>
	</thead>
	
    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
		  <thead>
          <tr align="center">
            <td><font size="-2">NO</font></td>
            <td><font size="-2">ITEM</font></td>
            <td><font size="-2">KG</font></td>
            <td><font size="-2">YD</font></td>
            <td><font size="-2">CURRENCY</font></td>
            <td><font size="-2">AMOUNT</font></td>
          </tr>
		  </thead>	  
		  <tbody>
		<?php
	$no=1;
// 	$Awal=$_GET['awal'];
//   $Akhir=$_GET['akhir'];
//   $Order=$_GET['order'];
//   $Hanger=$_GET['hanger'];
//   $PO=$_GET['po'];
//   $Langganan=$_GET['langganan'];
//   $Demand=$_GET['demand'];
//   $Prodorder=$_GET['prodorder'];
//   $Pejabat=$_GET['pejabat'];
//   if($Awal!=""){ $Where =" AND DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; }
//   if($Awal!="" or $Order!="" or $Hanger!="" or $PO!="" or $Langganan!="" or $Demand!="" or $Prodorder!="" or $Pejabat!=""){
//   $qry1=mysqli_query($con,"SELECT * FROM tbl_aftersales_now WHERE no_order LIKE '%$Order%' AND po LIKE '%$PO%' AND no_hanger LIKE '%$Hanger%' AND langganan LIKE '%$Langganan%' AND nodemand LIKE '%$Demand%' AND nokk LIKE '%$Prodorder%' AND pejabat LIKE '%$Pejabat%' $Where ORDER BY masalah_dominan ASC");
//   }else{
//   $qry1=mysqli_query($con,"SELECT * FROM tbl_aftersales_now WHERE no_order LIKE '$Order' AND po LIKE '$PO' AND no_hanger LIKE '$Hanger' AND langganan LIKE '$Langganan' AND nodemand LIKE '$Demand' AND nokk LIKE '$Prodorder' AND pejabat LIKE '%$Pejabat%' $Where ORDER BY masalah_dominan ASC");
//   }
// 			while($row1=mysqli_fetch_array($qry1)){
// 				if($row1['t_jawab']!="" and $row1['t_jawab1']!="" and $row1['t_jawab2']!=""){ $tjawab=$row1['t_jawab'].",".$row1['t_jawab1'].", ".$row1['t_jawab2'];
// 				}else if($row1['t_jawab']!="" and $row1['t_jawab1']!="" and $row1['t_jawab2']==""){
// 				$tjawab=$row1['t_jawab'].",".$row1['t_jawab1'];	
// 				}else if($row1['t_jawab']!="" and $row1['t_jawab1']=="" and $row1['t_jawab2']!=""){
// 				$tjawab=$row1['t_jawab'].",".$row1['t_jawab2'];	
// 				}else if($row1['t_jawab']=="" and $row1['t_jawab1']!="" and $row1['t_jawab2']!=""){
// 				$tjawab=$row1['t_jawab1'].",".$row1['t_jawab2'];	
// 				}else if($row1['t_jawab']!="" and $row1['t_jawab1']=="" and $row1['t_jawab2']==""){
// 				$tjawab=$row1['t_jawab'];
// 				}else if($row1['t_jawab']=="" and $row1['t_jawab1']!="" and $row1['t_jawab2']==""){
// 				$tjawab=$row1['t_jawab1'];
// 				}else if($row1['t_jawab']=="" and $row1['t_jawab1']=="" and $row1['t_jawab2']!=""){
// 				$tjawab=$row1['t_jawab2'];	
// 				}else if($row1['t_jawab']=="" and $row1['t_jawab1']=="" and $row1['t_jawab2']==""){
// 				$tjawab="";	
// 				}

      //   $qry1=mysqli_query($con,"SELECT
      //   no_item,
      //   sum(kg) as total_kg,
      //   satuan,
      //   sum(amount) as total_amount,
      //   currency 
      // from
      //   tbl_debit_note
      // group by no_item 
      // ");
          $qry1=mysqli_query($con,"SELECT
          no_item,
          sum(kg) as total_kg,
          satuan,
          sum(amount) as total_amount,
          currency 
        from
          tbl_debit_note
        group by no_item, currency

        ");
        while($row1=mysqli_fetch_array($qry1)){
		 ?>
          <tr valign="top">
            <td align="center"><font size="-2"><?php echo $no; ?></font></td>
            <td valign="top" align="center"><font size="-2"><?php echo $row1['no_item'];?></font></td>
            <td valign="top" align="center"><font size="-2"><?php echo $row1['total_kg'];?></font></td>
            <td valign="top" align="center"><font size="-2"><?php echo $row1['satuan'];?></font></td>
            <td valign="top" align="center"><font size="-2"><?php echo $row1['currency'];?></font></td>
            <td valign="top" align="center"><font size="-2">
                <?php 
                    if($row1['currency'] == 'IDR') {
                        echo 'Rp. ' . number_format($row1['total_amount'], 0, ',', '.');
                    } else if ($row1['currency'] == 'USD') {
                        echo '$' . number_format($row1['total_amount'], 2);
                    } else {
                        echo $row1['total_amount']; // Jika nilai currency tidak sesuai dengan IDR atau USD
                    }
                ?>
            </font></td>
          </tr>
		<?php	$no++;  
		
			} ?>	
          
			
        
      </table></td>
    </tr>
	</tbody>
   
    </table></td>
    </tr>
  
</table>

<script>
//alert('cetak');window.print();
</script> 
</body>
</html>