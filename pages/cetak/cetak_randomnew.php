<?php
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
//$Dept=$_GET['dept'];
//$Cancel=$_GET['cancel'];
$qTgl=mysqli_query($con,"SELECT DATE_FORMAT(now(),'%d-%b-%y') as tgl_skrg,DATE_FORMAT(now(),'%H:%i:%s') as jam_skrg");
$rTgl=mysqli_fetch_array($qTgl);
if($Awal!=""){$tgl=substr($Awal,0,10); $jam=$Awal;}else{$tgl=$rTgl['tgl_skrg']; $jam=$rTgl['jam_skrg'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak Random</title>
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
   body {
        -webkit-print-color-adjust: exact !important; /* Chrome, Safari */
        color-adjust: exact !important; /*Firefox*/
   }
}	
</style>	
</head>
<body>
    <table width="100%" border="1" class="table-list1">
        <thead>
            <tr>
                <th rowspan="2" colspan="8" align="center"><input style="font-size: 10px; font-weight: bold;" name="operator" type="text" placeholder="Ketik Disini" size="20" /></th>
                <th colspan="10" align="center">SNAG POD (FACE)</th>
                <th colspan="2"align="center">SNAG POD (BACK)</th>
                <th rowspan="4" align="center">SNAG MACE</th>
                <th colspan="3" align="center">BS</th>
                <th colspan="2" align="center">PILLING MARTINDALE</th>
                <th colspan="2" align="center">ELONGATION</th>
                <th colspan="2" align="center">RECOVERY</th>
                <th rowspan="2" colspan="2" align="center">WICKING</th>
                <th rowspan="2" align="center">ABSORBENCY</th>
                <th rowspan="2" align="center">EVAPORATION RATE</th>
                <th rowspan="3" colspan="2" align="center">BOW &amp; SKEW</th>
            </tr>
            <tr>
                <th colspan="5" align="center">LENGTH</th>
                <th colspan="5" align="center">WIDTH</th>
                <th align="center">LENGTH</th>
                <th align="center">WIDTH</th>
                <th align="center">N</th>
                <th align="center">KPA</th>
                <th align="center">PSI</th>
                <th align="center">500</th>
                <th align="center">2000</th>
                <th align="center">L</th>
                <th align="center">W</th>
                <th align="center">L</th>
                <th align="center">W</th>
            </tr>
            <tr>
                <th rowspan="2" align="center">ITEM</th>
                <th rowspan="2" align="center">HANGER</th>
                <th rowspan="2" align="center">DESCRIPTION</th>
                <th rowspan="2" align="center">BUYER</th>
                <th rowspan="2" align="center">WIDTH</th>
                <th rowspan="2" align="center">GSM</th>
                <th rowspan="2" align="center">PILL R. TUMBLER</th>
                <th rowspan="2" align="center">PILL BOX</th>
                <th colspan="12" align="center">SNAGPOD</th>
                <th colspan="3" align="center">BS</th>
                <th colspan="2" align="center">PILL MARTINDALE</th>
                <th colspan="2" align="center">ELONGATION</th>
                <th colspan="2" align="center">RECOVERY</th>
                <th align="center">L</th>
                <th align="center">W</th>
                <th align="center">PHX-AP0604</th>
                <th align="center">PHX-AP0607</th>
            </tr>
            <tr>
                <th align="center">Grade</th>
                <th align="center">Class</th>
                <th align="center">Snag < 2mm</th>
                <th align="center">Snag 2-5mm</th>
                <th align="center">Snag > 5mm</th>
                <th align="center">Grade</th>
                <th align="center">Class</th>
                <th align="center">Snag < 2mm</th>
                <th align="center">Snag 2-5mm</th>
                <th align="center">Snag > 5mm</th>
                <th align="center">Grade</th>
                <th align="center">Grade</th>
                <th align="center">NEWTON</th>
                <th align="center">KPA</th>
                <th align="center">PSI</th>
                <th align="center">500 REV</th>
                <th align="center">2000 REV</th>
                <th align="center">L</th>
                <th align="center">W</th>
                <th align="center">L</th>
                <th align="center">W</th>
                <th align="center" colspan="2">After 5 Wash</th>
                <th align="center">After 5 Wash</th>
                <th align="center">After 5 Wash</th>
                <th align="center">Bow</th>
                <th align="center">Skew</th>
            </tr>
        </thead>
        <tbody>
        <?php
        date_default_timezone_set("Asia/Jakarta"); 
        $query=mysqli_query($con,"SELECT * FROM tbl_tq_randomtest WHERE DATE_FORMAT( tgl_update, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' GROUP BY no_item ");
        while($r=mysqli_fetch_array($query)){
            $q1=mysqli_query($con,"SELECT * FROM tbl_tq_nokk WHERE no_item='$r[no_item]' OR no_hanger='$r[no_hanger]'");
            $r1=mysqli_fetch_array($q1);
            $pos=strpos($r1['pelanggan'], "/");
	        $posbuyer=substr($r1['pelanggan'],$pos+1,50);
            $buyer=str_replace("'","''",$posbuyer);
            //$qtemp=mysqli_query("SELECT * FROM tbl_tq_temp_random WHERE no_item='$r[no_item]' OR no_hanger='$r[no_hanger]'");
            //$rtemp=mysqli_fetch_array($qtemp);
            //$qtemp1=mysqli_query("SELECT * FROM tbl_tq_temp_random2 WHERE no_item='$r[no_item]' OR no_hanger='$r[no_hanger]'");
            //$rtemp1=mysqli_fetch_array($qtemp1);
            $today = new DateTime();
            $tgl_update = date("Y-m-d", strtotime($r['tgl_update']));
            $update = new DateTime($tgl_update);
            $selisih = $today->diff($update);
        ?>
        <tr>
            <td align="left" style="font-size: 7px;"><?php echo $r['no_item'];?></td>
            <td align="left" style="font-size: 7px;"><?php echo $r['no_hanger'];?></td>
            <td align="left" style="font-size: 7px;"><?php echo substr($r1['jenis_kain'],0,30);?></td>
            <td align="center" style="font-size: 7px;"><?php echo $buyer;?></td>
            <td align="center" style="font-size: 7px;"><?php echo $r1['lebar'];?></td>
            <td align="center" style="font-size: 7px;"><?php echo $r1['gramasi'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND ($r['rprt_f1']!="" OR $r['rprt_b1']!="")){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND ($r['rprt_f1']!="" OR $r['rprt_b1']!="")){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND ($r['rprt_f1']!="" OR $r['rprt_b1']!="")){ ?> bgcolor="" <?php } ?>>
            <?php if($r['rprt_f1']!=""){echo "F: ".$r['rprt_f1'];}?> &nbsp; <?php if($r['rprt_b1']!=""){echo "B: ".$r['rprt_b1'];}?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rpb_f1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rpb_f1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rpb_f1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rpb_f1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_grdl1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_grdl1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_grdl1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_grdl1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_clsl1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_clsl1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_clsl1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_clsl1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_shol1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_shol1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_shol1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_shol1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_medl1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_medl1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_medl1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_medl1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_lonl1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_lonl1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_lonl1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_lonl1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_grdw1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_grdw1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_grdw1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_grdw1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_clsw1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_clsw1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_clsw1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_clsw1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_show1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_show1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_show1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_show1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_medw1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_medw1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_medw1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_medw1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_lonw1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_lonw1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_lonw1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_lonw1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_grdl2']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_grdl2']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_grdl2']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_grdl2'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rsp_grdw2']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rsp_grdw2']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rsp_grdw2']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rsp_grdw2'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND ($r['rsm_l1']!="" OR $r['rsm_w1']!="")){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND ($r['rsm_l1']!="" OR $r['rsm_w1']!="")){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND ($r['rsm_l1']!="" OR $r['rsm_w1']!="")){ ?> bgcolor="" <?php } ?>>
            <?php if($r['rsm_l1']!=""){echo "L= ".$r['rsm_l1'];}?> &nbsp; <?php if($r['rsm_w1']!=""){echo "W= ".$r['rsm_w1'];}?></td>
            <td align="center" style="font-size: 7px;"
            <?php if($selisih->m==0 AND $r['rbs_instron']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rbs_instron']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rbs_instron']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rbs_instron'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rbs_tru']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rbs_tru']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rbs_tru']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rbs_tru'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rbs_mullen']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rbs_mullen']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rbs_mullen']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rbs_mullen'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rpm_f1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rpm_f1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rpm_f1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rpm_f1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rpm_f2']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rpm_f2']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rpm_f2']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rpm_f2'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rstretch_l1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rstretch_l1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rstretch_l1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rstretch_l1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rstretch_w1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rstretch_w1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rstretch_w1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rstretch_w1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rrecover_l1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rrecover_l1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rrecover_l1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rrecover_l1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rrecover_w1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rrecover_w1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rrecover_w1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rrecover_w1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rwick_l2']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rwick_l2']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rwick_l2']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rwick_l2'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rwick_w2']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rwick_w2']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rwick_w2']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rwick_w2'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rabsor_b1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rabsor_b1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rabsor_b1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rabsor_b1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rdryaf1']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rdryaf1']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rdryaf1']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rdryaf1'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rbow']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rbow']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rbow']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rbow'];?></td>
            <td align="center" style="font-size: 7px;" 
            <?php if($selisih->m==0 AND $r['rskew']!=""){ ?> bgcolor="#FFE54E" <?php }
            else if($selisih->m==1 AND $r['rskew']!=""){ ?> bgcolor="#FF6F30" <?php }
            else if($selisih->m>1 AND $r['rskew']!=""){ ?> bgcolor="" <?php } ?>>
            <?php echo $r['rskew'];?></td>
        </tr>
       <?php } ?>
       </tbody>
    </table>
    <table width="100%" >
        <tr>
            <td><table width="100%" border="0" class="table-list1">
                <tr>
                    <td bgcolor="#FFE54E" colspan="2">&nbsp;</td>
                    <td align="left" style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid; 
                    border-right:0px #000000 solid;">Item random baru</td>
                </tr>
                <tr>
                    <td bgcolor="#FF6F30" colspan="2">&nbsp;</td>
                    <td align="left" style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid; 
                    border-right:0px #000000 solid;">Replacement item random</td>
                </tr>
                <tr>
                    <td bgcolor="#722A02" colspan="2">&nbsp;</td>
                    <td align="left" style="border-top:0px #000000 solid; 
                    border-bottom:0px #000000 solid; 
                    border-right:0px #000000 solid;">Tidak random karena reject</td>
                </tr>
            </table></td>
            <td><table width="100%" border="1" class="table-list1">
                <tr>
                    <td align="center">Dibuat Oleh:</td>
                    <td align="center" colspan="4">Diperiksa Oleh:</td>
                    <td align="center" colspan="2">Mengetahui:</td>
                </tr>
                <tr>
                    <td align="center">OPERATOR</td>
                    <td align="center" colspan="4">LEADER</td>
                    <td align="center">AST. SPV</td>
                    <td align="center">AST. MANAGER</td>
                </tr>
                <tr>
                    <td height="60" width="14%" valign="bottom" align="center"><input style="font-size: 11px;" name="operator" type="text" placeholder="Ketik Disini" size="20" /></td>
                    <td height="60" width="14%" valign="bottom" align="center">EDWIN I.</td>
                    <td height="60" width="14%" valign="bottom" align="center">T. RESTIARDI</td>
                    <td height="60" width="14%" valign="bottom" align="center">JANU D.L</td>
                    <td height="60" width="14%" valign="bottom" align="center">TRI S.</td>
                    <td height="60" width="14%" valign="bottom" align="center">VIVIK K.</td>
                    <td height="60" width="14%" valign="bottom" align="center">FERRY W.</td>
                </tr>
            </table></td>
        </tr>
    </table>
</body>